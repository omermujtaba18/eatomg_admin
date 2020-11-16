<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantModel extends Model
{
    protected $table = 'restaurants';
    protected $primaryKey = 'rest_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'rest_name',
        'rest_address',
        'rest_phone',
        'rest_description',
        'url',
        'type',
        'url_facebook',
        'url_twitter',
        'url_instagram',
        'logo'
    ];
}
