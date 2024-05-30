<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToKaryawanTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('karyawan', [
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'is_verified' => [
                'type' => 'SMALLINT',
                'default' => 0,
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
    }

    public function down()
    {
        $this->forge->dropColumn('karyawan', 'token');
        $this->forge->dropColumn('karyawan', 'is_verified');
        $this->forge->dropColumn('karyawan', 'created_at');
        $this->forge->dropColumn('karyawan', 'updated_at');
    }
}
