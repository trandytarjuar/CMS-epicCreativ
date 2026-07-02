<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutSectionModel extends Model
{
    protected $table =
    'about_sections';

    protected $primaryKey =
    'id';

    protected $allowedFields = [

        'slug',

        'image',

        'sort',

        'is_active',

        'created_at',

        'updated_at'
    ];
}
