<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;


class Home extends BaseController
{
    protected $db, $builder, $ModelMenu, $ModelKaryawan, $ModelgPermission;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelMenu = new ModelMenu();
        $this->ModelgPermission = new ModelgPermission();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('home/index', $data);
    }

    public function testing()
    {
        return view('testing/index');
    }
}
