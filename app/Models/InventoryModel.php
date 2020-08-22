<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'inventory_code',
        'inventory_desc',
        'inventory_unit',
        'inventory_price',
        'inventory_item_unit',
        'inventory_item_amount',
        'inventory_stock',
        'inventory_stock_threshold',
        'inventory_distributor_id',
        'inventory_category_id'
    ];

    var $db = null;


    public function get_inventory()
    {
        $this->db = db_connect();
        $inventory = $this->db->table('inventory');
        $inventory = $inventory->select('*')
            ->join('inventory_category', 'inventory_category.inventory_category_id = inventory.inventory_category_id')
            ->join('inventory_distributor', 'inventory_distributor.inventory_distributor_id = inventory.inventory_distributor_id')->get();
        $inventory = $inventory->getResult('array');

        return $inventory;
    }
}
