<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryDistributorModel extends Model
{
    protected $table = 'inventory_distributor';
    protected $primaryKey = 'inventory_distributor_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'inventory_distributor_name',
        'inventory_distributor_abbr',
        'inventory_distributor_contact',
        'inventory_distributor_phone',
        'inventory_distributor_email'
    ];
}
