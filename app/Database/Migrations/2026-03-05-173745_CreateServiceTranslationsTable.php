<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceTranslationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],
            'service_id' => [
                'type' => 'BIGINT'
            ],
            'language_id' => [
                'type' => 'BIGINT'
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT',
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

        $this->forge->addForeignKey('service_id', 'services', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('language_id', 'languages', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('service_translations');
    }

    public function down()
    {
        $this->forge->dropTable('service_translations');
    }
}