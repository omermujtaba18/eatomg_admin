<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\InventoryModel;
use App\Models\InventoryDistributorModel;
use App\Models\InventoryCategoryModel;
use CodeIgniter\I18n\Time;

class Inventory extends Controller
{
    var $time, $title, $inventory,
        $inventory_category, $inventory_distributor = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'Inventory Items';
        $this->inventory = new InventoryModel();
        $this->inventory_category = new InventoryCategoryModel();
        $this->inventory_distributor = new InventoryDistributorModel();
    }


    public function index()
    {
        $data = [
            'title' => $this->title,
            'inventory'  => $this->inventory->get_inventory(),
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/inventory/inventory', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $this->inventory->insert([
                'inventory_code' => $this->request->getPost('code'),
                'inventory_desc' => $this->request->getPost('desc'),
                'inventory_unit' => $this->request->getPost('unit'),
                'inventory_price' => $this->request->getPost('price'),
                'inventory_item_unit' => $this->request->getPost('item_unit'),
                'inventory_item_amount' => $this->request->getPost('item_amount'),
                'inventory_stock' => $this->request->getPost('stock'),
                'inventory_stock_threshold' => $this->request->getPost('threshold'),
                'inventory_distributor_id' => $this->request->getPost('distributor_id'),
                'inventory_category_id' => $this->request->getPost('category_id'),

            ]);
            return redirect()->to('/inventory');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'inventory_distributor' => $this->inventory_distributor->findAll(),
            'inventory_category' => $this->inventory_category->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/inventory/inventory_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $this->inventory->save([
                'inventory_id' => $id,
                'inventory_code' => $this->request->getPost('code'),
                'inventory_desc' => $this->request->getPost('desc'),
                'inventory_unit' => $this->request->getPost('unit'),
                'inventory_price' => $this->request->getPost('price'),
                'inventory_item_unit' => $this->request->getPost('item_unit'),
                'inventory_item_amount' => $this->request->getPost('item_amount'),
                'inventory_stock' => $this->request->getPost('stock'),
                'inventory_stock_threshold' => $this->request->getPost('threshold'),
                'inventory_distributor_id' => $this->request->getPost('distributor_id'),
                'inventory_category_id' => $this->request->getPost('category_id'),

            ]);

            return redirect()->to('/inventory');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'inventory' => $this->inventory->find($id),
            'inventory_distributor' => $this->inventory_distributor->findAll(),
            'inventory_category' => $this->inventory_category->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/inventory/inventory_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->inventory->delete($id);
        return redirect()->to('/inventory');
    }
}
