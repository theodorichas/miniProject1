<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use Faker\Factory;

class TranslationsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // <--- Templates --->
            [
                'key' => 'title-p',
                'en'  => 'This is in English',
                'indo'    => 'Ini dalam Bahasa Indonesia',
            ],
            [
                'key' => 'text-action',
                'en'  => 'Action',
                'indo'    => 'Aksi',
            ],
            [
                'key' => 'button-update',
                'en'  => 'Update',
                'indo'    => 'Perbaharui',
            ],
            [
                'key' => 'button-delete',
                'en'  => 'Delete',
                'indo'    => 'Hapus',
            ],
            [
                'key' => 'button-yes',
                'en'  => 'Yes',
                'indo'    => 'Iya',
            ],
            [
                'key' => 'button-no',
                'en'  => 'No',
                'indo'    => 'Tidak',
            ],
            [
                'key' => 'text-action',
                'en'  => 'Action',
                'indo'    => 'Aksi',
            ],


            // <--- Sweet Alerts --->
            [
                'key' => 'text-swal-title',
                'en'  => 'Success',
                'indo'    => 'Berhasil',
            ],
            [
                'key' => 'text-swal-title-error',
                'en'  => 'Something went wrong!',
                'indo'    => 'Terjadi kesalahan!',
            ],
            [
                'key' => 'text-swal-title-success',
                'en'  => 'Success',
                'indo'    => 'Berhasil',
            ],
            [
                'key' => 'text-swal-title-delete',
                'en'  => 'Are you sure?',
                'indo'    => 'Apakah anda yakin?',
            ],
            [
                'key' => 'text-swal-warning-delete',
                'en'  => 'Once deleted, you will not be able to revert this!',
                'indo'    => 'Setelah di hapus, anda tidak akan bisa mengembalikannya!',
            ],
            [
                'key' => 'text-swal-confirm-delete',
                'en'  => 'Yes, delete it!',
                'indo'    => 'Iya, hapus!',
            ],            [
                'key' => 'text-swal-deleted-title',
                'en'  => 'Deleted!',
                'indo'    => 'Terhapus!',
            ],

            //Sweet Alert -> User
            [
                'key' => 'text-swal-user-deleted-text',
                'en'  => 'User has been deleted!',
                'indo'    => 'User telah di hapus!',
            ],
            [
                'key' => 'text-swal-user-email-exist',
                'en'  => 'User with this email already exist!',
                'indo'    => 'User dengan email ini sudah terdaftar, silahkan gunakan email yang lain.',
            ],
            [
                'key' => 'text-swal-user-status-title',
                'en'  => 'Are you sure want to update user status?',
                'indo'    => 'Apakah anda yakin ingin perbaharui status user ini?',
            ],
            [
                'key' => 'text-swal-user-status-message',
                'en'  => 'User status has been updated!',
                'indo'    => 'Status user telah di perbaharui!',
            ],

            //Sweet Alert -> Menu
            [
                'key' => 'text-swal-menu-title-delete',
                'en'  => 'Are you sure?',
                'indo'    => 'Apakah anda yakin?',
            ],
            [
                'key' => 'text-swal-menu-text-delete',
                'en'  => 'Menu has been deleted!',
                'indo'    => 'Menu telah di hapus!',
            ],

            //Sweet Alert -> Group
            [
                'key' => 'text-swal-group-deleted-text',
                'en'  => 'Group has been deleted!',
                'indo'    => 'Group telah di hapus!',
            ],


            // <--- Users atau Karyawan --->
            [
                'key' => 'card-title-user',
                'en'  => 'User DataTable',
                'indo'    => 'DataTable Pengguna',
            ],
            [
                'key' => 'button-add-user',
                'en'  => 'Add User',
                'indo'    => 'Tambah User',
            ],
            [
                'key' => 'text-name',
                'en'  => 'Name',
                'indo'    => 'Nama',
            ],
            [
                'key' => 'text-phone',
                'en'  => 'Phone',
                'indo'    => 'Telp',
            ],
            [
                'key' => 'text-address',
                'en'  => 'Address',
                'indo'    => 'Alamat',
            ],
            [
                'key' => 'text-email',
                'en'  => 'Email',
                'indo'    => 'Email',
            ],
            [
                'key' => 'text-group-name',
                'en'  => 'Group Name',
                'indo'    => 'Nama Group',
            ],
            [
                'key' => 'button-status-active',
                'en'  => 'Activate',
                'indo'    => 'Aktifkan',
            ],
            [
                'key' => 'button-status-de-active',
                'en'  => 'Deactivate',
                'indo'    => 'Non Aktifkan',
            ],


            // <--- Menu --->
            [
                'key' => 'card-title-menu',
                'en'  => 'Menu DataTable',
                'indo'    => 'DataTable Menu',
            ],
            [
                'key' => 'button-add-menu',
                'en'  => 'Add Menu',
                'indo'    => 'Tambah Menu',
            ],
            [
                'key' => 'text-menu',
                'en'  => 'Menu Name',
                'indo'    => 'Nama Menu',
            ],
            [
                'key' => 'text-menu-page',
                'en'  => 'Page Name',
                'indo'    => 'Nama Halaman',
            ],
            [
                'key' => 'text-menu-file',
                'en'  => 'File Name',
                'indo'    => 'Nama File',
            ],
            [
                'key' => 'text-menu-parent',
                'en'  => 'Parent Name',
                'indo'    => 'Nama Induk halaman',
            ],
            [
                'key' => 'text-menu-icon',
                'en'  => 'Icon',
                'indo'    => 'Ikon',
            ],
            [
                'key' => 'text-menu-note',
                'en'  => 'Notes',
                'indo'    => 'Catatan',
            ],
            [
                'key' => 'text-menu-order',
                'en'  => 'Order no.',
                'indo'    => 'No. Urutan',
            ],
            [
                'key' => 'text-menu-visible',
                'en'  => 'Visible',
                'indo'    => 'Visibilitas',
            ],

            // <--- Group --->
            [
                'key' => 'card-title-group',
                'en'  => 'Group DataTable',
                'indo'    => 'DataTable Group',
            ],
            [
                'key' => 'button-add-group',
                'en'  => 'Add Group',
                'indo'    => 'Tambah Group',
            ],
            [
                'key' => 'text-group-code',
                'en'  => 'Group Code',
                'indo'    => 'Kode Group',
            ],
            [
                'key' => 'text-group-name',
                'en'  => 'Group Name',
                'indo'    => 'Nama Group',
            ],
            [
                'key' => 'button-group-permission',
                'en'  => 'Permissions',
                'indo'    => 'Hak Akses',
            ],

            // <--- Permission --->
            [
                'key' => 'text-group-id',
                'en'  => 'Group ID',
                'indo'    => 'ID Group',
            ],
            [
                'key' => 'text-group-view',
                'en'  => 'View',
                'indo'    => 'Lihat',
            ],




            // <--- Modal --->
            [
                'key' => 'button-add-modal',
                'en'  => 'Add',
                'indo'    => 'Tambah',
            ],
            [
                'key' => 'button-update-modal',
                'en'  => 'Update',
                'indo'    => 'Perbaharui',
            ],

            // User Modal
            //Tambah dan add User
            [
                'key' => 'title-add-user-modal',
                'en'  => 'Add User',
                'indo'    => 'Tambah User',
            ],

            //Update dan Perbaharui User
            [
                'key' => 'title-update-user-modal',
                'en'  => 'Update User',
                'indo'    => 'Perbahurui User',
            ],

            //Delete dan hapus User
            [
                'key' => 'title-delete-user-modal',
                'en'  => 'Delete User',
                'indo'    => 'Hapus User',
            ],
            [
                'key' => 'button-delete-user-modal',
                'en'  => 'Delete',
                'indo'    => 'Hapus',
            ],

            //Menu Modal
            //Update dan Perbaharui Menu
            [
                'key' => 'title-update-menu-modal',
                'en'  => 'Update Menu',
                'indo'    => 'Perbahurui Menu',
            ],

            //Group Modal
            //Update dan Perbaharui Group
            [
                'key' => 'title-update-group-modal',
                'en'  => 'Update Group',
                'indo'    => 'Perbahurui Group',
            ],

            //delete dan hapus Group
            [
                'key' => 'title-delete-group-modal',
                'en'  => 'Delete Group',
                'indo'    => 'Hapus Group',
            ],
            [
                'key' => 'button-delete-group-modal',
                'en'  => 'Delete',
                'indo'    => 'Hapus',
            ],


            // <--- Required --->
            //Required -> user
            [
                'key' => 'text-required-name',
                'en'  => "'name' cannot be empty",
                'indo'    => "'nama' tidak boleh kosong",
            ],
            [
                'key' => 'text-required-phone',
                'en'  => "'phone' cannot be empty",
                'indo'    => "'telp' tidak boleh kosong",
            ],
            [
                'key' => 'text-required-phone-minlen',
                'en'  => "Please enter a correct Phone Number",
                'indo'    => "Silahkan masukkan nomor telepon yang benar",
            ],
            [
                'key' => 'text-required-phone-minlen',
                'en'  => "Please enter a correct Phone Number",
                'indo'    => "Silahkan masukkan nomor telepon yang benar",
            ],
            [
                'key' => 'text-required-address',
                'en'  => "'address' cannot be empty",
                'indo'    => "'alamat' tidak boleh kosong",
            ],
            [
                'key' => 'text-required-email',
                'en'  => "'email' cannot be empty",
                'indo'    => "'alamat' tidak boleh kosong",
            ],
            [
                'key' => 'text-required-email-min',
                'en'  => "Please enter a correct Email",
                'indo'    => "Silahkan masukkan email yang benar",
            ],
            [
                'key' => 'text-required-password',
                'en'  => "'password' cannot be empty",
                'indo'    => "'password' tidak boleh kosong",
            ],
            [
                'key' => 'text-required-password-min',
                'en'  => "'password' must contain at least 8 Characters!!",
                'indo'    => "'password' harus berisikan 8 charactter atau lebih!!",
            ],
            [
                'key' => 'text-required-group-name',
                'en'  => "Please select one of the options!!",
                'indo'    => "Mohon pilih salah satu opsi berikut !!",
            ],

            //Required -> menu
            [
                'key' => 'text-required-menu-name',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-menu-page',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-menu-file',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-menu-parent',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-menu-icon',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-menu-note',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-menu-order',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],

            //Required -> group
            [
                'key' => 'text-required-group-code',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'text-required-group-code-min',
                'en'  => "Please enter a value greater than Zero!",
                'indo'    => "Silahkan masukkan angka yang lebih dari nol!",
            ],
            [
                'key' => 'text-required-group-name',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],
            [
                'key' => 'tes',
                'en'  => "This field cannot be empty!",
                'indo'    => "field ini tidak boleh kosong!",
            ],




        ];
        // Insert data
        $this->db->table('translations')->insertBatch($data);
    }
}
