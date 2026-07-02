<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortfolioBehindScenesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],

            'portfolio_id' => [
                'type' => 'BIGINT'
            ],

            'media_type' => [
                'type' => 'ENUM',
                'constraint' => [
                    'upload',
                    'youtube'
                ],
                'default' => 'upload'
            ],

            'video' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],

            'youtube_embed' => [
                'type' => 'TEXT',
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

        $this->forge->addForeignKey(
            'portfolio_id',
            'portfolios',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable(
            'portfolio_behind_scenes'
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'portfolio_behind_scenes'
        );
    }
}
