<?php

namespace App\Controllers;

use App\Models\ModelMenu;

class Menu extends BaseController
{
    protected $db, $builder, $ModelMenu;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelMenu = new ModelMenu();
        $this->request = \Config\Services::request();
        helper(['general_helper', 'menu_helper']);
    }

    public function index() //view table
    {
        $data['title'] = 'Menu List';
        $data['icons'] = getFontAwesomeCheatSheet();
        return view('menu/index', $data);
    }

    public function menuDtb() //Data Table
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelMenu->searchAndDisplay($search_value, $start, $length);
        $total_count = $this->ModelMenu->searchAndDisplay($search_value, null, null, true);

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
        $issuccess = false;
        $menu_id = intval($this->request->getPost('menu_id'));
        $menu_name = $this->request->getPost('menu_name');
        $page_name = $this->request->getPost('page_name');
        $file_name = $this->request->getPost('file_name');
        $parent_menu = $this->request->getPost('parent_menu');
        $icon = $this->request->getPost('icon');
        $note = $this->request->getPost('note');
        $order_no = $this->request->getPost('order_no');
        $visible = $this->request->getPost('visible');

        // // Convert 'visible' value to boolean
        // $visible = ($visible === '1' || $visible === true) ? true : false;

        // // Update the 'visible' value in the $data array
        // $data['visible'] = $visible;

        $data = [
            'menu_id' => $menu_id,
            'menu_name' => $menu_name,
            'page_name' => $page_name,
            'file_name' => $file_name,
            'parent_menu' => $parent_menu,
            'icon' => $icon,
            'note' => $note,
            'order_no' => $order_no,
            'visible' => $visible,
        ];

        // print_r('<pre');
        // print_r($data);
        // die();
        if ($menu_id > 0) {
            $isSuccess = $this->ModelMenu->update_dataMenu($menu_id, $data);
        } else {
            $isSuccess = $this->ModelMenu->add_dataMenu($data);
        }

        if ($isSuccess) {
            echo json_encode(['status' => 0]); // Success response
        } else {
            echo json_encode(['status' => 1]); // Error response
        }
    }

    public function delete()
    {
        $menu_id = $this->request->getPost('menu_id');
        $this->ModelMenu->delete_dataMenu($menu_id);
    }
}
