<?php

namespace App\Controllers;


use App\Models\ModelMenu;
use App\Models\ModelgPermission;

class gPermission extends BaseController
{
    protected $db, $builder, $ModelMenu, $ModelgPermission;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('group_permission');
        $this->ModelMenu = new ModelMenu();
        $this->ModelgPermission = new ModelgPermission();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index() //view table
    {
        $groupId = $this->request->getGet('id');
        $data['title'] = 'Group Permission list';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['group_id'] = $groupId;
        return view('group-permission/index', $data);
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

    // public function updateAdd()
    // {
    //     $postData = $this->request->getPost('data');
    //     foreach ($postData as $row) {
    //         if (array_key_exists('group_id', $row)) {
    //             $group_id = intval($row['group_id']);
    //             $view = intval($row['view']);
    //             $edit = intval($row['edit']);
    //             $delete = intval($row['delete']);
    //             $menu_id = intval($row['menu_id']);

    //             $data = [
    //                 'group_id' => $group_id,
    //                 'view' => $view,
    //                 'edit' => $edit,
    //                 'delete' => $delete,
    //                 'menu_id' => $menu_id
    //             ];
    //             if ($group_id > 0) {
    //                 $this->ModelgPermission->update_permission($group_id, $data);
    //             } else {
    //                 $this->ModelgPermission->add_permission($data);
    //             }
    //         } else {
    //             error_log("Error: 'group_id' key is missing in row: " . print_r($row, true));
    //         }
    //     }
    // }

    // public function updateAdd()
    // {
    //     $postData = $this->request->getPost('data');

    //     if (!empty($postData)) {
    //         foreach ($postData as $row) {
    //             if (isset($row['group_id'])) {
    //                 $group_id = intval($row['group_id']);
    //                 $view = isset($row['view']) ? intval($row['view']) : 0;
    //                 $edit = isset($row['edit']) ? intval($row['edit']) : 0;
    //                 $delete = isset($row['delete']) ? intval($row['delete']) : 0;
    //                 $menu_id = intval($row['menu_id']);

    //                 $data = [
    //                     'group_id' => $group_id,
    //                     'view' => $view,
    //                     'edit' => $edit,
    //                     'delete' => $delete,
    //                     'menu_id' => $menu_id
    //                 ];

    //                 if ($group_id > 0) {
    //                     $this->ModelgPermission->update_permission($group_id, $data);
    //                 } else {
    //                     $this->ModelgPermission->add_permission($data);
    //                 }
    //             } else {
    //                 error_log("Error: 'group_id' key is missing in row: " . print_r($row, true));
    //             }
    //         }
    //         return $this->response->setJSON(['success' => true]);
    //     } else {
    //         return $this->response->setJSON(['success' => false, 'message' => 'No data received.']);
    //     }
    // }

    // public function updateAdd()
    // {
    //     $postData = $this->request->getPost('data');
    //     printSuccess('success', $postData);
    //     if (!empty($postData)) {
    //         foreach ($postData as $row) {
    //             if (isset($row['group_id'])) {
    //                 $group_id = intval($row['group_id']);
    //                 $view = isset($row['view']) ? intval($row['view']) : 0;
    //                 $edit = isset($row['edit']) ? intval($row['edit']) : 0;
    //                 $delete = isset($row['delete']) ? intval($row['delete']) : 0;
    //                 $menu_id = intval($row['menu_id']);

    //                 $data = [
    //                     'group_id' => $group_id,
    //                     'view' => $view,
    //                     'edit' => $edit,
    //                     'delete' => $delete,
    //                     'menu_id' => $menu_id
    //                 ];

    //                 if ($group_id > 0) {
    //                     $this->ModelgPermission->update_permission($group_id, $data);
    //                 } else {
    //                     $this->ModelgPermission->add_permission($data);
    //                 }
    //             } else {
    //                 error_log("Error: 'group_id' key is missing in row: " . print_r($row, true));
    //             }
    //         }
    //         return $this->response->setJSON(['success' => true]);
    //     } else {
    //         return $this->response->setJSON(['success' => false, 'message' => 'No data received.']);
    //     }
    // }

    public function updateAdd()
    {
        $postData = $this->request->getPost('data');
        if (!empty($postData)) {
            foreach ($postData as $row) {
                var_dump($row);
                die();
                if (isset($row['group_id'])) {
                    $group_id = intval($row['group_id']);
                    $view = isset($row['view']) ? intval($row['view']) : 0;
                    $edit = isset($row['edit']) ? intval($row['edit']) : 0;
                    $delete = isset($row['delete']) ? intval($row['delete']) : 0;
                    $menu_id = intval($row['menu_id']);

                    $data = [
                        'group_id' => $group_id,
                        'view' => $view,
                        'edit' => $edit,
                        'delete' => $delete,
                        'menu_id' => $menu_id
                    ];

                    if ($group_id > 0) {
                        $this->ModelgPermission->update_permission($group_id, $data);
                    } else {
                        $this->ModelgPermission->add_permission($data);
                    }
                } else {
                    error_log("Error: 'group_id' key is missing in row: " . print_r($row, true));
                }
            }
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'message' => 'No data received.'];
        }
        error_log("Response: " . json_encode($response)); // Log response for debugging
        return $this->response->setJSON($response);
    }
}
