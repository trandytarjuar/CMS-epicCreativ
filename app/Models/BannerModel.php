<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'banner';

    protected $primaryKey = 'id';

    protected $allowedFields = [

        'image',

        'title',

        'subtitle',

        'position',

        'is_active',

        'sort_order',

        'created_at',

        'updated_at'
    ];
}
