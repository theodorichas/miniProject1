<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearGroup extends Seeder
{
    public function run()
    {
        $this->db->table('group')->emptyTable();
        $this->db->query('ALTER TABLE group AUTO_INCREMENT = 1');
    }
}
