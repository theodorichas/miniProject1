<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelMenu;


class Karyawan extends BaseController
{
    protected $db, $builder, $ModelKaryawan, $ModelMenu;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('karyawan');
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelMenu = new ModelMenu();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index() //view table
    {
        $data['title'] = 'User list';
        $data['group_names'] = $this->ModelKaryawan->getGroupNames();
        $data['menus'] = $this->ModelMenu->getMenuNames();
        return view('karyawan/index', $data);
    }

    public function karyawanAjax() //Data Table
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelKaryawan->searchAndDisplay($search_value, $start, $length);
        $total_count = $this->ModelKaryawan->searchAndDisplay($search_value, null, null, true);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data

        );
        echo json_encode($json_data);
    }


    public function updateAdd() //Fungsi Update dan add Data
    {
        $isSuccess = false;
        $id = intval($this->request->getPost('userId'));
        $nama = $this->request->getPost('nama');
        $telp = $this->request->getPost('telp');
        $alamat = $this->request->getPost('alamat');
        $email = $this->request->getPost('email');
        $password = $password = (string) $this->request->getPost('password');
        $this->request->getPost('password');
        var_dump($password);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        var_dump($hashedPassword);
        $group_name = $this->request->getPost('groupName');
        $group_id = $this->ModelKaryawan->getGroupIdByName($group_name);

        $data = [
            'user_id' => $id,
            'nama' => $nama,
            'telp' => $telp,
            'alamat' => $alamat,
            'email' => $email,
            'password' => $hashedPassword,
            'group_name' => $group_name,
        ];

        if ($id > 0) {
            $isSuccess = $this->ModelKaryawan->update_dataKaryawan($id, $data, $group_id);
        } else {
            $isSuccess = $this->ModelKaryawan->add_dataKaryawan($data); //diarahkan ke model mahasiswa dengan method add_datakaryawan
            $user_id = $this->ModelKaryawan->insertID();
            $this->ModelKaryawan->insertUserGroup($user_id, $group_id);
        }
        if ($isSuccess) {
            echo json_encode(['status' => 0]); // Success response
        } else {
            echo json_encode(['status' => 1]); // Error response
        }
    }


    public function delete() //Fungsi delete Data
    {
        $id = $this->request->getPost('userId');
        echo "ID yang terhapus: ", $id;
        // die();
        $deleteData = $this->ModelKaryawan->delete_dataKaryawan($id);
        printSuccess('Operation successful', $id);
    }
}
