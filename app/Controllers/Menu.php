<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;

class Menu extends Home
{
    protected $db, $builder, $ModelMenu, $ModelKaryawan, $ModelgPermission;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelMenu = new ModelMenu();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->request = \Config\Services::request();
        helper(['general_helper', 'menu_helper']);
    }

    public function index() //view table
    {
        //calling the setLanguage function in general controller
        $this->setLanguage();

        // Get the current URI
        $routes = $this->request->uri->getPath();

        // Get the segments of the URI
        $segments = explode('/', $routes);

        // Extract the menu_id from the URI
        $fileName = end($segments); // Assuming the menu_id is at the end of the URI path

        // Retrieve the menu_id from the URI
        $menuId = $this->ModelMenu->getMenuIdbyURI($fileName);

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
            $data['title'] = 'Menu List';
            $data['icons'] = getFontAwesomeCheatSheet();
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['groupedMenus'] = groupMenusByParent($data['menus']);
            $data['nama'] = $_SESSION['nama'] ?? '';
            $data['permission'] = $permissions;
            $data['menuId'] = $menuId;
            // echo json_encode($data['menus']);
            return view('menu/index', $data);
        }
    }
    public function changeLanguage($language)
    {
        session()->set('language', $language);
        return redirect()->back();
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

        if ($menu_id > 0) {
            $isSuccess = $this->ModelMenu->update_dataMenu($menu_id, $data);
        } else {
            $isSuccess = $this->ModelMenu->add_dataMenu($data);
        }

        if ($isSuccess) {
            echo json_encode(['status' => 0]);
        } else {
            echo json_encode(['status' => 1]);
        }
    }

    public function delete()
    {
        $menu_id = $this->request->getPost('menu_id');
        $this->ModelMenu->delete_dataMenu($menu_id);
        return $this->response->setJSON(['success' => 'Data successfully deleted']);
    }
}
