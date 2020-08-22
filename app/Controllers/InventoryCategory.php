<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\InventoryCategoryModel;
use CodeIgniter\I18n\Time;

class InventoryCategory extends Controller
{
    var $time, $title, $inventory_category = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'Inventory Category';
        $this->inventory_category = new InventoryCategoryModel();
    }


    public function index()
    {
        $data = [
            'title' => $this->title,
            'inventory_category'  => $this->inventory_category->orderBy('inventory_category_id', 'asc')->findAll(),
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/category/category', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $this->inventory_category->insert([
                'inventory_category_name' => $this->request->getPost('name'),
            ]);
            return redirect()->to('/inventory/category');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/category/category_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getVar()) {
            $this->inventory_category->save(
                [
                    'inventory_category_id' => $id,
                    'inventory_category_name' => $this->request->getVar('name')
                ]
            );
            return redirect()->to('/inventory/category');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'inventory_category' => $this->inventory_category->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/category/category_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->inventory_category->delete($id);
        return redirect()->to('/inventory/category');
    }
}
