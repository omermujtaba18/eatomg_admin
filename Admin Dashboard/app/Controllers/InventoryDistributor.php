<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\InventoryDistributorModel;
use CodeIgniter\I18n\Time;

class InventoryDistributor extends Controller
{
    var $time, $title, $inventory_distributor = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'Inventory Distributor';
        $this->inventory_distributor = new InventoryDistributorModel();
    }


    public function index()
    {
        $data = [
            'title' => $this->title,
            'inventory_distributor'  => $this->inventory_distributor->orderBy('inventory_distributor_id', 'asc')->findAll(),
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/distributor/distributor', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $this->inventory_distributor->insert([
                'inventory_distributor_name' => $this->request->getPost('name'),
                'inventory_distributor_abbr' => $this->request->getPost('abbr'),
                'inventory_distributor_contact' => $this->request->getPost('contact'),
                'inventory_distributor_email' => $this->request->getPost('email'),
                'inventory_distributor_phone' => $this->request->getPost('phone'),
            ]);
            return redirect()->to('/inventory/distributor');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/distributor/distributor_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $this->inventory_distributor->save([
                'inventory_distributor_id' => $id,
                'inventory_distributor_name' => $this->request->getPost('name'),
                'inventory_distributor_abbr' => $this->request->getPost('abbr'),
                'inventory_distributor_contact' => $this->request->getPost('contact'),
                'inventory_distributor_email' => $this->request->getPost('email'),
                'inventory_distributor_phone' => $this->request->getPost('phone'),
            ]);

            return redirect()->to('/inventory/distributor');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'inventory_distributor' => $this->inventory_distributor->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('inventory/distributor/distributor_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->inventory_distributor->delete($id);
        return redirect()->to('/inventory/distributor');
    }
}
