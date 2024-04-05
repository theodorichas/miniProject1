<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearPermission extends Seeder
{
    public function run()
    {
        $this->db->table('group_permission')->emptyTable();
        $this->db->query('ALTER TABLE group_permission AUTO_INCREMENT = 1');
    }
}
