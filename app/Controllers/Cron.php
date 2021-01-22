<?php

namespace App\Controllers;

use App\Models\EmailModel;
use CodeIgniter\Controller;
use App\Helpers\EmailHelper;
use App\Models\CustomerModel;
use DateTime;

class Cron extends Controller
{
    var $email;

    public function __construct()
    {
        $this->email = new EmailModel();
        $this->customer = new CustomerModel();
    }

    public function every30minute()
    {
        $current = new DateTime();
        $time1 = $current->format('Y-m-d h:i:s');
        $currentPlus10 = new DateTime('+30 minute');
        $time2 = $currentPlus10->format('Y-m-d h:i:s');

        $emails = $this->email->where([
            'schedule >=' => $time1,
            'schedule <' => $time2,
            'status' => 0
        ])->findAll();

        foreach ($emails as $email) {
            $customers = $this->customer->findAll();
            foreach ($customers as $customer) {
                $emailHelper = new EmailHelper();
                $emailHelper->sendEmail(
                    $customer['cus_name'],
                    $customer['cus_email'],
                    getenv('EMAIL'),
                    $email['email_subject'],
                    $email['email_body']
                );
            }
            $this->email->save(['email_id' => $email['email_id'], 'status' => 1]);
        }
    }
}
