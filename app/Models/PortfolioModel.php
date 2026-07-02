<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table = 'portfolios';

    protected $primaryKey = 'id';

    protected $allowedFields = [

        'portfolio_category_id',
        'thumbnail',

        'media_type',

        'video',

        'youtube_url',

        'client_name',

        'location',

        'sort',

        'created_at',

        'updated_at'
    ];
}
