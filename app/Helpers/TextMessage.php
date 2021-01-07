<?php

namespace App\Helpers;

use \Twilio\Rest\Client;

class TextMessage
{

    public function __construct()
    {
    }

    public function sendTextMessage($to, $body)
    {
        $twilio = new Client(getEnv('TWILIO_SID'), getEnv('TWILIO_TOKEN'));
        $message = $twilio->messages->create($to, array("from" => getEnv('TWILIO_NUMBER'), "body" => $body));
        return ($message->sid);
    }
}
