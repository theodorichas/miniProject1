<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'group_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ]

        ]);
        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('Karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('Karyawan');
    }
}
