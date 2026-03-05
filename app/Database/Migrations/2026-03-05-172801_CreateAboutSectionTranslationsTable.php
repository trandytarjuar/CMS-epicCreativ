<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAboutSectionTranslationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],
            'about_section_id' => [
                'type' => 'BIGINT'
            ],
            'language_id' => [
                'type' => 'BIGINT'
            ],
            'banner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'content' => [
                'type' => 'TEXT'
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
            'about_section_id',
            'about_sections',
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

        $this->forge->createTable('about_section_translations');
    }

    public function down()
    {
        $this->forge->dropTable('about_section_translations');
    }
}
