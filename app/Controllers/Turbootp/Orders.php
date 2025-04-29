<?php

namespace App\Controllers\Turbootp;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\turbootp\OrderModel;
use App\Models\turbootp\SistemModel;
use App\Models\turbootp\ServicesModel;
use App\Models\RiwayatSaldoModel;
use App\Controllers\BaseController;

class Orders extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
    
        $sistemModel = new SistemModel();
        $data['services'] = $sistemModel->findAll();
    
        $orderModel = new OrderModel();
    
        $userModel = new UserModel();
        $username = $this->session->get('username');
        $user = $userModel->where('username', $username)->first();
    
        if (!empty($user) && isset($user['id'])) {
            $data['orders'] = $orderModel->getNewOrdersByUserId($user['id']);
    
            foreach ($data['orders'] as &$order) {
                $order['countdown'] = $this->calculateCountdown($order['created_at']);
            }
        } else {
            $data['orders'] = [];
        }
    
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);
    
        $data += [
            'username' => $user['username'],
            'balance' => $user['balance'],
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
            'currentSegment' => $currentSegment,
        ];
    
        return view('user/turbootp/orders', $data);
    }
    
    private function calculateCountdown($createdAt)
    {
        $currentTime = time();
        $orderTime = strtotime($createdAt);
    
        $difference = $currentTime - $orderTime;
        $countdown = 20 * 60 - $difference;
    
        return max($countdown, 0);
    }

    public function placeOrder()
    {
        $userModel = new UserModel();
        $orderModel = new OrderModel();
        $servicesModel = new ServicesModel();
    
        $serviceId = htmlspecialchars($this->request->getPost('service'), ENT_QUOTES, 'UTF-8');
    
        $selectedServiceName = htmlspecialchars($this->request->getPost('selected_service_name'), ENT_QUOTES, 'UTF-8');
        $selectedServicePrice = htmlspecialchars($this->request->getPost('selected_service_price'), ENT_QUOTES, 'UTF-8');
    
        if (!$serviceId) {
            $this->session->setFlashdata('message', 'ID Layanan tidak valid');
            return redirect()->to('orders');
        }
    
        $username = $this->session->get('username');
        $user = $userModel->where('username', $username)->first();
    
        if (!$user) {
            return redirect()->to('/auth/login');
        }
    
        if ($user['balance'] < $selectedServicePrice) {
            $this->session->setFlashdata('message', 'Saldo tidak mencukupi');
            return redirect()->to('orders');
        }
    
        if (!isset($user['id']) || empty($user['id'])) {
            $this->session->setFlashdata('message', 'Error: User ID tidak valid');
            return redirect()->to('orders');
        }
    
        $settings = $this->getSettingsData();
        $api_key = $settings['turbootp_apikey'];
        $apiUrl = "https://turbootp.com/api/set-orders/$api_key/$serviceId";
        
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($ch);
        
        if ($apiResponse === FALSE) {
            $this->session->setFlashdata('messages', 'Error: ' . htmlspecialchars(curl_error($ch), ENT_QUOTES, 'UTF-8'));
            curl_close($ch);
            return redirect()->to('orders');
        } else {
            $data = json_decode($apiResponse, true);
        
            if (isset($data['success']) && $data['success']) {
                $selectedServicePrice = floatval($selectedServicePrice);
        
                $saldoAwal = $user['balance'];
                $newBalance = $saldoAwal - $selectedServicePrice;
                $userModel->update($user['id'], ['balance' => $newBalance]);
                $saldoAkhir = $newBalance;
        
                $riwayatSaldoModel = new RiwayatSaldoModel();
                $riwayatData = [
                    'user_id' => $user['id'],
                    'catatan' => 'Pembelian OrderID: ' . $data['data']['data']['order_id'],
                    'jumlah' => $selectedServicePrice,
                    'saldo_awal' => $saldoAwal,
                    'saldo_akhir' => $saldoAkhir,
                    'tipe' => 'Pengurangan',
                ];
                $riwayatSaldoModel->insert($riwayatData);
        
                $profit = $servicesModel->getProfitByServiceId($serviceId);
        
                $orderData = [
                    'user_id' => $user['id'],
                    'order_id' => $data['data']['data']['order_id'],
                    'service_name' => $selectedServiceName,
                    'number' => $data['data']['data']['number'],
                    'price' => $selectedServicePrice,
                    'profit' => $profit,
                    'status' => $data['data']['data']['status'],
                    'sms' => 'waiting',
                    'status_sms' => $data['data']['data']['status_sms'],
                    'last_sms' => $data['data']['data']['last_sms'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];
        
                $orderModel->insert($orderData);
                $this->session->setFlashdata('success', 'Order berhasil dilakukan');
            } else {
                $errorMessage = isset($data['data']['messages']) ? $data['data']['messages'] : 'Unknown error';
                $this->session->setFlashdata('message', 'Gagal: ' . htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'));
            }
        }
        
        curl_close($ch);
    
        $data['orders'] = $orderModel->getOrdersByUserId($user['id']);
    
        return redirect()->to('orders');
    }
    
    public function changeStatusCancel($orderId)
    {
        try {
            $settings = $this->getSettingsData();
            $api_key = $settings['turbootp_apikey'];
            $apiUrl = "https://turbootp.com/api/cancle-orders/$api_key/$orderId";
    
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
           // var_dump($result);
           // die();
    
            if ($result === FALSE) {
                $error = curl_error($ch);
                throw new \Exception("cURL error: $error");
            } else {
                $responseData = json_decode($result, true);
    
                if (isset($responseData['success']) && $responseData['success']) {
                    $orderModel = new OrderModel();
                    $refundorder = $orderModel
                        ->where('order_id', $orderId)->first();
    
                    $userModel = new UserModel();
                    $user = $userModel->find($refundorder['user_id']);
    
                    if ($user) {
                        $newBalance = $user['balance'] + $refundorder['price'];
    
                        $updateBalance = $userModel->update($refundorder['user_id'], ['balance' => $newBalance]);
    
                        if ($updateBalance) {
                            $riwayatSaldoModel = new RiwayatSaldoModel();
                            $riwayatData = [
                                'user_id' => $user['id'],
                                'tanggal' => date('Y-m-d H:i:s'),
                                'catatan' => 'Pengembalian saldo orderID ' . $orderId,
                                'jumlah' => $refundorder['price'],
                                'saldo_awal' => $user['balance'],
                                'saldo_akhir' => $newBalance,
                                'tipe' => 'Penambahan',
                            ];
                            $riwayatSaldoModel->insertRiwayatSaldo($riwayatData);
    
                            session()->setFlashdata('success', 'Pesanan berhasil dibatalkan');
                        } else {
                            throw new \Exception('Gagal memperbarui saldo pengguna');
                        }
                    } else {
                        throw new \Exception('Pengguna tidak ditemukan');
                    }
    
                    $orderModel->updateStatusCancel($orderId, 'Cancel');
                } else {
                    $errorMessage = isset($responseData['data']['messages']) ? $responseData['data']['msg'] : 'Unknown error';
                    throw new \Exception($errorMessage);
                }
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        } finally {
            curl_close($ch);
        }
    
        return redirect()->back();
    }
    
    public function retryOrder($orderId)
    {
      $orderModel = new OrderModel();
      $retryorder = $orderModel
        ->where('order_id', $orderId)->set(['sms' => 'resending', 'status' => '1'])->update();
      session()->setFlashdata('success', 'OTP berhasil di resend');
    
        return redirect()->back();
    }
    
    public function doneOrder($orderId)
    {
        $settings = $this->getSettingsData();
            $api_key = $settings['turbootp_apikey'];
            $apiUrl = "https://turbootp.com/api/finish-orders/$api_key/$orderId";
    
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
    
        if ($result === FALSE) {
            $error = curl_error($ch);
            session()->setFlashdata('error', "Kesalahan cURL: $error");
        } else {
            $responseData = json_decode($result, true);
    
            if (isset($responseData['success']) && $responseData['success']) {
                $orderModel = new OrderModel();
                $orderModel->updateStatusDone($orderId, 'done');
    
                session()->setFlashdata('success', 'Pesanan berhasil di selesaikan.');
            } else {
                $this->session->setFlashdata('error', 'Error: ' . $responseData['msg']);
            }
        }
        curl_close($ch);
        return redirect()->back();
    }

}