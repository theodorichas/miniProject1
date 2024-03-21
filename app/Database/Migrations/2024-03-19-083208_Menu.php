<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigened' => true,
                'auto_increment' => true,

            ],
            'menu_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'page_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'parent_menu' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'order_no' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'visible' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('menu_id');
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
