<?php

namespace App\Controllers;

use App\Models\FacebookModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;


class Facebook extends Controller
{

    var $db, $title, $time, $facebook, $session = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->title = 'Facebook Auto Post';
        $this->time = new Time('now', 'America/Chicago', 'en_US');
        $this->facebook = new FacebookModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'facebook'  => $this->facebook->findAll(),
            'time' => $this->time
        ];


        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('facebook/facebook', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if ($this->request->getPost()) {
            $saveId = $this->facebook->insert([
                'fb_post_description' => $this->request->getPost('description'),
            ]);

            $file = $this->request->getFile('image');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->facebook->save(['fb_post_id' => $saveId, 'fb_post_image' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }

            return redirect()->to('/facebook');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('facebook/facebook_add', $data);
        echo view('templates/footer');
    }

    public function update($id = null)
    {
        if ($this->request->getPost()) {
            $data = [
                'fb_post_description' => $this->request->getPost('description'),
            ];
            $this->facebook->update($id, $data);

            $file = $this->request->getFile('image');
            if ($file->isValid()) {
                $fileName = $file->getRandomName();
                $move = $file->move(ROOTPATH . 'public/assets/uploads/', $fileName);
                if ($move) {
                    $this->facebook->save(['fb_post_id' => $id, 'fb_post_image' => base_url() . '/../assets/uploads/' . $fileName]);
                }
            }

            return redirect()->to('/facebook');
        }

        $data = [
            'title' => $this->title,
            'time' => $this->time,
            'facebook' => $this->facebook->find($id)
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('facebook/facebook_add', $data);
        echo view('templates/footer');
    }

    public function delete($id = null)
    {
        $this->facebook->delete($id);
        return redirect()->to('/facebook');
    }


    public function publish()
    {
        $builder = $this->facebook->builder();

        $post = $this->facebook->where('is_published', 0)
            ->orderBy('fb_post_id', 'asc')
            ->first();

        if (is_null($post)) {
            $posts = $this->facebook->findAll();
            foreach ($posts as $post) {
                $this->facebook->save(['fb_post_id' => $post['fb_post_id'], 'is_published' => 0]);
            }
            return redirect()->to('/publish');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);

        if (empty($post['fb_post_image'])) {
            curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . getEnv('PAGE_ID') . '/feed?message=' . urlencode($post['fb_post_description']) . '&access_token=' . getEnv('FB_TOKEN'));
        } else {
            curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . getEnv('PAGE_ID') . '/photos?url=' . urlencode($post['fb_post_image']) . '&access_token=' . getEnv('FB_TOKEN') . '&message=' . urlencode($post['fb_post_description']));
        }

        $result = curl_exec($ch);

        var_dump($result);

        $this->facebook->save(['fb_post_id' => $post['fb_post_id'], 'is_published' => 1]);
    }
}
