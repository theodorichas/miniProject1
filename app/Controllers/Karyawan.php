<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelMenu;
use App\Models\ModelgPermission;
use CodeIgniter\Cookie\Cookie;


class Karyawan extends Home
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
        // helper('general_helper');
    }

    public function index()
    {
        //calling the setLanguage function in general controller
        $this->setLanguage();

        // Get the current URI
        $routes = $this->request->uri->getPath();

        // Get the segments of the URI
        $segments = explode('/', $routes);

        // Extract the menu_id from the URI
        $fileName = end($segments); // Assuming the menu_id is at the end of the URI path

        // Retrieve the menu_id from the URI
        $menuId = $this->ModelMenu->getMenuIdbyURI($fileName);

        // Retrieve Page Name from menuId
        $pageName = $this->ModelMenu->getMenuPageName($menuId);

        // Retrieve user's group name from session
        $groupName = session()->get('group_name');

        // Retrieve group ID by group name
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);

        // Retrieve permissions for the group
        $permissions = $this->ModelgPermission->get_permission($groupId);


        // Check if the user has permission for the current route
        $hasPermission = $this->userPermission($permissions, $fileName);

        if (!$hasPermission) {
            return view('error-page/index');
        } else {
            // Proceed to load the view
            $data['title'] = $pageName;
            $data['group_names'] = $this->ModelKaryawan->getGroupNames();
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['groupedMenus'] = groupMenusByParent($data['menus']);
            $data['nama'] = $_SESSION['nama'] ?? '';
            $data['permission'] = $permissions;
            $data['menuId'] = $menuId;
            // echo json_encode($routes); -> To see where the routes comin
            // echo json_encode($data['permission']);
            return view('karyawan/index', $data);
        }
    }

    public function changeLanguage($language)
    {
        session()->set('language', $language);
        return redirect()->back();
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

    /*
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
*/
    public function updateAdd()
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
            'nama' => $nama,
            'telp' => $telp,
            'alamat' => $alamat,
            'email' => $email,
            'password' => $hashedPassword,
            'group_name' => $group_name,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Check if user with this email already exists
        $existingUser = $this->ModelKaryawan->getUserByEmail($email);

        if ($id > 0) {
            // If updating an existing user
            if ($existingUser) {
                // Retrieve current created_at value
                $created_at = $existingUser['created_at'];
                $data['created_at'] = $created_at;
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
                return $this->response->setJSON(['success' => true, 'message' => 'Data successfully updated']);
            } else {
                return $this->response->setJSON(['error' => 'User does not exist']);
            }
        } else {
            // If creating a new user
            if (!$existingUser) {
                $data['created_at'] = date('Y-m-d H:i:s');
                $this->ModelKaryawan->add_dataKaryawan($data);
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
        $this->ModelKaryawan->delete_dataKaryawan($id);
        return $this->response->setJSON(['success' => 'Data successfully deleted']);
    }

    public function status() //Fungsi Soft Delete (Active deactive user)
    {
        $id = $this->request->getPost('userId');
        $user = $this->ModelKaryawan->getStatus($id);
        $updatedBy = session()->get('user_id');
        if ($user['is_verified'] == 0) {
            $this->ModelKaryawan->restoreSoftdel($id, $updatedBy);
            return $this->response->setJSON(['success' => 'User Successfully re-activated']);
        } else {
            $this->ModelKaryawan->soft_delete($id, $updatedBy);
            return $this->response->setJSON(['success' => 'User Successfully de-activated']);
        }
    }
}
