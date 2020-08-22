<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RecipeModel;
use App\Models\RecipeItemModel;
use App\Models\ItemModel;
use App\Models\InventoryModel;
use CodeIgniter\I18n\Time;

class Recipe extends Controller
{
    var $time, $title, $recipe, $recipe_item, $item = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'Recipe';
        $this->recipe = new RecipeModel();
        $this->item = new ItemModel();
        $this->inventory = new InventoryModel();
        $this->recipe_item = new RecipeItemModel();
    }


    public function index()
    {
        $data = [
            'title' => $this->title,
            'recipes'  => $this->recipe->get_recipe_all(),
            'recipe_item' => $this->recipe_item,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/recipe/recipe', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $saveId = $this->recipe->insert([
                'item_id' => $this->request->getPost('item_id'),
            ]);

            $i_ids = $this->request->getPost('inventory_id');
            $i_qty = $this->request->getPost('quantity');

            foreach ($this->request->getPost('inventory_id') as $key => $value) {
                $this->recipe_item->insert([
                    'recipe_id' => $saveId,
                    'inventory_id' => $i_ids[$key],
                    'recipe_item_quantity' => $i_qty[$key]
                ]);
            }
            return redirect()->to('/inventory');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'items' => $this->item->findAll(),
            'inventory' => $this->inventory->get_inventory(),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/recipe/recipe_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $this->recipe->save([
                'recipe_id' => $id,
                'item_id' => $this->request->getPost('item_id'),
            ]);

            $i_ids = $this->request->getPost('inventory_id');
            $i_qty = $this->request->getPost('quantity');

            $this->recipe_item->where('recipe_id', $id)->delete();

            foreach ($this->request->getPost('inventory_id') as $key => $value) {
                $this->recipe_item->insert([
                    'recipe_id' => $id,
                    'inventory_id' => $i_ids[$key],
                    'recipe_item_quantity' => $i_qty[$key]
                ]);
            }
            return redirect()->to('/inventory/recipe');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'items' => $this->item->findAll(),
            'inventory' => $this->inventory->get_inventory(),
            'recipe' => $this->recipe->find($id),
            'recipe_items' => $this->recipe_item->get_recipe_item($id),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/recipe/recipe_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->recipe->delete($id);
        $this->recipe_item->where('recipe_id', $id)->delete();
        return redirect()->to('/inventory/recipe');
    }
}
