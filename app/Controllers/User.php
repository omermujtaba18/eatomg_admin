<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RestaurantModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class User extends Controller
{

    var $db, $title, $time, $user, $session, $restaurant = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->title = 'users';
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->user = new UserModel();
        $this->session = session();
        $this->restaurant = new RestaurantModel();
    }

    public function index()
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->join('restaurants', 'restaurants.rest_id = users.user_rest');
        $builder->where(['users.user_role !=' => 'A', 'users.user_business' => $_SESSION['user_business']]);
        $query = $builder->get();

        $data = [
            'title' => $this->title,
            'users'  => $query->getResult(),
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $this->user->insert([
                'user_name' => $this->request->getPost('name'),
                'user_email' => $this->request->getPost('email'),
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'user_role' => $this->request->getPost('role'),
                'user_rest' => $this->request->getPost('branch'),
                'user_business' => $_SESSION['user_business']
            ]);

            return redirect()->to('/user');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'restaurants' => $this->restaurant->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $data = [
                'user_name' => $this->request->getPost('name'),
                'user_email' => $this->request->getPost('email'),
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'user_role' => $this->request->getPost('role'),
                'user_rest' => $this->request->getPost('branch')
            ];
            $this->user->update($id, $data);

            return redirect()->to('/user');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'user' => $this->user->find($id),
            'restaurants' => $this->restaurant->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->user->delete($id);
        return redirect()->to('/user');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/user/login');
    }

    public function login()
    {
        $err = ['msg' => 'Error: Invalid email or password, Try again!'];
        if ($this->session->has('user_name') && $this->session->has('user_rest')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getPost('email') && $this->request->getPost('password')) {
            $user = $this->user->where([
                'user_email' => $this->request->getPost('email'),
            ])
                ->first();

            if (!password_verify($this->request->getPost('password'), $user['user_password'])) {
                return view('user/user_login', $err);
            }

            $this->session->set($user);

            $username = $user['user_name'];
            $businessId = $user['user_business'];
            $datetime = date('Y-m-d h:i:s');
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $this->db->query("INSERT INTO `ninetofab-test`.`login_history` (`username`, `datetime`, `agent`,`business_id`) 
            VALUES ('$username','$datetime','$agent','$businessId')");

            if ($user['user_role'] == 'E' || $user['user_role'] == 'BM') {
                return redirect()->to('/order?rest_id=' . $user['user_rest']);
            }

            return redirect()->to('/dashboard');
        }
        echo view('user/user_login');
    }
}
