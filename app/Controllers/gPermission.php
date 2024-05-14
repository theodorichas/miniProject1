<?php

namespace App\Controllers;


use App\Models\ModelMenu;
use App\Models\ModelgPermission;
use App\Models\ModelKaryawan;


class gPermission extends general
{
    protected $db, $builder, $ModelMenu, $ModelgPermission, $ModelKaryawan;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('group_permission');
        $this->ModelMenu = new ModelMenu();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index() //view table
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
            $groupId = $this->request->getGet('id');
            $data['title'] = 'Group Permission list';
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['group_id'] = $groupId;
            $data['nama'] = $_SESSION['nama'] ?? '';
            $groupName = $_SESSION['group_name'] ?? '';
            $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
            $data['permission'] = $this->ModelgPermission->get_permission($groupId);

            //Debug info
            echo json_encode($data['permission']);

            return view('group-permission/index', $data);
        }
    }


    public function gpermiDtb()
    {
        $group_id = $this->request->getGet('group_id');

        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelgPermission->searchAndDisplay($search_value, $start, $length, $group_id);
        $total_count = $this->ModelgPermission->searchAndDisplay($search_value, null, null, $group_id);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );
        echo json_encode($json_data);
    }

    public function updateAdd()
    {
        $postData = $this->request->getPost('data');
        $group_id = $this->request->getPost('group_id');
        if (!empty($postData)) {
            $arrRes = [];
            foreach ($postData as $row) {
                // $group_id = intval($row['group_id']);
                $menu_id = intval($row['menu_id']);
                $type = $row["type"];

                $key = $menu_id;
                if (!isset($arrRes[$key])) {
                    $arrRes[$key] = [
                        "group_id" => $group_id,
                        "menu_id" => $menu_id,
                        "view" => 0,
                        "edit" => 0,
                        "delete" => 0
                    ];
                }
                $arrRes[$key][$type] = intval($row["checked"]);
            }
            $newArr = array_values($arrRes);
            $this->ModelgPermission->add_permission($newArr);
            return $this->response->setJSON(['success' => 'Data have been successfully added']);
        } else {
            $response = ['success' => false, 'message' => 'No data received.'];
            return $this->response->setJSON($response);
        }
    }
}
