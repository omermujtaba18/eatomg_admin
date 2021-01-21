<?php

namespace App\Controllers;

use App\Models\EmailModel;
use CodeIgniter\Controller;
use CodeIgniter\Email;
use CodeIgniter\I18n\Time;
use DateTime;

class Cron extends Controller
{
    var $email;

    public function __construct()
    {
        $this->email = new EmailModel();
    }

    public function every10minute()
    {
        $datetime = new DateTime();

        $to_time = strtotime($datetime->format('Y-m-d h:i:s'));
        $emails = $this->email->where('status', 0)->findAll();

        foreach ($emails as $email) {
            $target = new DateTime($email['schedule']);
            $from_time = strtotime($target->format('Y-m-d h:i:s'));
            $diff = round(($to_time - $from_time) / 60, 2);

            if ($diff > 0 && $diff < 10) {
                // Use send grid to send emails
            }
        }
    }
}
