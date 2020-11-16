<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class Customer extends Controller
{

    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {

        $customer = new CustomerModel();

        $data = [
            'title' => 'customers',
            'customers'  => $customer->where('rest_id', $this->request->getGet('rest_id'))->findAll(),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('customer/customer', $data);
        echo view('templates/footer');
    }

    public function edit($id = null)
    {
        $customer = new CustomerModel();

        $data = [
            'title' => 'Customers',
            'customer'  => $customer->find($id),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('customer/customer_add', $data);
        echo view('templates/footer', $data);
    }
}
