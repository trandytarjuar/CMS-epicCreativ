<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'code' => 'ID',
                'name' => 'Indonesian',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ],
            [
                'code' => 'EN',
                'name' => 'English',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ]
        ];

        // insert kalau belum ada
        foreach ($data as $lang) {
            $exists = $this->db->table('languages')
                ->where('code', $lang['code'])
                ->countAllResults();

            if ($exists == 0) {
                $this->db->table('languages')->insert($lang);
            }
        }
    }
}
