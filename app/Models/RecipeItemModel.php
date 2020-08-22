<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeItemModel extends Model
{
    protected $table = 'recipe_items';
    protected $primaryKey = 'recipe_item_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'recipe_id',
        'inventory_id',
        'recipe_item_quantity',
    ];

    var $db = null;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    public function get_recipe_item($id)
    {
        $recipe = $this->db->table('recipe_items');
        $recipe = $recipe->select('*')->where('recipe_id', $id)
            ->join('inventory', 'inventory.inventory_id=recipe_items.inventory_id')->get();
        $recipe = $recipe->getResult('array');
        return $recipe;
    }
}
