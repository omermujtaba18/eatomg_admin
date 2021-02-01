<?php

namespace App\Models;

use CodeIgniter\Model;

class SMSModel extends Model
{
    protected $table = 'sms';
    protected $primaryKey = 'sms_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'sms_body',
        'sms_filters',
        'schedule',
        'status'
    ];
}
