<?php

namespace App\Helpers;

use Exception;

class EmailHelper
{

    public function __construct()
    {
    }

    public function sendEmail($name, $to, $from, $subject, $body)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($from, "Olive Mediterranean Grill");
        $email->setSubject($subject);
        $email->addTo($to, $name);
        $email->addContent("text/html", $body);

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
