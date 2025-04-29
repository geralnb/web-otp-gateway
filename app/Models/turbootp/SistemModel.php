<?php

namespace App\Models\turbootp;

use CodeIgniter\Model;

class SistemModel extends Model
{
    protected $table = 'services_turbootp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['service_id', 'service_name', 'price', 'profit', 'stock', 'service_update'];
}