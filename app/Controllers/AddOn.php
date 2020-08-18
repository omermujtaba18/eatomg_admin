<?php

namespace App\Controllers;

use App\Models\AddOnModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class AddOn extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $addOnModel = new AddOnModel();
        $data = [
            'title' => 'Add-On',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'addons' => $addOnModel->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('addon/addon', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getVar()) {
            $addOnModel = new AddOnModel();

            $addOnModel->save([
                'addon_name' => $this->request->getVar('name'),
                'addon_instruct' => trim($this->request->getVar('instruction')),
                'addon_item' => trim($this->request->getVar('items')),
                'addon_price' => trim($this->request->getVar('price')),
            ]);

            return redirect()->to('/addon');
        }


        $data = [
            'title' => 'Add-On',
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('addon/addon_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        $addOnModel = new AddOnModel();

        if ($this->request->getVar()) {
            $data = [
                'addon_name' => $this->request->getVar('name'),
                'addon_instruct' => trim($this->request->getVar('instruction')),
                'addon_item' => trim($this->request->getVar('items')),
                'addon_price' => trim($this->request->getVar('price')),
            ];
            $addOnModel->update($id, $data);

            return redirect()->to('/modifier');
        }

        $data = [
            'title' => 'Add-On',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'addon' => $addOnModel->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('addon/addon_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $addOnModel = new AddOnModel();
        $addOnModel->delete($id);
        return redirect()->to('/addon');
    }

    public function test()
    {
        $CI_ENV = $_SERVER['CI_ENVIRONMENT'];
    }
}
