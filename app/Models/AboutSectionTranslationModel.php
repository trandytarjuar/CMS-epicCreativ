<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutSectionTranslationModel extends Model
{
    protected $table =
    'about_section_translations';

    protected $primaryKey =
    'id';

    protected $allowedFields = [

        'about_section_id',

        'language_id',

        'title',

        'content',

        'created_at',

        'updated_at'
    ];
}
