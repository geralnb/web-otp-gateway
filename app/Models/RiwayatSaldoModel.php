<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatSaldoModel extends Model
{
    protected $table = 'riwayat_saldo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'tanggal', 'catatan', 'jumlah', 'saldo_awal', 'saldo_akhir', 'tipe'];
    
    public function insertRiwayatSaldo($data)
    {
        return $this->insert($data);
    }
    
    public function getRiwayatSaldoByUserId($userId) { 
        return $this->where('user_id', $userId)
                    ->orderBy('tanggal', 'DESC')
                    ->findAll();
    }
}