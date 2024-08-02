<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTemplateTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'template_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'template_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'template_subject' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'template_body' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('template_id', true);
        $this->forge->createTable('templates');
    }

    public function down()
    {
        $this->forge->dropTable('templates');
    }
}
