<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToTemplates extends Migration
{
    public function up()
    {
        $this->forge->addColumn('templates', [
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('templates', 'updated_at');
    }
}
