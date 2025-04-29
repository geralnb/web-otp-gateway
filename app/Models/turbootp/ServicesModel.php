<?php

namespace App\Models\turbootp;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $table = 'services_turbootp';
    protected $primaryKey = 'id';

    protected $allowedFields = ['service_id', 'service_name', 'country_id', 'price_provider', 'price', 'profit', 'stock', 'service_update'];

    public function getProfitByServiceId($serviceId)
    {
        $service = $this->where('service_id', $serviceId)->first();

        if ($service) {
            return $service['profit'];
        }

        return 0;
    }

    public function updateService($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteService($id)
    {
        return $this->delete($id);
    }
}