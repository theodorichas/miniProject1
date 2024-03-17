<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearGroup extends Seeder
{
    public function run()
    {
        $this->db->table('group')->truncate();
    }
}
