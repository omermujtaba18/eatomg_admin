<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Category extends Controller
{
    var $time, $title, $category = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'category';
        $this->category = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'categorys'  => $this->category->orderBy('category_id', 'asc')->findAll(),
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
            $this->category->insert([
                'category_name' => $this->request->getPost('name'),
                'category_desc' => $this->request->getPost('desc'),
                'category_slug' => str_replace(" ", "-", trim(strtolower($this->request->getPost('name')))),
                'category_type' => $this->request->getPost('type'),
            ]);
            return redirect()->to('/category');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('category/category_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $data = [
                'category_name' => $this->request->getPost('name'),
                'category_desc' => $this->request->getPost('desc'),
                'category_type' => $this->request->getPost('type')
            ];
            $this->category->update($id, $data);

            return redirect()->to('/category');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'category' => $this->category->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('category/category_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->category->delete($id);
        return redirect()->to('/category');
    }
}
