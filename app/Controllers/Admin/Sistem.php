<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\otpweb\SistemModel;
use App\Models\otpweb\ServicesModel;
use App\Models\otpweb\OrderModel;
use App\Models\otpweb\CountryModel;
use App\Models\otpweb\OperatorsModel;
use App\Models\UserModel;
use App\Models\RiwayatSaldoModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Session\Session;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\ConnectionInterface;

class Sistem extends BaseController
{
 
    use ResponseTrait;

    public function __construct(ConnectionInterface &$db = null)
    {
        $this->db = &$db;
        $this->session = session();
        $this->session = \Config\Services::session();
    }
    
public function getServices()
{
    if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
      
      if ($this->session->get('role') != 1) {
        return redirect()->to('/');
      }
    
    $country = htmlspecialchars($this->request->getPost('country_id'), ENT_QUOTES, 'UTF-8');
    $settings = $this->getSettingsData();
    $api_key = $settings['otpweb_apikey'];
    $endpoint = "https://otpweb.com/api?api_key=$api_key&action=get_service&country_id=$country";

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['status']) && $data['status'] === true) {
        $servicesModel = new ServicesModel();

        foreach ($data['data'] as $service) {
            $profitMargin = ($service['cost'] * $settings['profit'] / 100);
            $insertData = [
                'service_id' => $service['service_id'],
                'service_name' => $service['service_name'],
                'country_id' => $country,
                'price_provider' => $service['cost'],
                'price' => $service['cost'] + $profitMargin,
                'stock' => $service['count'],
                'profit' => $profitMargin,
                'service_update' => date('Y-m-d')
            ];

            $existingData = $servicesModel
                ->where('service_id', $service['service_id'])
                ->where('country_id', $insertData['country_id'])
                ->first();

            if ($existingData) {
                try {
                    $servicesModel
                        ->where('id', $existingData['id'])
                        ->update($insertData);

                    $this->session->setFlashdata('success', "Data berhasil diupdate ke database.");
                } catch (\Exception $e) {
                    $this->session->setFlashdata('error', "Gagal mengupdate data ke database: " . $e->getMessage());
                }
            } else {
                try {
                    $servicesModel->insert($insertData);

                    $this->session->setFlashdata('success', "Data berhasil disimpan ke database.");
                } catch (\Exception $e) {
                    
                    $this->session->setFlashdata('error', "Gagal menyimpan data ke database: " . $e->getMessage());
                }
            }
        }

        $services = $servicesModel->findAll();

        return redirect()->to('/admin/services')->with('services', $services);
    } else {
       session()->setFlashdata('error', "Gagal mendapatkan data dari provider.");

        return redirect()->to('/admin/services');
    }
}
    
}