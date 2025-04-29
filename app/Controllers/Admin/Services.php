<?php

namespace App\Controllers\Admin;

use App\Models\turbootp\ServicesModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Session\Session;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\ConnectionInterface;

class Services extends BaseController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->session = session();
        $this->session = \Config\Services::session();
    }
    
    public function index()
    {
      if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
      
      if ($this->session->get('role') != 1) {
        return redirect()->to('/');
      }
        
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);

        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'currentSegment' => $currentSegment,
        ];

        return view('admin/services', $data);
    }
    
    public function getDataServices()
    {
        $draw = $this->request->getGet('draw');
        $start = $this->request->getGet('start');
        $length = $this->request->getGet('length');
        $searchValue = $this->request->getGet('search')['value'];
    
        $servicesModel = new ServicesModel();
        $builder = $servicesModel->builder();
    
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('service_id', $searchValue)
                ->orLike('service_name', $searchValue)
                ->orLike('price_provider', $searchValue)
                ->orLike('price', $searchValue)
                ->orLike('profit', $searchValue)
                ->orLike('service_update', $searchValue)
                ->groupEnd();
        }
    
        $total = $builder->countAllResults();
    
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('service_id', $searchValue)
                ->orLike('service_name', $searchValue)
                ->orLike('price_provider', $searchValue)
                ->orLike('price', $searchValue)
                ->orLike('profit', $searchValue)
                ->orLike('service_update', $searchValue)
                ->groupEnd();
        }
    
        $services = $builder
            ->limit($length, $start)
            ->get()
            ->getResult();
    
        $response = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $services,
        ];
    
        return $this->response->setJSON($response);
    }
    
    public function update($id)
    {
        $servicesModel = new ServicesModel();
        $service = $servicesModel->find($id);
    
        if (empty($service)) {
            return redirect()->to('/admin/services')->with('error', 'Layanan tidak ditemukan');
        }
    
        $services = $servicesModel->findAll();
        
        $settings = $this->getSettingsData();
    
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'service_name' => 'required',
                'price' => 'required|numeric',
                'profit' => 'required|numeric',
            ]);
    
            if ($validation->withRequest($this->request)->run()) {
    
                $data = [
                    'service_name' => $this->request->getPost('service_name'),
                    'price' => $this->request->getPost('price'),
                    'profit' => $this->request->getPost('profit'),
                    'service_update' => date('Y-m-d H:i:s'),
                ];
    
                $servicesModel->update($id, $data);
    
                session()->setFlashdata('success', 'Layanan berhasil diperbarui');
    
                return redirect()->to('/admin/services');
            }
        }
        
        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'services' => $services,
        ];
    
        return view('admin/services', $data);
    }
        
    public function delete($id)
    {
        $servicesModel = new ServicesModel();
        $service = $servicesModel->find($id);
    
        if ($service) {
            $servicesModel->delete($id);
            session()->setFlashdata('success', 'Service deleted successfully');
        } else {
            session()->setFlashdata('error', 'Service not found');
        }
    
        return redirect()->to('/admin/services');
    }
    
    public function getServices()
   {
    
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

        return redirect()->to('/admin/services');
    } else {
       session()->setFlashdata('error', "Gagal mendapatkan data dari provider.");

        return redirect()->to('/admin/services');
    }
}
    
}