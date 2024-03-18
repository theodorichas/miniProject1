<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;

class Karyawan extends BaseController
{
    protected $db, $builder, $ModelKaryawan;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('karyawan');
        $this->ModelKaryawan = new ModelKaryawan();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index() //view table
    {
        $data['group_names'] = $this->ModelKaryawan->getGroupNames();
        return view('karyawan/index', $data);
    }

    public function karyawanAjax() //Server Side (Ajax)
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


    //Fungsi Update dan add Data
    public function updateAdd()
    {
        $isSuccess = false;
        $id = intval($this->request->getPost('userId'));
        $nama = $this->request->getPost('nama');
        $telp = $this->request->getPost('telp');
        $alamat = $this->request->getPost('alamat');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $group_name = $this->request->getPost('groupName');

        $data = [
            'user_id' => $id,
            'nama' => $nama,
            'telp' => $telp,
            'alamat' => $alamat,
            'email' => $email,
            'password' => $password,
            'group_name' => $group_name,
        ];

        if ($id > 0) {
            echo ("Id yang masuk ke method ini:$id\n");
            echo ("hai");
            $isSuccess = $this->ModelKaryawan->update_dataKaryawan($id, $data);
        } else {
            echo ("Id yang masuk ke method ini:$id\n");
            echo ("hello");
            $isSuccess = $this->ModelKaryawan->add_dataKaryawan($data); //diarahkan ke model mahasiswa dengan method add_datakaryawan
        }
    }

    //Fungsi delete Data
    public function delete()
    {
        $id = $this->request->getPost('userId');
        echo "ID yang terhapus: ", $id;
        // die();
        $deleteData = $this->ModelKaryawan->delete_dataKaryawan($id);
        printSuccess('Operation successful', $id);
    }
}
