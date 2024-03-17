<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Group extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'Constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'group_code' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'group_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('group');
    }

    public function down()
    {
        $this->forge->dropTable('group');
    }
}
