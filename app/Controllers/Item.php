<?php

namespace App\Controllers;

use App\Models\AddOnModel;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\ModifierModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Item extends Controller
{

    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {
        $builder = $this->db->table('items');
        $builder->select('*');
        $builder->join('category', 'category.category_id = items.category_id');
        $query = $builder->get();

        $data = [
            'title' => 'items',
            'items'  => $query->getResult(),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('item/item', $data);
        echo view('templates/footer');
    }

    public function view($id = null)
    {
        echo "Item: view " . $id;
    }

    public function create()
    {
        $category = new CategoryModel();
        $modifier = new ModifierModel();
        $addon = new AddOnModel();

        if ($this->request->getVar()) {
            $item = new ItemModel();
            $item->save([
                'item_name' => $this->request->getVar('name'),
                'item_desc' => $this->request->getVar('desc'),
                'item_price' => $this->request->getVar('price'),
                'category_id' => $this->request->getVar('category'),
                'item_status' => $this->request->getVar('status'),
                'modifier_id' => !is_null($this->request->getVar('modifier')) ? implode(",", $this->request->getVar('modifier')) : '',
                'addon_id' => !is_null($this->request->getVar('addon')) ? implode(",", $this->request->getVar('addon')) : '',
            ]);

            return redirect()->to('/item');
        }


        $data = [
            'title' => 'items',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'category' => $category->findAll(),
            'modifiers' => $modifier->findAll(),
            'addons' => $addon->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('item/item_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        $item = new ItemModel();
        $category = new CategoryModel();
        $modifier = new ModifierModel();
        $addon = new AddOnModel();

        if ($this->request->getVar()) {

            $modifier_name = '';
            if ($this->request->getVar('modifier')) {
                $modifier_name = implode(",", $this->request->getVar('modifier'));
            }

            $data = [
                'item_name' => $this->request->getVar('name'),
                'item_desc' => $this->request->getVar('desc'),
                'item_price' => $this->request->getVar('price'),
                'category_id' => $this->request->getVar('category'),
                'item_status' => $this->request->getVar('status'),
                'modifier_id' => !is_null($this->request->getVar('modifier')) ? implode(",", $this->request->getVar('modifier')) : '',
                'addon_id' => !is_null($this->request->getVar('addon')) ? implode(",", $this->request->getVar('addon')) : '',
            ];
            $item->update($id, $data);

            return redirect()->to('/item');
        }

        $data = [
            'title' => 'items',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'item' => $item->find($id),
            'category' => $category->findAll(),
            'modifiers' => $modifier->findAll(),
            'addons' => $addon->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('item/item_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $item = new ItemModel();
        $item->delete($id);
        return redirect()->to('/item');
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
