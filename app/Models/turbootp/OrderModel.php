<?php

namespace App\Models\turbootp;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders_turbootp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'user_id', 'service_name', 'operator_name', 'country', 'number', 'price', 'profit', 'status', 'sms', 'status_sms', 'last_sms', 'created_at'];

    public function getOrdersByUserId($userId) { 
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
    
    public function getNewOrdersByUserId($userId)
    {
        $twentyMinutesAgo = date('Y-m-d H:i:s', strtotime('-20 minutes'));
    
        return $this->where('user_id', $userId)
                    ->whereIn('status', ['1', '2', '3'])
                    ->where('created_at >=', $twentyMinutesAgo)
                    ->findAll();
    }

    public function getOrdersByStatus($status)
    {
        return $this->whereIn('status', $status)->findAll();
    }
    
    public function getAllOrders()
    {
        return $this->findAll();
    }
    
    public function updateStatusCancel($orderId, $status)
    {
        $existingOrder = $this->where('order_id', $orderId)->first();
    
        if ($existingOrder) {
            $this->set(['status' => $status])->where('order_id', $orderId)->update();
    
            if ($status === 'Cancel') {
                $this->where('order_id', $orderId)->delete();
            }
        }
    }
    
    public function updateStatusRefund($orderId, $status)
    {
        $existingOrder = $this->where('order_id', $orderId)->first();
    
        if ($existingOrder) {
            $this->set(['status' => $status,'sms' => 'canceled'])->where('order_id', $orderId)->update();
        }
      
    }
    
    public function updateStatusDone($orderId, $status)
    {
        $existingOrder = $this->where('order_id', $orderId)->first();
    
        if ($existingOrder) {
            $this->set(['status' => $status])->where('order_id', $orderId)->update();
        }
    }
    
    public function updateStatusWaitingRetry($orderId, $status)
    {
        $existingOrder = $this->where('order_id', $orderId)->first();
    
        if ($existingOrder) {
            $this->set(['status' => $status])->where('order_id', $orderId)->update();
        }
    }
    
    public function getRefundOrders()
    {
        $duaSatuMenitYangLalu = date('Y-m-d H:i:s', strtotime('-20 minutes'));
    
        return $this->where(['sms' => 'waiting'])
        ->where('created_at <', $duaSatuMenitYangLalu)
                    ->findAll();
    }
    
    public function getDoneOrdersToday()
    {
        $today = date('Y-m-d');
        $result = $this->selectCount('id')
                       ->where('status', 'done')
                       ->where('DATE(created_at)', $today)
                       ->get()
                       ->getRowArray();
    
        return !empty($result) ? $result['id'] : 0;
    }
    
    public function getCancelOrdersToday()
    {
        $today = date('Y-m-d');
        $result = $this->selectCount('id')->where('status', 'refund')->where('DATE(created_at)', $today)->get()->getRowArray();
    
        return !empty($result) ? $result['id'] : 0;
    }
    
    public function getDoneOrders()
    {
        $result = $this->selectCount('id')->where('status', 'done')->get()->getRowArray();
    
        return !empty($result) ? $result['id'] : 0;
    }
    
    public function getCancelOrders()
    {
        $result = $this->selectCount('id')->where('status', 'refund')->get()->getRowArray();
    
        return !empty($result) ? $result['id'] : 0;
    }
    
    public function getTotalProfitDoneOrders()
    {
        $result = $this->selectSum('profit')->where('status', 'done')->get()->getRowArray();
    
        return !empty($result) ? $result['profit'] : 0;
    }
    
    public function getTotalProfitDoneOrdersToday()
    {
        $today = date('Y-m-d');
        $result = $this->selectSum('profit')->where('status', 'done')->where('DATE(created_at)', $today)->get()->getRowArray();
    
        return !empty($result) ? $result['profit'] : 0;
    }
    
    public function getTotalPriceDoneOrdersToday()
    {
        $today = date('Y-m-d');
        $result = $this->selectSum('price')->where('status', 'done')->where('DATE(created_at)', $today)->get()->getRowArray();
    
        return !empty($result) ? $result['price'] : 0;
    }
    
    public function getTotalPriceDoneOrders()
    {
        $result = $this->selectSum('price')->where('status', 'done')->get()->getRowArray();
    
        return !empty($result) ? $result['price'] : 0;
    }

    public function getTotalOrderByUser($userId)
    {
        return $this->where('user_id', $userId)->where('status', 'done')->countAllResults();
    }
    
    public function getTotalPriceByUserAndStatus($userId)
    {
        $query = $this->selectSum('price', 'total_price')
                      ->where('user_id', $userId)
                      ->where('status', 'done')
                      ->get();
    
        $result = $query->getRow();
        
        return $result ? $result->total_price : 0;
    }
    
}