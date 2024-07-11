<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearTranslateSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('translations')->emptyTable();
        $this->db->query('ALTER TABLE translations AUTO_INCREMENT = 1');
    }
}
