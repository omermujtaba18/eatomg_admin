<?php

namespace App\Controllers;

use App\Models\ModifierModel;
use App\Models\ModifierGroupModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Modifier extends Controller
{
    var $time, $title, $modifier, $modifierGroup = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->modifier = new ModifierModel();
        $this->modifierGroup = new ModifierGroupModel();
        $this->title = 'modifiers';
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'modifiers' => $this->modifierGroup->findAll(),
            'modifierModel' => $this->modifier
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('modifier/modifier', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {

            $saveId = $this->modifierGroup->insert([
                'modifier_group_name' => $this->request->getPost('name'),
                'modifier_group_instruct' => trim($this->request->getPost('instruction')),
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
                        // $path = base_url() . '/assets/uploads/' . $fileName;
                        $path =  '/assets/uploads/' . $fileName;
                    }
                }

                $this->modifier->save([
                    'modifier_item' => $items[$key],
                    'modifier_price' => $prices[$key],
                    'modifier_group_id' => $saveId,
                    'modifier_pic' => $path
                ]);
            }

            return redirect()->to('/modifier');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('modifier/modifier_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {

            $this->modifierGroup->save([
                'modifier_group_id' => $id,
                'modifier_group_name' => $this->request->getPost('name'),
                'modifier_group_instruct' => trim($this->request->getPost('instruction')),
            ]);

            $items = $this->request->getPost("item");
            $prices = $this->request->getPost("price");
            $ids = $this->request->getPost("id");

            foreach ($items as $key => $value) {

                $this->modifier->save([
                    'modifier_id' => $ids[$key],
                    'modifier_item' => $items[$key],
                    'modifier_price' => $prices[$key],
                    'modifier_group_id' => $id,
                ]);

                $file = $this->request->getFile('image.' . $key);
                $path = "";
                if (!empty($file) && $file->isValid()) {
                    $fileName = $file->getRandomName();
                    $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                    if ($move) {
                        $path = '/assets/uploads/' . $fileName;
                        $this->modifier->save([
                            'modifier_id' => $ids[$key],
                            'modifier_pic' => $path
                        ]);
                    }
                }
            }

            return redirect()->to('/modifier');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'modifier' => $this->modifierGroup->find($id),
            'modifierItems' => $this->modifier->where('modifier_group_id', $id)->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('modifier/modifier_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->modifierGroup->delete($id);
        $this->modifier->where('modifier_group_id', $id)->delete();

        return redirect()->to('/modifier');
    }
}
