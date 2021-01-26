<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailTemplateModel extends Model
{
    protected $table = 'email_templates';
    protected $primaryKey = 'email_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'email_name',
        'email_body',
    ];
}
