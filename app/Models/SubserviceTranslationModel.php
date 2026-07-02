<?php

namespace App\Models;

use CodeIgniter\Model;

class SubserviceTranslationModel extends Model
{
    protected $table = 'sub_service_translations';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'sub_service_id',
        'language_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];
}