<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExcelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'salary' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
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
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('excel');
    }

    public function down()
    {
        $this->forge->dropTable('excel');
    }
}
