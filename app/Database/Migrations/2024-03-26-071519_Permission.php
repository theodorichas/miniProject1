<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'permi_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'permi_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'permi_desc' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addPrimaryKey('permi_id');
        $this->forge->createTable('permission');
    }

    public function down()
    {
        $this->forge->dropTable('pemission');
    }
}
