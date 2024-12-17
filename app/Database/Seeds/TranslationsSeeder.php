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
                'langKey' => 'title-p',
                'langEn'  => 'This is in English',
                'langIndo'    => 'Ini dalam Bahasa Indonesia',
            ],
            [
                'langKey' => 'text-action',
                'langEn'  => 'Action',
                'langIndo'    => 'Aksi',
            ],
            [
                'langKey' => 'button-update',
                'langEn'  => 'Update',
                'langIndo'    => 'Perbaharui',
            ],
            [
                'langKey' => 'button-delete',
                'langEn'  => 'Delete',
                'langIndo'    => 'Hapus',
            ],
            [
                'langKey' => 'button-yes',
                'langEn'  => 'Yes',
                'langIndo'    => 'Iya',
            ],
            [
                'langKey' => 'button-no',
                'langEn'  => 'No',
                'langIndo'    => 'Tidak',
            ],
            [
                'langKey' => 'text-action',
                'langEn'  => 'Action',
                'langIndo'    => 'Aksi',
            ],


            // <--- Sweet Alerts --->
            [
                'langKey' => 'text-swal-title',
                'langEn'  => 'Success',
                'langIndo'    => 'Berhasil',
            ],
            [
                'langKey' => 'text-swal-title-error',
                'langEn'  => 'Something went wrong!',
                'langIndo'    => 'Terjadi kesalahan!',
            ],
            [
                'langKey' => 'text-swal-title-success',
                'langEn'  => 'Success',
                'langIndo'    => 'Berhasil',
            ],
            [
                'langKey' => 'text-swal-title-delete',
                'langEn'  => 'Are you sure?',
                'langIndo'    => 'Apakah anda yakin?',
            ],
            [
                'langKey' => 'text-swal-warning-delete',
                'langEn'  => 'Once deleted, you will not be able to revert this!',
                'langIndo'    => 'Setelah di hapus, anda tidak akan bisa mengembalikannya!',
            ],
            [
                'langKey' => 'text-swal-confirm-delete',
                'langEn'  => 'Yes, delete it!',
                'langIndo'    => 'Iya, hapus!',
            ],
            [
                'langKey' => 'text-swal-deleted-title',
                'langEn'  => 'Deleted!',
                'langIndo'    => 'Terhapus!',
            ],

            //Sweet Alert -> User
            [
                'langKey' => 'text-swal-user-deleted-text',
                'langEn'  => 'User has been deleted!',
                'langIndo'    => 'User telah di hapus!',
            ],
            [
                'langKey' => 'text-swal-user-email-exist',
                'langEn'  => 'User with this email already exist!',
                'langIndo'    => 'User dengan email ini sudah terdaftar, silahkan gunakan email yang lain.',
            ],
            [
                'langKey' => 'text-swal-user-status-title',
                'langEn'  => 'Are you sure want to update user status?',
                'langIndo'    => 'Apakah anda yakin ingin perbaharui status user ini?',
            ],
            [
                'langKey' => 'text-swal-user-status-message',
                'langEn'  => 'User status has been updated!',
                'langIndo'    => 'Status user telah di perbaharui!',
            ],

            //Sweet Alert -> Menu
            [
                'langKey' => 'text-swal-menu-title-delete',
                'langEn'  => 'Are you sure?',
                'langIndo'    => 'Apakah anda yakin?',
            ],
            [
                'langKey' => 'text-swal-menu-text-delete',
                'langEn'  => 'Menu has been deleted!',
                'langIndo'    => 'Menu telah di hapus!',
            ],

            //Sweet Alert -> Group
            [
                'langKey' => 'text-swal-group-deleted-text',
                'langEn'  => 'Group has been deleted!',
                'langIndo'    => 'Group telah di hapus!',
            ],


            // <--- Users atau Karyawan --->
            [
                'langKey' => 'card-title-user',
                'langEn'  => 'User DataTable',
                'langIndo'    => 'DataTable Pengguna',
            ],
            [
                'langKey' => 'button-add-user',
                'langEn'  => 'Add User',
                'langIndo'    => 'Tambah User',
            ],
            [
                'langKey' => 'text-name',
                'langEn'  => 'Name',
                'langIndo'    => 'Nama',
            ],
            [
                'langKey' => 'text-phone',
                'langEn'  => 'Phone',
                'langIndo'    => 'Telp',
            ],
            [
                'langKey' => 'text-address',
                'langEn'  => 'Address',
                'langIndo'    => 'Alamat',
            ],
            [
                'langKey' => 'text-email',
                'langEn'  => 'Email',
                'langIndo'    => 'Email',
            ],
            [
                'langKey' => 'text-group-name',
                'langEn'  => 'Group Name',
                'langIndo'    => 'Nama Group',
            ],
            [
                'langKey' => 'button-status-active',
                'langEn'  => 'Activate',
                'langIndo'    => 'Aktifkan',
            ],
            [
                'langKey' => 'button-status-de-active',
                'langEn'  => 'Deactivate',
                'langIndo'    => 'Non Aktifkan',
            ],


            // <--- Menu --->
            [
                'langKey' => 'card-title-menu',
                'langEn'  => 'Menu DataTable',
                'langIndo'    => 'DataTable Menu',
            ],
            [
                'langKey' => 'button-add-menu',
                'langEn'  => 'Add Menu',
                'langIndo'    => 'Tambah Menu',
            ],
            [
                'langKey' => 'text-menu',
                'langEn'  => 'Menu Name',
                'langIndo'    => 'Nama Menu',
            ],
            [
                'langKey' => 'text-menu-page',
                'langEn'  => 'Page Name',
                'langIndo'    => 'Nama Halaman',
            ],
            [
                'langKey' => 'text-menu-file',
                'langEn'  => 'File Name',
                'langIndo'    => 'Nama File',
            ],
            [
                'langKey' => 'text-menu-parent',
                'langEn'  => 'Parent Name',
                'langIndo'    => 'Nama Induk halaman',
            ],
            [
                'langKey' => 'text-menu-icon',
                'langEn'  => 'Icon',
                'langIndo'    => 'Ikon',
            ],
            [
                'langKey' => 'text-menu-note',
                'langEn'  => 'Notes',
                'langIndo'    => 'Catatan',
            ],
            [
                'langKey' => 'text-menu-order',
                'langEn'  => 'Order no.',
                'langIndo'    => 'No. Urutan',
            ],
            [
                'langKey' => 'text-menu-visible',
                'langEn'  => 'Visible',
                'langIndo'    => 'Visibilitas',
            ],

            // <--- Group --->
            [
                'langKey' => 'card-title-group',
                'langEn'  => 'Group DataTable',
                'langIndo'    => 'DataTable Group',
            ],
            [
                'langKey' => 'button-add-group',
                'langEn'  => 'Add Group',
                'langIndo'    => 'Tambah Group',
            ],
            [
                'langKey' => 'text-group-code',
                'langEn'  => 'Group Code',
                'langIndo'    => 'Kode Group',
            ],
            [
                'langKey' => 'text-group-name',
                'langEn'  => 'Group Name',
                'langIndo'    => 'Nama Group',
            ],
            [
                'langKey' => 'button-group-permission',
                'langEn'  => 'Permissions',
                'langIndo'    => 'Hak Akses',
            ],

            // <--- Permission --->
            [
                'langKey' => 'text-group-id',
                'langEn'  => 'Group ID',
                'langIndo'    => 'ID Group',
            ],
            [
                'langKey' => 'text-group-view',
                'langEn'  => 'View',
                'langIndo'    => 'Lihat',
            ],




            // <--- Modal --->
            [
                'langKey' => 'button-add-modal',
                'langEn'  => 'Add',
                'langIndo'    => 'Tambah',
            ],
            [
                'langKey' => 'button-update-modal',
                'langEn'  => 'Update',
                'langIndo'    => 'Perbaharui',
            ],

            // User Modal
            //Tambah dan add User
            [
                'langKey' => 'title-add-user-modal',
                'langEn'  => 'Add User',
                'langIndo'    => 'Tambah User',
            ],

            //Update dan Perbaharui User
            [
                'langKey' => 'title-update-user-modal',
                'langEn'  => 'Update User',
                'langIndo'    => 'Perbahurui User',
            ],

            //Delete dan hapus User
            [
                'langKey' => 'title-delete-user-modal',
                'langEn'  => 'Delete User',
                'langIndo'    => 'Hapus User',
            ],
            [
                'langKey' => 'button-delete-user-modal',
                'langEn'  => 'Delete',
                'langIndo'    => 'Hapus',
            ],

            //Menu Modal
            //Update dan Perbaharui Menu
            [
                'langKey' => 'title-update-menu-modal',
                'langEn'  => 'Update Menu',
                'langIndo'    => 'Perbahurui Menu',
            ],

            //Group Modal
            //Update dan Perbaharui Group
            [
                'langKey' => 'title-update-group-modal',
                'langEn'  => 'Update Group',
                'langIndo'    => 'Perbahurui Group',
            ],

            //delete dan hapus Group
            [
                'langKey' => 'title-delete-group-modal',
                'langEn'  => 'Delete Group',
                'langIndo'    => 'Hapus Group',
            ],
            [
                'langKey' => 'button-delete-group-modal',
                'langEn'  => 'Delete',
                'langIndo'    => 'Hapus',
            ],


            // <--- Required --->
            //Required -> user
            [
                'langKey' => 'text-required-name',
                'langEn'  => "'name' cannot be empty",
                'langIndo'    => "'nama' tidak boleh kosong",
            ],
            [
                'langKey' => 'text-required-phone',
                'langEn'  => "'phone' cannot be empty",
                'langIndo'    => "'telp' tidak boleh kosong",
            ],
            [
                'langKey' => 'text-required-phone-minlen',
                'langEn'  => "Please enter a correct Phone Number",
                'langIndo'    => "Silahkan masukkan nomor telepon yang benar",
            ],
            [
                'langKey' => 'text-required-phone-minlen',
                'langEn'  => "Please enter a correct Phone Number",
                'langIndo'    => "Silahkan masukkan nomor telepon yang benar",
            ],
            [
                'langKey' => 'text-required-address',
                'langEn'  => "'address' cannot be empty",
                'langIndo'    => "'alamat' tidak boleh kosong",
            ],
            [
                'langKey' => 'text-required-email',
                'langEn'  => "'email' cannot be empty",
                'langIndo'    => "'alamat' tidak boleh kosong",
            ],
            [
                'langKey' => 'text-required-email-min',
                'langEn'  => "Please enter a correct Email",
                'langIndo'    => "Silahkan masukkan email yang benar",
            ],
            [
                'langKey' => 'text-required-password',
                'langEn'  => "'password' cannot be empty",
                'langIndo'    => "'password' tidak boleh kosong",
            ],
            [
                'langKey' => 'text-required-password-min',
                'langEn'  => "'password' must contain at least 8 Characters!!",
                'langIndo'    => "'password' harus berisikan 8 charactter atau lebih!!",
            ],
            [
                'langKey' => 'text-required-group-name',
                'langEn'  => "Please select one of the options!!",
                'langIndo'    => "Mohon pilih salah satu opsi berikut !!",
            ],

            //Required -> menu
            [
                'langKey' => 'text-required-menu-name',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-menu-page',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-menu-file',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-menu-parent',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-menu-icon',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-menu-note',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-menu-order',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],

            //Required -> group
            [
                'langKey' => 'text-required-group-code',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'text-required-group-code-min',
                'langEn'  => "Please enter a value greater than Zero!",
                'langIndo'    => "Silahkan masukkan angka yang lebih dari nol!",
            ],
            [
                'langKey' => 'text-required-group-name',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
            [
                'langKey' => 'tes',
                'langEn'  => "This field cannot be empty!",
                'langIndo'    => "field ini tidak boleh kosong!",
            ],
        ];
        // Insert data
        $this->db->table('translations')->insertBatch($data);
    }
}
