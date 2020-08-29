<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryCategoryModel extends Model
{
    protected $table = 'inventory_category';
    protected $primaryKey = 'inventory_category_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'inventory_category_name',
    ];
}
