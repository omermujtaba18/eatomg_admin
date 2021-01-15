<?php

namespace App\Controllers;

use App\Models\EmailModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Email extends Controller
{
    var $time, $email;

    public function __construct()
    {
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->title = 'email';
        $this->email = new EmailModel();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'emails' => $this->email->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('email/email', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $result = $this->htmlminifiy($this->request->getPost('subject'));

            if ($result[1] == 200) {
                $this->email->save([
                    'email_name' => $this->request->getPost('name'),
                    'email_subject' => $this->request->getPost('subject'),
                    'email_body' => $result[0],
                ]);
                return redirect()->to('/email');
            }
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
        ];
        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('email/email_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $result = $this->htmlminifiy($this->request->getPost('body'));

            if ($result[1] == 200) {
                $this->email->save([
                    'email_id' => $id,
                    'email_name' => $this->request->getPost('name'),
                    'email_subject' => $this->request->getPost('subject'),
                    'email_body' => $result[0],
                ]);
                return redirect()->to('/email');
            }
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'email' => $this->email->find($id),
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('email/email_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->email->where('email_id', $id)->delete();
        return redirect()->to('/email');
    }

    public function htmlminifiy($body)
    {
        $ch = curl_init("https://htmlcompressor.com/compress");
        curl_setopt_array($ch, array(
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'code' => $body,
                'html_level' => 3,
            ),
            CURLOPT_RETURNTRANSFER => TRUE
        ));
        $output = curl_exec($ch);
        $resultStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            $output, $resultStatusCode
        ];
    }
}
