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
            'modifiers' => $this->modifierGroup->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'modifierModel' => $this->modifier,
            'rest_id' => $this->request->getGet('rest_id')
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

                $this->modifier->save([
                    'modifier_item' => $items[$key],
                    'modifier_price' => $prices[$key],
                    'modifier_group_id' => $saveId,
                    'modifier_pic' => $path
                ]);
            }

            return redirect()->to('/modifier?rest_id=' . $this->request->getGet('rest_id'));
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'rest_id' => $this->request->getGet('rest_id')
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
            $pics = $this->request->getPost("pic");

            $this->modifier->where('modifier_group_id', $id)->delete();

            foreach ($items as $key => $value) {

                $saveId = $this->modifier->insert([
                    'modifier_item' => $items[$key],
                    'modifier_price' => $prices[$key],
                    'modifier_group_id' => $id,
                    'modifier_pic' => $pics[$key]
                ]);

                $file = $this->request->getFile('image.' . $key);
                $path = "";
                if (!empty($file) && $file->isValid()) {
                    $fileName = $file->getRandomName();
                    $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                    if ($move) {
                        $path = base_url() . '/../assets/uploads/' . $fileName;
                        $this->modifier->save([
                            'modifier_id' => $saveId,
                            'modifier_pic' => $path
                        ]);
                    }
                }
            }

            return redirect()->to('/modifier?rest_id=' . $this->request->getGet('rest_id'));
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'modifier' => $this->modifierGroup->find($id),
            'modifierItems' => $this->modifier->where('modifier_group_id', $id)->findAll(),
            'rest_id' => $this->request->getGet('rest_id')
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
        return redirect()->to('/modifier?rest_id=' . $this->request->getGet('rest_id'));
    }
}
