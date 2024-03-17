<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Faker\Factory;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $positions = ['Manager', 'IT', 'HRD', "Intern"];
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'nama' => $faker->name,
                'telp' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'email' => $faker->email,
                'position' => $faker->randomElement($positions),
            ];
            $this->db->table('karyawan')->insert($data);
        }
    }
}
