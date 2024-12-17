<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelMenu;
use App\Models\ModelgPermission;
use App\Models\ModelGroup;
use App\Models\ModelLanguage;


class language extends Home
{
    protected $db, $builder, $ModelGroup, $ModelMenu, $ModelKaryawan, $ModelgPermission, $ModelLanguage;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('translations');
        $this->ModelGroup = new ModelGroup();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelMenu = new ModelMenu();
        $this->ModelLanguage = new ModelLanguage();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function index()
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

        // Retrieve Page Name from menuId
        $pageName = $this->ModelMenu->getMenuPageName($menuId);

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
            // Proceed to load the view
            $data['title'] = $pageName;
            $data['group_names'] = $this->ModelKaryawan->getGroupNames();
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['groupedMenus'] = groupMenusByParent($data['menus']);
            $data['nama'] = $_SESSION['nama'] ?? '';
            $data['permission'] = $permissions;
            $data['menuId'] = $menuId;
            // echo json_encode($routes); -> To see where the routes comin
            // echo json_encode($data['permission']);
            return view('language/index', $data);
        }
    }

    public function langdtb()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelLanguage->searchAndDisplay($search_value, $start, $length);
        $total_count = $this->ModelLanguage->searchAndDisplay($search_value, null, null, true);

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
        $langId = intval($this->request->getPost('langId'));
        $langKey = $this->request->getPost('langKey');
        $langValueEn = $this->request->getPost('langValueEn');
        $langValueIndo = $this->request->getPost('langValueIndo');

        $data = [
            'langId' => $langId,
            'langKey' => $langKey,
            'langEn' => $langValueEn,
            'langIndo' => $langValueIndo,
        ];

        var_dump($data);
        if ($langId > 0) {
            $this->ModelLanguage->update_lang($langId, $data);
        } else {
            $this->ModelLanguage->add_lang($data);
        }
    }

    public function delete()
    {
        $langId = $this->request->getPost('langId');
        // die();
        $this->ModelLanguage->delete_lang($langId);
        return $this->response->setJSON(['success' => true, 'message' => 'Data successfully deleted']);
    }
}
