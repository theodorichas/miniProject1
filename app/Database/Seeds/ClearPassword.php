<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearPassword extends Seeder
{
    public function run()
    {
        $this->db->table('password_resets')->emptyTable();
        $this->db->query('ALTER TABLE password_resets AUTO_INCREMENT = 1');
    }
}
