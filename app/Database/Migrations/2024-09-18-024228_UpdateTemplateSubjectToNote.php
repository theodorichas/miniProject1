<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTemplateSubjectToNote extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('templates', [
            'template_subject' => [
                'name' => 'template_note',
                'type' => 'TEXT',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('templates', [
            'template_note' => [
                'name' => 'template_subject',
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
    }
}
