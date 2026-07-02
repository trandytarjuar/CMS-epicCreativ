<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAboutSectionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],

            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],

            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],

            'sort' => [
                'type' => 'INT',
                'default' => 0
            ],

            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey(
            'id',
            true
        );

        $this->forge->createTable(
            'about_sections'
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'about_sections'
        );
    }
}
