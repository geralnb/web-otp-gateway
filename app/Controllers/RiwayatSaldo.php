<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RiwayatSaldoModel;

class RiwayatSaldo extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->riwayatSaldoModel = new RiwayatSaldoModel();
    }

    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
    
        $riwayatSaldoModel = new RiwayatSaldoModel();
    
        $userModel = new UserModel();
        $username = $this->session->get('username');
        $user = $userModel->where('username', $username)->first();
    
        if (!empty($user) && isset($user['id'])) {
            $data['riwayat'] = $riwayatSaldoModel->getRiwayatSaldoByUserId($user['id']);
        } else {
            $data['riwayat'] = [];
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
    
        return view('user/riwayat-saldo', $data);
    }

}