<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usergroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userG_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('userG_id');
        $this->forge->addForeignKey('user_id', 'karyawan', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('group_id', 'group', 'group_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_group');
    }

    public function down()
    {
        $this->forge->dropTable('user_group');
    }
}
