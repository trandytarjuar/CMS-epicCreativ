<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortfolioCategoryTranslationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],

            'portfolio_category_id' => [
                'type' => 'BIGINT'
            ],

            'language_id' => [
                'type' => 'BIGINT'
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
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

        $this->forge->addForeignKey(
            'portfolio_category_id',
            'portfolio_categories',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'language_id',
            'languages',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable(
            'portfolio_category_translations'
        );
    }

    public function down()
    {
        $this->forge->dropTable(
            'portfolio_category_translations'
        );
    }
}