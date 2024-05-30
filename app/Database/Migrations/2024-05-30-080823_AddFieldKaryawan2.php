<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldKaryawan2 extends Migration
{
    public function up()
    {
        $this->forge->addColumn('karyawan', [
            'updated_by' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('karyawan', 'updated_by');
    }
}
