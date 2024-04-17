<?php

namespace App\Controllers;

use App\Models\ModelMenu;

class Home extends BaseController
{
    protected $db, $builder, $ModelMenu;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelMenu = new ModelMenu();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }
    public function index()
    {
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['username'] = $_SESSION['nama'] ?? '';
        echo "testing";
        die();
        // $data['testing'] = 'hello';
        // var_dump($data);
        // die;
        return view('template/index', $data);
    }
}
