<?php

namespace App\Controllers;

use App\Models\RestaurantModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class Restaurant extends Controller
{

    var $db, $title, $time, $restaurant, $session = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->title = 'restaurants';
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->restaurant = new RestaurantModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'restaurants'  => $this->restaurant->findAll(),
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('restaurant/restaurant', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $saveId = $this->restaurant->insert([
                'rest_name' => $this->request->getPost('name'),
                'rest_address' => $this->request->getPost('address'),
                'rest_phone' => $this->request->getPost('phone'),
                'rest_description' => $this->request->getPost('description'),
                'url' => $this->request->getPost('url'),
                'url_facebook' => $this->request->getPost('url_facebook'),
                'url_twitter' => $this->request->getPost('url_twitter'),
                'url_instagram' => $this->request->getPost('url_instagram'),
                'type' => $this->request->getPost('type')
            ]);

            $file = $this->request->getFile('logo');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->restaurant->save(['rest_id' => $saveId, 'logo' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }

            return redirect()->to('/restaurant');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('restaurant/restaurant_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $data = [
                'rest_name' => $this->request->getPost('name'),
                'rest_address' => $this->request->getPost('address'),
                'rest_phone' => $this->request->getPost('phone'),
                'rest_description' => $this->request->getPost('description'),
                'url' => $this->request->getPost('url'),
                'url_facebook' => $this->request->getPost('url_facebook'),
                'url_twitter' => $this->request->getPost('url_twitter'),
                'url_instagram' => $this->request->getPost('url_instagram'),
                'type' => $this->request->getPost('type')
            ];
            $this->restaurant->update($id, $data);

            $file = $this->request->getFile('logo');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->restaurant->save(['rest_id' => $id, 'logo' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }

            return redirect()->to('/restaurant');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'restaurant' => $this->restaurant->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('restaurant/restaurant_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->restaurant->delete($id);
        return redirect()->to('/restaurant');
    }
}
