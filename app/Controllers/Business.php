<?php

namespace App\Controllers;

use App\Models\BusinessModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class Business extends Controller
{

    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->business = new BusinessModel();
    }

    public function test()
    {
        echo "Business Accounts";
    }

    public function index()
    {
        if ($this->request->getPost()) {
            $this->business->save([
                'business_id' => $_SESSION['user_business'],
                'business_name' => $this->request->getPost('business_name'),
                'business_address' => $this->request->getPost('business_address'),
                'business_contact' => $this->request->getPost('business_contact'),
                'business_website' => $this->request->getPost('business_website'),
                'business_url_facebook' => $this->request->getPost('business_url_facebook'),
                'business_url_instagram' => $this->request->getPost('business_url_instagram'),
                'business_url_twitter' => $this->request->getPost('business_url_twitter')
            ]);

            $file = $this->request->getFile('logo');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->business->save(['business_id' => $_SESSION['user_business'], 'business_logo' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }
        }

        $data = [
            'title' => 'business details',
            'business'  => $this->business->where(['business_id' => $_SESSION['user_business']])->first(),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('business/business', $data);
        echo view('templates/footer');
    }
}
