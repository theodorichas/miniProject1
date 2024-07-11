<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTranslationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'key'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'en' => [
                'type'       => 'TEXT',
            ],
            'indo'       => [
                'type'       => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('translations');
    }

    public function down()
    {
        $this->forge->dropTable('translations');
    }
}
