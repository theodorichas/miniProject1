<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Faker\Factory;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'menu_name' => 'Karyawan',
                'page_name' => 'Karyawan',
                'file_name' => 'karyawan',
                'parent_menu' => 'main',
                'icon' => 'person',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
            [
                'menu_name' => 'Group',
                'page_name' => 'Group',
                'file_name' => 'group',
                'parent_menu' => 'main',
                'icon' => 'group',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
            [
                'menu_name' => 'Menu',
                'page_name' => 'Menu',
                'file_name' => 'menu',
                'parent_menu' => 'main',
                'icon' => 'menu_book',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
            [
                'menu_name' => 'pdf',
                'page_name' => 'pdf',
                'file_name' => 'pdf',
                'parent_menu' => 'main',
                'icon' => 'desciption',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
            [
                'menu_name' => 'Paycheck',
                'page_name' => 'Paycheck',
                'file_name' => 'paycheck',
                'parent_menu' => 'main',
                'icon' => 'payments',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
            [
                'menu_name' => 'Templates',
                'page_name' => 'Templates',
                'file_name' => 'templates',
                'parent_menu' => 'main',
                'icon' => 'video_library',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
            [
                'menu_name' => 'Translations',
                'page_name' => 'Translations',
                'file_name' => 'addLanguage',
                'parent_menu' => 'main',
                'icon' => 'globe_asia',
                'note' => 'yes ini dari seeder',
                'order_no' => 1,
                'visible' => 1,
            ],
        ];
        // Insert data
        $this->db->table('menu')->insertBatch($data);
    }
}
