<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['superadmin', 'admin'],
                'null' => true
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true
            ],

            'login_attempt' => [
                'type' => 'INT',
                'default' => 0
            ],

            'last_attempt' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_by' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true
            ],

            'updated_by' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
