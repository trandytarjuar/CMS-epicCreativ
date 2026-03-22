<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubServicesTable extends Migration
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

            'banner' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],

            'image' => [
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

        $this->forge->addForeignKey(
            'service_id',
            'services',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('sub_services');
    }

    public function down()
    {
        $this->forge->dropTable('sub_services');
    }
}
