<?php

namespace App\Controllers\Admin;

use App\Models\turbootp\OrderModel;
use App\Controllers\BaseController;

class Orders extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }
    
    public function index()
    {
      if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
      
      if ($this->session->get('role') != 1) {
        return redirect()->to('/');
      }
        
        $orderModel = new OrderModel();
        $orders = $orderModel->findAll();
        
        $settings = $this->getSettingsData();
        $currentSegment = $this->request->uri->getSegment(1);
        
        $totalPrice = $orderModel->getTotalPriceDoneOrders();
        $totalOrders = $orderModel->getDoneOrders();


        $data = [
            'web_logo' => $settings['web_logo'],
            'web_icon' => $settings['web_icon'],
            'web_title' => $settings['web_title'],
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'totalPrice' => $totalPrice,
            'currentSegment' => $currentSegment,
        ];

        return view('admin/orders', $data);
    }
    
    public function update($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if (empty($order)) {
            return redirect()->to('/admin/orders')->with('error', 'Order not found');
        }

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'service_name' => 'required',
                'service_id' => 'required|numeric',
                'operator_name' => 'required',
                'country' => 'required',
                'number' => 'required',
                'price' => 'required|numeric',
                'profit' => 'required|numeric',
                'status' => 'required',
                'sms' => 'required',
            ]);

            if ($validation->withRequest($this->request)->run()) {
                $data = [
                    'service_name' => $this->request->getPost('service_name'),
                    'service_id' => $this->request->getPost('service_id'),
                    'operator_name' => $this->request->getPost('operator_name'),
                    'country' => $this->request->getPost('country'),
                    'number' => $this->request->getPost('number'),
                    'price' => $this->request->getPost('price'),
                    'profit' => $this->request->getPost('profit'),
                    'status' => $this->request->getPost('status'),
                    'sms' => $this->request->getPost('sms'),
                ];

                $orderModel->update($id, $data);

                session()->setFlashdata('success', 'Order updated successfully');
                return redirect()->to('/admin/orders');
            }
        }

        $data = [
            'order' => $order,
        ];

        return view('admin/orders', $data);
    }
    
    public function delete($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($id);

        if ($order) {
            $orderModel->delete($id);
            session()->setFlashdata('success', 'Data order berhasil dihapus');
            return redirect()->to('/admin/orders');
        }

        session()->setFlashdata('error', 'Data order tidak ditemukan');
        return redirect()->to('/admin/orders');
    }
    
}