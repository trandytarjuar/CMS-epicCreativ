<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Banner extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],

            //  gambar banner
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            //  optional text
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'subtitle' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            

            //  penanda section (INI PENTING)
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                // contoh: home, service, about
            ],

            //  aktif / nonaktif
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],

            //  urutan (buat slider)
            'sort_order' => [
                'type' => 'INT',
                'default' => 0,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        //  index biar query cepat
        $this->forge->addKey('position');
        $this->forge->addKey('is_active');

        $this->forge->createTable('banner');
    }

    public function down()
    {
        $this->forge->dropTable('banner');
    }
}
