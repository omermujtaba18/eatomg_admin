<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table = 'emails';
    protected $primaryKey = 'email_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'email_name',
        'email_subject',
        'email_body',
        'email_filter'
    ];
}
