<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Category extends Controller
{
    var $time = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
    }

    public function index()
    {
        $category = new CategoryModel();

        $data = [
            'title' => 'category',
            'categorys'  => $category->orderBy('category_id', 'asc')->findAll(),
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('category/category', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $category = new CategoryModel();

            $category->save([
                'category_name' => $this->request->getPost('name'),
                'category_desc' => $this->request->getPost('desc'),
                'category_slug' => str_replace(" ", "-", trim(strtolower($this->request->getPost('name')))),
                'category_type' => $this->request->getPost('type'),
            ]);

            return redirect()->to('/category');
        }

        $data = [
            'title' => 'category',
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('category/category_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        $category = new CategoryModel();

        if ($this->request->getVar()) {
            $data = [
                'category_name' => $this->request->getVar('name'),
                'category_desc' => $this->request->getVar('desc'),
                'category_type' => $this->request->getVar('type')
            ];
            $category->update($id, $data);

            return redirect()->to('/category');
        }

        $data = [
            'title' => 'category',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'category' => $category->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('category/category_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $category = new CategoryModel();
        $category->delete($id);
        return redirect()->to('/category');
    }
}
