<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioCategoryTranslationModel extends Model
{
    protected $table =
        'portfolio_category_translations';

    protected $primaryKey =
        'id';

    protected $allowedFields = [

        'portfolio_category_id',

        'language_id',

        'name',

        'created_at',

        'updated_at'
    ];
}