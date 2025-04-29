<?php

namespace App\Controllers\Turbootp;

use CodeIgniter\Controller;
use App\Models\turbootp\SistemModel;
use App\Models\turbootp\ServicesModel;
use App\Models\turbootp\OrderModel;
use App\Models\UserModel;
use App\Models\RiwayatSaldoModel;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\ConnectionInterface;

class Sistem extends BaseController
{
  
    use ResponseTrait;

    public function __construct(ConnectionInterface &$db = null)
    {
        $this->db = &$db;
    }
    
    public function getServices()
    {
        $settings = $this->getSettingsData();
        $api_key = $settings['turbootp_apikey'];
        $endpoint = "https://turbootp.com/api/get-services/$api_key";
    
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        $data = json_decode($response, true);
    
        if (isset($data['status']) && $data['status'] === 201) {
            $servicesModel = new ServicesModel();
        
            foreach ($data['data']['data'] as $service) {
                $profitMargin = ($service['price'] * $settings['profit'] / 100);
                $insertData = [
                    'service_id' => $service['id'],
                    'service_name' => $service['name'],
                    'price_provider' => $service['price'],
                    'price' => floatval($service['price']) + $profitMargin,
                    'profit' => $profitMargin,
                    'service_update' => date('Y-m-d')
                ];
        
                $existingData = $servicesModel->where('service_id', $service['id'])->first();
        
                try {
                    if ($existingData) {
                        $servicesModel->update($existingData['id'], $insertData);
                    } else {
                        $servicesModel->insert($insertData);
                    }
                } catch (\Exception $e) {
                    return $this->failServerError("Gagal mengelola data ke database: " . $e->getMessage());
                }
            }
        
            $services = $servicesModel->findAll();
        
            return $this->respond(["message" => "Data berhasil disimpan ke database.", "services" => $services], 201);
        } else {
            return $this->fail("Gagal mendapatkan data dari provider.");
        }
    }
    
    public function updateWaitingOrders()
    {
        $settings = $this->getSettingsData();
        $api_key = $settings['turbootp_apikey'];
        $orderModel = new OrderModel();
    
        $waitingOrders = $orderModel->getOrdersByStatus(['1']);
    
        $responses = [];
    
        foreach ($waitingOrders as $order) {
            $url = "https://turbootp.com/api/get-orders/$api_key/{$order['order_id']}";
    
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            $response = curl_exec($ch);
    
            if (curl_errno($ch)) {
                $responses[] = ['order_id' => $order['order_id'], 'success' => false, 'message' => 'Curl error: ' . curl_error($ch)];
            } else {
                $result = json_decode($response, true);
    
                  if (isset($result['success']) && $result['success']) {
                      $data = $result['data']['data'];
                  
                      if (!empty($data) && isset($data[0]['status'])) {

                          $statusValue = $data[0]['status'];
                  
                          if ($statusValue === '2' || $statusValue === '3' || $statusValue === '4' || $statusValue === '5') {
                              $smsData = json_decode($data[0]['sms'], true);
                  
                              if (!empty($smsData)) {
                                  $lastSms = end($smsData)['sms'];
                                  $dataToUpdate = [
                                      'status' => $statusValue,
                                      'sms' => $lastSms,
                                  ];
                  
                                  $orderModel->update($order['id'], $dataToUpdate);
                  
                                  $responses[] = [
                                      'order_id' => $order['order_id'],
                                      'success' => true,
                                      'message' => 'Pembaruan berhasil',
                                      'updated_data' => $dataToUpdate,
                                      'reloadPage' => true,
                                  ];
                              } else {
                                  $responses[] = [
                                      'order_id' => $order['order_id'],
                                      'success' => false,
                                      'message' => 'Data SMS kosong dalam respons API.',
                                  ];
                              }
                          } else {
                              $responses[] = [
                                  'order_id' => $order['order_id'],
                                  'success' => false,
                                  'message' => 'Status bukan 2 atau 3, melewati pembaruan',
                              ];
                          }
                      } else {
                          $responses[] = [
                              'order_id' => $order['order_id'],
                              'success' => false,
                              'message' => 'Tidak ada data yang diterima dari API.',
                          ];
                      }
                  } else {
                      $responses[] = [
                          'order_id' => $order['order_id'],
                          'success' => false,
                          'message' => 'Gagal melakukan pembaruan. Periksa kembali respons dari API.',
                      ];
                  }
            }
    
            curl_close($ch);
        }
    
        return $this->response->setJSON($responses);
    }
    
    public function updateAllOrders()
    {
        $orderModel = new OrderModel();
    
        $receivedOrders = $orderModel->getOrdersByStatus(['2', '3', '4', '5']);
    
        $responses = [];
    
        foreach ($receivedOrders as $order) {
            $createdAt = strtotime($order['created_at']);
            $currentTime = time();
            $timeDifference = $currentTime - $createdAt;
            $timeInMinutes = $timeDifference / 60;
    
            if ($timeInMinutes > 20) {
                $dataToUpdate = [
                    'status' => 'done',
                ];
    
                $orderModel->update($order['id'], $dataToUpdate);
    
                $responses[] = ['order_id' => $order['order_id'], 'success' => true, 'message' => 'Update successful'];
            }
        }
    }
    
}