<?php

namespace App\Controllers;


use App\Models\ModelMenu;
use App\Models\ModelPermission;

class Permission extends BaseController
{
    protected $db, $builder, $ModelMenu, $ModelPermission;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('permission');
        $this->ModelMenu = new ModelMenu();
        $this->ModelPermission = new ModelPermission();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index() //view table
    {
        $data['title'] = 'Permission list';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        return view('permission/index', $data);
    }

    public function permiDtb()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelPermission->searchAndDisplay($search_value, $start, $length);
        $total_count = $this->ModelPermission->searchAndDisplay($search_value, null, null, true);

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
        $permi_id = intval($this->request->getPost('permi_id'));
        $permi_name = $this->request->getPost('permi_name');
        $permi_desc = $this->request->getPost('permi_desc');


        $data = [
            'permi_id' => $permi_id,
            'permi_name' => $permi_name,
            'permi_desc' => $permi_desc,
        ];
        if ($permi_id > 0) {
            $isSuccess = $this->ModelPermission->update_dataPermi($permi_id, $data);
        } else {
            $isSuccess = $this->ModelPermission->add_dataPermi($data);
        }
    }

    public function delete()
    {
        $permi_id = $this->request->getPost('permi_id');
        $this->ModelPermission->delete_dataPermi($permi_id);
    }
}
