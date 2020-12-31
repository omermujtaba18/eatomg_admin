<?php

namespace App\Models;

use CodeIgniter\Model;

class FacebookModel extends Model
{
    protected $table = 'facebook_post';
    protected $primaryKey = 'fb_post_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'fb_post_description',
        'fb_post_image',
        'is_published',
    ];
}
