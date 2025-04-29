<?php

namespace App\Controllers;

use App\Models\DepositModel;
use App\Models\UserModel;

class Deposits extends BaseController
{
    protected $session;
    protected $userModel;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->depositModel = new DepositModel();
    }
    
    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }

        $username = $this->session->get('username');
        $userData = $this->userModel->where('username', $username)->first();
        
        $dataDeposit = $this->depositModel
                ->where('user_id', $userData['id'])
                ->orderBy('transaction_date', 'DESC')
                ->findAll();

        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);
    
        $data = [
            'username' => $userData['username'],
            'balance' => $userData['balance'],
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
            'datadeposit' => $dataDeposit,
            'currentSegment' => $currentSegment,
        ];
        
        return view('user/deposit', $data);
    }

    public function deposit()
    {
        $userSudahLogin = $this->session->has('isLogin');
        
        $username = $this->session->get('username');
        $userData = $this->userModel->where('username', $username)->first();
    
            $uniqueInvID = false;
            $maxAttempts = 10;
            
            for ($i = 0; $i < $maxAttempts; $i++) {
                $invID = rand(1000000, 9999999);
            
                $existingInv = $this->depositModel->where('no_inv', $invID)->first();
            
                if (!$existingInv) {
                    $uniqueInvID = true;
                    break;
                }
            }
            
            if (!$uniqueInvID) {
                throw new \Exception('Gagal mendapatkan nomor pesanan unik setelah sejumlah percobaan, hubungi administrator!!.');
            }
            
            $settings = $this->getSettingsData();
            
            $amountDeposit = $this->request->getPost('amount');

            if (!is_numeric($amountDeposit) || $amountDeposit <= 0) {
                throw new \Exception('Jumlah deposit tidak valid.');
            }
            
            $apiKey = $settings['paydisini_apikey'];
            $uniqueCode = $invID;
            $service = '11';
            $amount = $amountDeposit;
            $typeFee = '1';
            $note = 'Deposit';
            $validTime = '1800';
            
            $signature = md5($apiKey . $uniqueCode . $service . $amount . $validTime . 'NewTransaction');
            
            $data = [
                'key' => $apiKey,
                'request' => 'new',
                'unique_code' => $uniqueCode,
                'service' => $service,
                'amount' => $amount,
                'type_fee' => $typeFee,
                'note' => $note,
                'valid_time' => $validTime,
                'return_url' => base_url('deposit'),
                'signature' => $signature,
            ];
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://paydisini.co.id/api/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
            $headers = [
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.91 Safari/537.36',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            
            $responseData = json_decode($response, true);
            
            if (isset($responseData['success']) && $responseData['success']) {               
                
              $data = [
                  'user_id' => $userData['id'],
                  'username' => $userData['username'],
                  'no_inv' => $responseData['data']['unique_code'],
                  'method' => 'QRIS',
                  'payment_code' => $responseData['data']['checkout_url'],
                  'amount' => $amount,
                  'status' => 'UNPAID',
                  'transaction_date' => date('Y-m-d H:i:s'),
              ];
      
              $this->depositModel->insert($data);
              
            $this->session->setFlashdata('success', 'Deposit berhasil dibuat.');
    
            if (isset($responseData['data']['checkout_url'])) {
                  return redirect()->to($responseData['data']['checkout_url']);
              } else {
                  $this->session->setFlashdata('error', 'Error: Data pembayaran tidak valid.');
              }
            } else {
                $this->session->setFlashdata('error', 'Tripay Error: ' . $responseData['message']);
  
                return redirect()->back();
            }
            
    }

}