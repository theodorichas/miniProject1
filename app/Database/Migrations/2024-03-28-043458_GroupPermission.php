<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupPermission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'gp_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'view' => [
                'type' => 'SMALLINT',
                'default' => 0,
            ],
            'edit' => [
                'type' => 'SMALLINT',
                'default' => 0,
            ],
            'delete' => [
                'type' => 'SMALLINT',
                'default' => 0,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]

        ]);
        $this->forge->addPrimaryKey('gp_id');
        $this->forge->addForeignKey('group_id', 'group', 'group_id');
        $this->forge->addForeignKey('menu_id', 'menu', 'menu_id');
        $this->forge->createTable('group_permission');
    }

    public function down()
    {
        $this->forge->dropTable('group_permission');
    }
}
