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
        // $session = \Config\Services::session();
        helper('general_helper');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        return view('home/index', $data);
    }
    public function template()
    {
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['username'] = $_SESSION['nama'] ?? '';
        /*
        // Check if session is active
        if (session_status() === PHP_SESSION_ACTIVE) {
            // Session is active
            echo "Session is active";
        } else {
            // Session is not active
            echo "Session is not active";
        }
        */
        return view('template/index', $data);
    }
}
