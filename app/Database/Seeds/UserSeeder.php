<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@mail.com',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'superadmin',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'seeder'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
