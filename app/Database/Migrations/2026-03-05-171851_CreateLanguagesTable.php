<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'auto_increment' => true],
            'code' => ['type' => 'VARCHAR', 'constraint' => 5],
            'name' => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('languages');
    }

    public function down()
    {
        //
        $this->forge->dropTable('languages');
    }
}
