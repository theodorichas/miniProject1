<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExcelTableV2 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            //general
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'grade' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'periode' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'gaji_pokok' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'workdays' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'wfo' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'wfa' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'ijin' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'alpha' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'total_transfer' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'bca_source' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('excelV2');
    }

    public function down()
    {
        $this->forge->dropTable('excelV2');
    }
}
