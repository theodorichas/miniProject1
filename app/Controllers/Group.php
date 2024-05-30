<?php

namespace App\Controllers;

use App\Models\ModelGroup;
use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;



class Group extends general
{

    protected $db, $builder, $ModelGroup, $ModelMenu, $ModelKaryawan, $ModelgPermission;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('group');
        $this->ModelGroup = new ModelGroup();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelMenu = new ModelMenu();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index()
    {
        // Get the current URI
        $routes = $this->request->uri->getPath();

        // Get the segments of the URI
        $segments = explode('/', $routes);

        // Extract the menu_id from the URI
        $fileName = end($segments); // Assuming the menu_id is at the end of the URI path

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
            $data['title'] = "Group list";
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['nama'] = $_SESSION['nama'] ?? '';
            $groupName = $_SESSION['group_name'] ?? '';
            $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
            $data['permission'] = $this->ModelgPermission->get_permission($groupId);
            return view('group/index', $data);
        }
    }

    public function groupDtb()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelGroup->searchAndDisplay($search_value, $start, $length);
        $total_count = $this->ModelGroup->searchAndDisplay($search_value, null, null, true);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data

        );
        echo json_encode($json_data);
    }

    public function updateAdd()
    {
        $isSuccess = false;
        $id = intval($this->request->getPost('groupId'));
        $group_code = $this->request->getPost('groupCode');
        $group_name = $this->request->getPost('groupName');


        $data = [
            'group_id' => $id,
            'group_code' => $group_code,
            'group_name' => $group_name,
        ];
        if ($id > 0) {
            echo ("Id yang masuk ke method ini:$id\n");
            echo ("hai");
            $isSuccess = $this->ModelGroup->update_dataGroup($id, $data);
        } else {
            echo ("Id yang masuk ke method ini:$id\n");
            echo ("hello");
            $isSuccess = $this->ModelGroup->add_dataGroup($data);
        }

        if ($isSuccess) {
            echo json_encode(['status' => 0]); // Success response
        } else {
            echo json_encode(['status' => 1]); // Error response
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('groupId');
        echo "ID yang terhapus: ", $id;
        // die();
        $deleteData = $this->ModelGroup->delete_dataGroup($id);
        printSuccess('Operation successful', $id);
    }
}
