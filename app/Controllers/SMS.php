<?php

namespace App\Controllers;

use App\Models\SMSModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class SMS extends Controller
{
    var $time, $sms;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'sms';
        $this->sms = new SMSModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'sms' => $this->sms->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('sms/sms', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $this->sms->save([
                'sms_body' => $this->request->getPost('body'),
                'schedule' => $this->request->getPost('datetime')
            ]);
            return redirect()->to('/sms');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('sms/sms_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {

            $this->sms->save([
                'sms_id' => $id,
                'sms_body' => $this->request->getPost('body'),
                'schedule' => $this->request->getPost('datetime')
            ]);
            return redirect()->to('/sms');
        }


        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'sms' => $this->sms->find($id),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('sms/sms_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->sms->where('sms_id', $id)->delete();
        return redirect()->to('/sms');
    }
}
