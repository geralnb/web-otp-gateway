<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\turbootp\OrderModel;
use App\Models\DepositModel;

class User extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->orderTurboOtpModel = new OrderModel();
        $this->depositModel = new DepositModel();
    }

    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
    
        $username = $this->session->get('username');
        $userData = $this->userModel->where('username', $username)->first();
        
        if ($userData) {
            $userId = $userData['id'];
        } else {
          return redirect()->to('/auth/login');
        }

        $orderModel = new OrderModel();
        
        $totalOrdersByUser = $orderModel->getTotalOrderByUser($userId);
        $totalOrders = $totalOrdersByUser;
        
        $totalPriceByUser = $orderModel->getTotalPriceByUserAndStatus($userId);
        $totalPrice = $totalPriceByUser;
        
        $depositModel = new DepositModel();
        $totalDeposit = $depositModel->getTotalDepositByUser($userId);
        $totalAmountDeposit = $depositModel->getTotalDepositByUserAndStatus($userId);

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
            'totalOrders' => $totalOrders,
            'totalDeposit' => $totalDeposit,
            'totalPrice' => $totalPrice,
            'totalAmountDeposit' => $totalAmountDeposit,
            'currentSegment' => $currentSegment,
        ];
    
        return view('user/index', $data);
    }
}