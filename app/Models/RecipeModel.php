<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = 'recipe';
    protected $primaryKey = 'recipe_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'item_id',
    ];

    var $db = null;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    public function get_recipe_all()
    {
        $recipe = $this->db->table('recipe');
        $recipe = $recipe->select('*')->join('items', 'items.item_id=recipe.item_id')->get();
        $recipe = $recipe->getResult('array');
        return $recipe;
    }

    public function get_recipe_by_id($recipe_id)
    {
        $recipe = $this->db->table('recipe');
        $recipe = $recipe->select('*')->where('recipe_id', $recipe_id)
            ->join('items', 'items.item_id=recipe.item_id')->get();
        $recipe = $recipe->getResult('array');
        return $recipe;
    }
}
