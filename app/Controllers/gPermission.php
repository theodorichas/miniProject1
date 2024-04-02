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
}
