<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioBehindSceneModel extends Model
{
    protected $table =
    'portfolio_behind_scenes';

    protected $primaryKey =
    'id';

    protected $allowedFields = [

        'portfolio_id',

        'media_type',

        'video',

        'youtube_embed',

        'sort',

        'is_active',

        'created_at',

        'updated_at'
    ];
}
