<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'emp_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tgl_lahir' => [
                'type' => 'DATE',

            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'wa' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
        ]);
        $this->forge->addPrimaryKey('emp_id');
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
