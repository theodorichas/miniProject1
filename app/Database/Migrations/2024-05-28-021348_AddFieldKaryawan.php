<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldKaryawan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('karyawan', [
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('karyawan', 'deleted_at');
        $this->forge->dropColumn('karyawan', 'deleted_by');
    }
}
