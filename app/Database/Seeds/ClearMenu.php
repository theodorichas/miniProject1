<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearMenu extends Seeder
{
    public function run()
    {
        $this->db->table('menu')->emptyTable();
        $this->db->query('ALTER TABLE menu AUTO_INCREMENT = 1');
    }
}
