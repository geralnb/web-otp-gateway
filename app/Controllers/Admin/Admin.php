<?php

namespace App\Controllers\Admin;

use App\Models\turbootp\OrderModel;
use App\Models\UserModel;
use App\Models\DepositModel;
use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->orderModel = new OrderModel();
        $this->userModel = new UserModel();
        $this->depositModel = new DepositModel();
    }

    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }

        if ($this->session->get('role') != 1) {
            return redirect()->to('/user');
        }

        $doneOrdersToday = $this->orderModel->getDoneOrdersToday();
        $doneOrders = $doneOrdersToday;
        
        $doneOrdersAlls = $this->orderModel->getDoneOrders();
        $doneOrdersAll = $doneOrdersAlls;
        
        $totalProfitToday = $this->orderModel->getTotalProfitDoneOrdersToday();
        $totalProfitDoneOrdersToday = $totalProfitToday;
        
        $totalPriceToday = $this->orderModel->getTotalPriceDoneOrdersToday();
        $totalPriceDoneOrdersToday = $totalPriceToday;
        
        $totalPriceAll = $this->orderModel->getTotalPriceDoneOrders();
        $totalPriceProfitDoneOrdersAll = $totalPriceAll;
        
        $totalProfitDoneOrdersAll = $this->orderModel->getTotalProfitDoneOrders();
        $totalProfitDoneOrders = $totalProfitDoneOrdersAll;
        
        $totalUsersToday = $this->userModel->getTotalUsersToday();
        $totalUsers = $this->userModel->getTotalUsers();
        $totalDeposit = $this->depositModel->getPaidDeposit();
        $totalSaldo = $this->userModel->getTotalSaldo();
        
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);
        
        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'doneOrders' => $doneOrders,
            'doneOrdersAll' => $doneOrdersAll,
            'totalProfitDoneOrders' => $totalProfitDoneOrders,
            'totalProfitDoneOrdersToday' => $totalProfitDoneOrdersToday,
            'totalPriceDoneOrdersToday' => $totalPriceDoneOrdersToday,
            'totalPriceProfitDoneOrdersAll' => $totalPriceProfitDoneOrdersAll,
            'totalUsers' => $totalUsers,
            'totalUsersToday' => $totalUsersToday,
            'totalDeposit' => $totalDeposit,
            'totalSaldo' => $totalSaldo,
            'currentSegment' => $currentSegment,
        ];

        return view('admin/index', $data);
    }
}