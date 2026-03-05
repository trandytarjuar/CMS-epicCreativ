<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortfoliosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],

            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],

            'banner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],

            'youtube_embed' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],

            'client_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
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

        $this->forge->addKey('id', true);

        $this->forge->createTable('portfolios');
    }

    public function down()
    {
        $this->forge->dropTable('portfolios');
    }
}
