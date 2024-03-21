<?php

namespace App\Controllers;

use App\Models\ModelGroup;

class Group extends BaseController
{

    protected $db, $builder, $ModelGroup;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('group');
        $this->ModelGroup = new ModelGroup();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index()
    {
        $data['title'] = "Group list";
        return view('group/index', $data);
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
