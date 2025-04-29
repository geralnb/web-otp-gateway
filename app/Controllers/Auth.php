<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
      $settings = $this->getSettingsData();
      
      $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
      $settings = $this->getSettingsData();
      
      $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
        ];
        
        return view('auth/register', $data);
    }

    public function valid_register()
    {
        $data = $this->request->getPost();
    
        $data['username'] = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
        $data['no_wa'] = htmlspecialchars($data['no_wa'], ENT_QUOTES, 'UTF-8');
        $data['password'] = htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8');
    
        $this->validation->run($data, 'register');
    
        $errors = $this->validation->getErrors();
        if ($errors) {
            session()->setFlashdata('error', $errors);
            return redirect()->to('/auth/register');
        }
    
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
    
        $this->UserModel->save([
            'username' => $data['username'],
            'no_wa' => $data['no_wa'],
            'password' => $hashedPassword,
            'balance' => 0,
            'role' => 2,
            'date_create' => date('Y-m-d H:i:s')
        ]);
    
        session()->setFlashdata('login', 'Anda berhasil mendaftar, silahkan login');
        return redirect()->to('/auth/login');
    }

    public function valid_login()
    {
        $data = $this->request->getPost();
    
        $data['username'] = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
        $data['password'] = htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8');
    
        $user = $this->UserModel->where('username', $data['username'])->first();
    
        if ($user) {
            if (password_verify($data['password'], $user['password'])) {
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set($sessLogin);
    
                if ($user['role'] == 1) {
                    return redirect()->to('/admin/');
                } else {
                    session()->setFlashdata('success', 'Selamat datang '  . $user['username']);
                    return redirect()->to('/user');
                }
            } else {
                session()->setFlashdata('password', 'Password salah');
                return redirect()->to('/auth/login');
            }
        } else {
            session()->setFlashdata('username', 'Username tidak ditemukan');
            return redirect()->to('/auth/login');
        }
    }

    public function forgotPassword()
    {
        $settings = $this->getSettingsData();
        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
        ];
    
        return view('auth/reset-password', $data);
    }
    
    public function valid_reset()
    {
        $nomorTelepon = htmlspecialchars($this->request->getPost('nomor_telepon'));
        $user = $this->UserModel->where('no_wa', $nomorTelepon)->first();
    
        if ($user) {
            $lastResetTime = strtotime($user['last_reset_time']);
            $current_time = time();
            $resetTimeLimit = 15 * 60;
    
            if (($current_time - $lastResetTime) < $resetTimeLimit) {
                session()->setFlashdata('error', 'Anda sudah melakukan reset password, Tunggu beberapa saat sebelum mencoba lagi.');
                return redirect()->to('/auth/reset-password');
            }
    
            $otp = rand(100000, 999999);
            $this->session->set('password_reset_otp', $otp);
            $this->session->set('reset_user_telephone', $nomorTelepon);
            $this->UserModel->update($user['id'], ['last_reset_time' => date('Y-m-d H:i:s')]);
    
            $pesan = "kode OTP untuk reset password Anda adalah: $otp";
            $this->kirimWhatsAppOTP($nomorTelepon, $pesan);
    
            session()->setFlashdata('success', 'OTP berhasil dikirim ke nomor WhatsApp Anda');
            return redirect()->to('/auth/verify-otp');
        } else {
            session()->setFlashdata('error', 'Nomor WhatsApp tidak ditemukan');
            return redirect()->to('/auth/reset-password');
        }
    }
    
    private function kirimWhatsAppOTP($nomorTelepon, $pesan)
    {
        $settings = $this->getSettingsData();
        $curl = curl_init();
    
        $data = array(
            'target' => $nomorTelepon,
            'message' => $pesan,
        );
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array('Authorization: ' . $settings['fonnte_apikey']
),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
    
        return $response;
    }
    
    public function verifyOTP()
    {
        $settings = $this->getSettingsData();
        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
        ];
    
        return view('auth/verify-otp', $data);
    }
    
    public function valid_verifyOTP()
    {
        $otpDimasukkan = htmlspecialchars($this->request->getPost('otp'));
        $otpDisimpan = $this->session->get('password_reset_otp');
    
        if ($otpDimasukkan == $otpDisimpan) {
            session()->setFlashdata('success', 'Kode OTP Terverifikasi');
            return redirect()->to('/auth/new-password');
        } else {
            session()->setFlashdata('error', 'Kode OTP salah');
            return redirect()->to('/auth/verify-otp');
        }
    }
    
    public function newPassword()
    {
        if (!$this->session->has('reset_user_telephone')) {
            session()->setFlashdata('error', 'Nomor telepon tidak ditemukan');
            return redirect()->to('/auth/reset-password');
        }
    
        $settings = $this->getSettingsData();
        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
        ];
    
        return view('auth/new-password', $data);
    }
    
    public function resetPassword()
    {
        $newPassword = htmlspecialchars($this->request->getPost('new_password'));
        $confirmPassword = htmlspecialchars($this->request->getPost('confirm_password'));
    
        if (strlen($newPassword) < 6) {
            session()->setFlashdata('error', 'Password harus memiliki setidaknya 6 karakter');
            return redirect()->to('/auth/new-password');
        }
    
        if ($newPassword !== $confirmPassword) {
            session()->setFlashdata('error', 'Password baru tidak sesuai dengan konfirmasi Password');
            return redirect()->to('/auth/new-password');
        }
    
        $userModel = new UserModel();
        $userData = $userModel->where('no_wa', session()->get('reset_user_telephone'))->first();
    
        if ($userData) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $userModel->update($userData['id'], ['password' => $hashedPassword]);
    
            session()->setFlashdata('success', 'Password berhasil direset. Silakan login dengan password baru Anda');
            return redirect()->to('/auth/login');
        } else {
            session()->setFlashdata('error', 'Data pengguna tidak ditemukan');
            return redirect()->to('/auth/new-password');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}