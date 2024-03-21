<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearKaryawan extends Seeder
{
    public function run()
    {
        $this->db->table('karyawan')->emptyTable();
        $this->db->query('ALTER TABLE karyawan AUTO_INCREMENT = 1');
    }
}
