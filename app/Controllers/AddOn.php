<?php

namespace App\Controllers;

use App\Models\AddOnModel;
use App\Models\AddOnGroupModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class AddOn extends Controller
{
    var $time, $addon, $addonGroup, $title = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->addon = new AddOnModel();
        $this->addonGroup = new AddOnGroupModel();
        $this->title = 'Addon';
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'addons' => $this->addonGroup->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'addonModel' => $this->addon,
            'rest_id' => $this->request->getGet('rest_id')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('addon/addon', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {

            $saveId = $this->addonGroup->insert([
                'addon_group_name' => $this->request->getPost('name'),
                'addon_group_instruct' => trim($this->request->getPost('instruction')),
                'rest_id' => $this->request->getGet('rest_id')
            ]);

            $items = $this->request->getPost("item");
            $prices = $this->request->getPost("price");

            foreach ($items as $key => $value) {
                $file = $this->request->getFile('image.' . $key);
                $path = "";
                if (!empty($file) && $file->isValid()) {
                    $fileName = $file->getRandomName();
                    $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                    if ($move) {
                        $path = base_url() . '/../assets/uploads/' . $fileName;
                    }
                }

                $this->addon->save([
                    'addon_item' => $items[$key],
                    'addon_price' => $prices[$key],
                    'addon_group_id' => $saveId,
                    'addon_pic' => $path
                ]);
            }

            return redirect()->to('/addon?rest_id=' . $this->request->getGet('rest_id'));
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'rest_id' => $this->request->getGet('rest_id')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('addon/addon_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {

            $this->addonGroup->save([
                'addon_group_id' => $id,
                'addon_group_name' => $this->request->getPost('name'),
                'addon_group_instruct' => trim($this->request->getPost('instruction')),
            ]);

            $items = $this->request->getPost("item");
            $prices = $this->request->getPost("price");
            $pics = $this->request->getPost("pic");

            $this->addon->where('addon_group_id', $id)->delete();

            foreach ($items as $key => $value) {

                $saveId = $this->addon->insert([
                    'addon_item' => $items[$key],
                    'addon_price' => $prices[$key],
                    'addon_group_id' => $id,
                    'addon_pic' => $pics[$key]
                ]);

                $file = $this->request->getFile('image.' . $key);
                $path = "";
                if (!empty($file) && $file->isValid()) {
                    $fileName = $file->getRandomName();
                    $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                    if ($move) {
                        $path = base_url() . '/../assets/uploads/' . $fileName;
                        $this->addon->save([
                            'addon_id' => $saveId,
                            'addon_pic' => $path
                        ]);
                    }
                }
            }

            return redirect()->to('/addon?rest_id=' . $this->request->getGet('rest_id'));
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'addon' => $this->addonGroup->find($id),
            'addonItems' => $this->addon->where('addon_group_id', $id)->findAll(),
            'rest_id' => $this->request->getGet('rest_id')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('addon/addon_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->addonGroup->delete($id);
        $this->addon->where('addon_group_id', $id)->delete();
        return redirect()->to('/addon?rest_id=' . $this->request->getGet('rest_id'));
    }
}
