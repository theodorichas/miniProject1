<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelMenu;
use App\Models\ModelgPermission;
use PHPUnit\Util\Json;

class Karyawan extends BaseController
{
    protected $db, $builder, $ModelKaryawan, $ModelMenu, $ModelgPermission;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('karyawan');
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelMenu = new ModelMenu();
        $this->ModelgPermission = new ModelgPermission();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    /*
    public function index() //view table
    {
        $data['title'] = 'User list';
        $data['group_names'] = $this->ModelKaryawan->getGroupNames();
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        $routes = $this->request->uri->getPath();

        // echo json_encode($data['permission']);
        echo json_encode($routes);
        return view('karyawan/index', $data);
    }
    */

    public function index()
    {
        // Get the current URI
        $routes = $this->request->uri->getPath();

        // Retrieve user's group name from session
        $groupName = session()->get('group_name');

        // Retrieve group ID by group name
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);

        // Retrieve permissions for the group
        $permissions = $this->ModelgPermission->get_permission($groupId);

        // Check if the user has permission for the current route
        $hasPermission = $this->hasPermission($permissions);

        if (!$hasPermission) {
            // Redirect or show an error message
            return view('error-page/index');
        } else {

            // Proceed to load the view
            $data['title'] = 'User list';
            $data['group_names'] = $this->ModelKaryawan->getGroupNames();
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['nama'] = $_SESSION['nama'] ?? '';
            $data['permission'] = $permissions;

            echo json_encode($routes);
            return view('karyawan/index', $data);
        }
    }

    public function hasPermission(array $permissions)
    {
        // Check if the permission exists for the given route
        foreach ($permissions as $permission) {
            if ($permission->view == 1 && $permission->menu_id == 1) {
                return true; // User has permission to access the route
            }
        }
        return false; // User does not have permission for the route
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
        $id = intval($this->request->getPost('userId'));
        $nama = $this->request->getPost('nama');
        $telp = $this->request->getPost('telp');
        $alamat = $this->request->getPost('alamat');
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
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
        //untuk cek apakah user dengan Email ini sudah ada dalam DB
        $existingUser = $this->ModelKaryawan->getUserByEmail($email);
        //Kondisi Untuk cek apakah user dengan ID ini sudah ada dalam DB, bila sudah melakukan process seperti berikut
        if ($id > 0) {
            $existingPassword = $existingUser['password'];
            $newPassword = (string)$this->request->getPost('password');

            if ($existingPassword == $newPassword) {
                $data['password'] = $newPassword;
                $this->ModelKaryawan->update_dataKaryawan($id, $data, $group_id);
                return $this->response->setJSON(['success' => 'Passnya Sama']);
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $data['password'] = $hashedPassword;
                $this->ModelKaryawan->update_dataKaryawan($id, $data, $group_id);
                return $this->response->setJSON(['success' => 'Passnya Beda']);
            }
        } else {
            if (!$existingUser) {
                $this->ModelKaryawan->add_dataKaryawan($data); //diarahkan ke model mahasiswa dengan method add_datakaryawan
                $user_id = $this->ModelKaryawan->insertID();
                $this->ModelKaryawan->insertUserGroup($user_id, $group_id);
                return $this->response->setJSON(['success' => 'Data successfully added']);
            } else {
                return $this->response->setJSON(['error' => 'User already exists']);
            }
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
