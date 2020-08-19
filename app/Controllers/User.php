<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class User extends Controller
{

    var $db, $title, $time, $user = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->title = 'Users';
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->user = new UserModel();
    }

    public function index()
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->join('restaurants', 'restaurants.rest_id = users.user_rest');
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
        if ($this->request->getVar()) {
            $this->user->insert([
                'user_name' => $this->request->getVar('name'),
                'user_email' => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'user_role' => $this->request->getVar('role'),
                'user_rest' => $this->request->getVar('branch')
            ]);

            return redirect()->to('/user');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getVar()) {
            $data = [
                'user_name' => $this->request->getVar('name'),
                'user_email' => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'user_role' => $this->request->getVar('role'),
                'user_rest' => $this->request->getVar('branch')
            ];
            $this->user->update($id, $data);

            return redirect()->to('/user');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'user' => $this->user->find($id)
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
        $session = session();
        $session->destroy();
        return redirect()->to('/user/login');
    }

    public function login()
    {
        $session = session();
        $err = ['msg' => 'Error: Invalid email or password, Try again!'];
        $sessionVal = ['user_name', 'user_rest', 'user_role'];

        if ($session->has('user_name') && $session->has('user_rest')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getVar('email') && $this->request->getVar('password')) {
            $user = $this->user->where([
                'user_email' => $this->request->getVar('email'),
            ])
                ->first();

            if (!password_verify($this->request->getVar('password'), $user['user_password'])) {
                return view('user/user_login', $err);
            }

            $session->set($sessionVal[0], $user['user_name']);
            $session->set($sessionVal[1], $user['user_rest']);
            $session->set($sessionVal[2], $user['user_role']);

            return redirect()->to('/dashboard');
        }
        echo view('user/user_login');
    }
}
