<?php

namespace App\Helpers;

use Exception;
use \Twilio\Rest\Client;

class TextMessage
{

    public function __construct()
    {
    }

    public function sendTextMessage($to, $from, $body)
    {
        $twilio = new Client(getEnv('TWILIO_SID'), getEnv('TWILIO_TOKEN'));

        try{
            $message = $twilio->messages->create($to, array("from" => $from, "body" => $body));
        }catch(Exception $e){

        }
    }
}
