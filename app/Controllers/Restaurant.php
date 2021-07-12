<?php

namespace App\Controllers;

use App\Models\RestaurantModel;
use App\Models\RestaurantTimeModel;
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
        $this->restaurant_time = new RestaurantTimeModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'restaurants'  => $this->restaurant->where(['business_id' => $_SESSION['user_business']])->findAll(),
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
                'priority' => $this->request->getPost('priority')
            ]);

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
                'priority' => $this->request->getPost('priority')
            ];
            $this->restaurant->update($id, $data);

            $ids = $this->request->getPost('ids');
            $startTimes = $this->request->getPost('start');
            $endTimes = $this->request->getPost('end');
            $closed = $this->request->getPost('closed');
            $open24h = $this->request->getPost('24h');

            foreach($ids as $id){
                $data = [
                    'start_time' => $startTimes[$id],
                    'end_time' => $endTimes[$id],
                    'is_closed' => isset($closed[$id])? 1 : 0,
                    'is_24h_open' => isset($open24h[$id]) ? 1 :0
                ];
                $this->restaurant_time->update($id,$data);
            }
            return redirect()->to('/restaurant');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'restaurant' => $this->restaurant->find($id),
            'times' => $this->restaurant_time->where('rest_id',$id)->findAll()
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
