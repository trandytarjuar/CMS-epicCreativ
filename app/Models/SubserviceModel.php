<?php

namespace App\Models;

use CodeIgniter\Model;

class SubserviceModel extends Model
{
    protected $table = 'sub_services';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'service_id',
        'image',
        'created_at',
        'updated_at'
    ];
}