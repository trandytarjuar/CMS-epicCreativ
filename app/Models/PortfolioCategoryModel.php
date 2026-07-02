<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioCategoryModel extends Model
{
    protected $table =
        'portfolio_categories';

    protected $primaryKey =
        'id';

    protected $allowedFields = [

        'is_active',

        'created_at',

        'updated_at'
    ];
}