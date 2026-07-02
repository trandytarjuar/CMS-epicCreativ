<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceTranslationModel extends Model
{
    protected $table = 'service_translations';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'service_id',
        'language_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];
}
