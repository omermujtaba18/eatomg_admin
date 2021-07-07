<?php

namespace App\Controllers;

use App\Models\AddOnGroupModel;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\ModifierGroupModel;
use App\Models\ItemModifierModel;
use App\Models\ItemAddonModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Item extends Controller
{

    var $db, $time, $title, $addonGroup,
        $category, $item, $modifierGroup,
        $itemModifier, $itemAddon = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->addonGroup = new AddOnGroupModel();
        $this->category = new CategoryModel();
        $this->item = new ItemModel();
        $this->modifierGroup = new ModifierGroupModel();
        $this->itemModifier = new ItemModifierModel();
        $this->itemAddon = new ItemAddonModel();
        $this->title = 'items';
    }

    public function index()
    {
        $builder = $this->db->table('items');
        $builder->select('*');
        $builder->join('category', 'category.category_id = items.category_id');
        $builder->where('items.rest_id', $this->request->getGet('rest_id'));
        $query = $builder->get();

        $data = [
            'title' => $this->title,
            'items'  => $query->getResult(),
            'time' => $this->time,
            'itemModifier' => $this->itemModifier,
            'itemAddon' => $this->itemAddon,
            'modifierGroup' => $this->modifierGroup->where('rest_id', $this->request->getGet('rest_id')),
            'addonGroup' => $this->addonGroup->where('rest_id', $this->request->getGet('rest_id')),
            'rest_id' => $this->request->getGet('rest_id')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('item/item', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $saveId = $this->item->insert([
                'item_name' => $this->request->getPost('name'),
                'item_desc' => $this->request->getPost('desc'),
                'item_price' => $this->request->getPost('price'),
                'category_id' => $this->request->getPost('category'),
                'item_status' => $this->request->getPost('status'),
                'push_item' => $this->request->getPost('push_item'),
                'item_slug' => str_replace(" ", "-", trim(strtolower($this->request->getPost('name')))),
                'rest_id' => $this->request->getGet('rest_id')
            ]);

            $file = $this->request->getFile('image');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->item->save(['item_id' => $saveId, 'item_pic' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }

            $item_modifiers = !empty($this->request->getPost("modifier")) ? $this->request->getPost("modifier") : NULL;
            $item_addons = !empty($this->request->getPost("addon")) ? $this->request->getPost("addon") : NULL;

            if ($item_modifiers) {
                foreach ($item_modifiers as $modifier_group_id) {
                    $this->itemModifier->save([
                        'item_id' => $saveId,
                        'modifier_group_id' => substr($modifier_group_id, 0)
                    ]);
                }
            }

            if ($item_addons) {
                foreach ($item_addons as $addon_group_id) {
                    $this->itemAddon->save([
                        'item_id' => $saveId,
                        'addon_group_id' => substr($addon_group_id, 0)
                    ]);
                }
            }

            return redirect()->to('/item?rest_id=' . $this->request->getGet('rest_id'));
        }


        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'category' => $this->category->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'modifiers' => $this->modifierGroup->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'addons' => $this->addonGroup->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'rest_id' => $this->request->getGet('rest_id')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('item/item_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $this->item->save([
                'item_id' => $id,
                'item_name' => $this->request->getPost('name'),
                'item_desc' => $this->request->getPost('desc'),
                'item_price' => $this->request->getPost('price'),
                'category_id' => $this->request->getPost('category'),
                'item_status' => $this->request->getPost('status'),
                'push_item' => $this->request->getPost('push_item'),
                'item_slug' => str_replace(" ", "-", trim(strtolower($this->request->getPost('name'))))
            ]);

            $file = $this->request->getFile('image');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->item->save(['item_id' => $id, 'item_pic' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }

            $this->itemModifier->where('item_id', $id)->delete();
            $this->itemAddon->where('item_id', $id)->delete();

            $item_modifiers = !empty($this->request->getPost("modifier")) ? $this->request->getPost("modifier") : NULL;
            $item_addons = !empty($this->request->getPost("addon")) ? $this->request->getPost("addon") : NULL;

            if ($item_modifiers) {
                foreach ($item_modifiers as $modifier_group_id) {
                    $this->itemModifier->save([
                        'item_id' => $id,
                        'modifier_group_id' => substr($modifier_group_id, 0)
                    ]);
                }
            }

            if ($item_addons) {
                foreach ($item_addons as $addon_group_id) {
                    $this->itemAddon->save([
                        'item_id' => $id,
                        'addon_group_id' => substr($addon_group_id, 0)
                    ]);
                }
            }
            return redirect()->to('/item?rest_id=' . $this->request->getGet('rest_id'));
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'item' => $this->item->find($id),
            'category' => $this->category->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'modifiers' => $this->modifierGroup->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'addons' => $this->addonGroup->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'itemModifier' => $this->itemModifier,
            'itemAddon' => $this->itemAddon,
            'rest_id' => $this->request->getGet('rest_id')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('item/item_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->item->delete($id);
        $this->itemModifier->where('item_id', $id)->delete();
        $this->itemAddon->where('item_id', $id)->delete();
        return redirect()->to('/item?rest_id=' . $this->request->getGet('rest_id'));
    }

    public function getItemsByCategory($val)
    {
        $itemModel = new ItemModel();
        $items = $itemModel->where(['category_id' => $val])->findAll();
        echo json_encode($items);
    }

    public function getModifierByItemID($val)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->where(['item_id' => $val])->first();
        $builder = $this->db->table('modifiers');
        $builder->select('*');
        $builder->whereIn('modifier_id', explode(",", $item['modifier_id']));
        $query = $builder->get();
        echo json_encode($query->getResult());
    }

    public function getItemByID($val)
    {
        $itemModel = new ItemModel();
        echo json_encode($itemModel->find($val));
    }
}
