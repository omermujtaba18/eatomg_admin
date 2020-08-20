<?php

namespace App\Controllers;

use App\Models\PromotionModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Promotion extends Controller
{
    var $time, $title, $promotion = null;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->promotion = new PromotionModel();
        $this->title = 'promotions';
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'promotions' => $this->promotion->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('promotion/promotion', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {

            $this->promotion->insert([
                'promo_name' => $this->request->getPost('name'),
                'promo_code' => trim($this->request->getPost('code')),
                'promo_type' => trim($this->request->getPost('type')),
                'promo_amount' => trim($this->request->getPost('amount')),
                'is_active' => trim($this->request->getPost('active')),
            ]);

            return redirect()->to('/promotion');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('promotion/promotion_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $this->promotion->save([
                'promo_id' => $id,
                'promo_name' => $this->request->getPost('name'),
                'promo_code' => trim($this->request->getPost('code')),
                'promo_type' => trim($this->request->getPost('type')),
                'promo_amount' => trim($this->request->getPost('amount')),
                'is_active' => trim($this->request->getPost('active')),
            ]);

            return redirect()->to('/promotion');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'promotion' => $this->promotion->find($id),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('promotion/promotion_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->promotion->where('promo_id', $id)->delete();
        return redirect()->to('/promotion');
    }
}
