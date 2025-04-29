<?php

namespace App\Models;

use CodeIgniter\Model;

class DepositModel extends Model
{
    protected $table = 'deposits';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'username', 'no_inv', 'method', 'payment_code', 'amount', 'status', 'transaction_date'];

    public function saveDeposit($data)
    {
        return $this->insert($data);
    }
    
    public function getTotalDepositByUser($userId)
    {
        return $this->where('user_id', $userId)->where('status', 'PAID')->countAllResults();
    }
    
    public function getTotalDepositByUserAndStatus($userId)
    {
        $query = $this->selectSum('amount', 'total_amount')
                      ->where('user_id', $userId)
                      ->where('status', 'PAID')
                      ->get();
    
        $result = $query->getRow();
        
        return $result ? $result->total_amount : 0;
    }

    public function getPaidDeposit()
        {
            $result = $this->selectSum('amount')->where('status', 'paid')->get()->getRowArray();
        
            return !empty($result) ? $result['amount'] : 0;
        }
    
}