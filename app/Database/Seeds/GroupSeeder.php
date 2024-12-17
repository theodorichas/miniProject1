<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Faker\Factory;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_code' => 1,
                'group_name' => 'Admin',
            ],
            [
                'group_code' => 2,
                'group_name' => 'Staff',
            ],
        ];
        // Insert data
        $this->db->table('group')->insertBatch($data);
    }
}
