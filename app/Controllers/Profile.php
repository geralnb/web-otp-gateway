<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile extends BaseController
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
    
        $username = $this->session->get('username');
        $user = $this->userModel->where('username', $username)->first();
        
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);
    
        $userData = [
            'username' => $user['username'],
            'balance' => $user['balance'],
            'no_wa' => $user['no_wa'],
            'date_create' => $user['date_create'],
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
            'currentSegment' => $currentSegment,
        ];
    
        return view('user/profile', $userData);
    }

    public function updatePassword()
    {
        $username = $this->session->get('username');
        $user = $this->userModel->where('username', $username)->first();
    
        if (!$this->verifyCurrentPassword(htmlspecialchars($this->request->getPost('current_password'), ENT_QUOTES, 'UTF-8'), $user['password'])) {
            $this->session->setFlashdata('error', 'Password saat ini tidak valid.');
            return redirect()->to(base_url('profile'))->withInput();
        }
    
        $validation = \Config\Services::validation();
        $validation->setRules([
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            $validationErrors = $validation->getErrors();
    
            if (isset($validationErrors['new_password'])) {
                $this->session->setFlashdata('error', 'Password harus memiliki setidaknya 6 karakter.');
            }
    
            if (isset($validationErrors['confirm_password'])) {
                $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai.');
            }
    
            return redirect()->to(base_url('profile'))->withInput()->with('errors', $validationErrors);
        }
    
        $this->userModel->updateUserPassword($user['id'], htmlspecialchars($this->request->getPost('new_password'), ENT_QUOTES, 'UTF-8'));
    
        $this->session->setFlashdata('success', 'Password berhasil diperbarui.');
        return redirect()->to(base_url('profile'));
    }
    
    private function verifyCurrentPassword($currentPassword, $hashedPassword)
    {
        return password_verify($currentPassword, $hashedPassword);
    }
}