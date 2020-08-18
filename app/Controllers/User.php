<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class User extends Controller
{

    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {

        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->join('restaurants', 'restaurants.rest_id = users.user_rest');
        $query = $builder->get();

        $data = [
            'title' => 'users',
            'users'  => $query->getResult(),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];


        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user', $data);
        echo view('templates/footer');
    }

    public function view($id = null)
    {
        $user = new UserModel();
        $data['user'] = $user->getUser($id);

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user item: ' . $id);
        }

        // echo view('templates/header', $data);
        // echo view('news/view', $data);
        // echo view('templates/footer', $data);
    }

    public function create()
    {
        if ($this->request->getVar()) {
            $user = new UserModel();

            $user->save([
                'user_name' => $this->request->getVar('name'),
                'user_email' => $this->request->getVar('email'),
                'user_password' => $this->request->getVar('password'),
                'user_role' => $this->request->getVar('role'),
                'user_rest' => $this->request->getVar('branch')
            ]);

            return redirect()->to('/user');
        }


        $data = [
            'title' => 'users',
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        $user = new UserModel();

        if ($this->request->getVar()) {
            $data = [
                'user_name' => $this->request->getVar('name'),
                'user_email' => $this->request->getVar('email'),
                'user_password' => $this->request->getVar('password'),
                'user_role' => $this->request->getVar('role'),
                'user_rest' => $this->request->getVar('branch')
            ];
            $user->update($id, $data);

            return redirect()->to('/user');
        }

        $data = [
            'title' => 'users',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'user' => $user->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('user/user_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $user = new UserModel();
        $user->delete($id);
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
        $userModel = new UserModel();
        $err = ['msg' => 'Error: Invalid email or password, Try again!'];
        $sessionVal = ['user_name', 'user_rest', 'user_role'];

        if ($session->has('user_name') && $session->has('user_rest')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getVar('email') && $this->request->getVar('password')) {
            $user = $userModel->where([
                'user_email' => $this->request->getVar('email'),
                'user_password' => $this->request->getVar('password')
            ])
                ->first();

            if (!$user) {
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
