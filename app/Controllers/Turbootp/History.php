<?php

namespace App\Controllers\Turbootp;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\turbootp\OrderModel;
use App\Controllers\BaseController;

class History extends BaseController
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
    
        $userModel = new UserModel();
        $username = $this->session->get('username');
        $user = $userModel->where('username', $username)->first();
        
        $orderTurboOtpModel = new OrderModel();
        if (!empty($user) && isset($user['id'])) {
            $data['ordersTurboOtp'] = $orderTurboOtpModel->getOrdersByUserId($user['id']);
        } else {
            $data['ordersTurboOtp'] = [];
        }
        
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);
        
        $data += [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'web_author' => $settings['web_author'],
            'web_description' => $settings['web_description'],
            'web_keywords' => $settings['web_keywords'],
            'currentSegment' => $currentSegment,
        ];
    
        return view('user/turbootp/history', $data);
    }

}