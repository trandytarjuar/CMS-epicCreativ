<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioTranslationModel extends Model
{
    protected $table =
        'portfolio_translations';

    protected $primaryKey = 'id';

    protected $allowedFields = [

        'portfolio_id',

        'language_id',

        'title',

        'description',

        'created_at',

        'updated_at'
    ];
}