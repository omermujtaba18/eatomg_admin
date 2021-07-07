<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class History extends Controller
{

    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {

        $data = [
            'title' => 'login history',
            'history'  => $this->db->query("SELECT * FROM ninetofab-test.login_history WHERE business_id=" . $_SESSION['user_business']),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];


        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('history/history', $data);
        echo view('templates/footer');
    }
}
