<?php

namespace App\Controllers;

use app\Models\ModelKaryawan;
use app\Models\ModelgPermission;
use app\Models\ModelMenu;


class general extends BaseController
{
    protected $ModelgPermission, $ModelKaryawan, $ModelMenu;

    public function __construct()
    {
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelMenu = new ModelMenu();
        $this->request = \Config\Services::request();
        helper('general_helper');
    }

    public function userPermission($permissions, $fileName)
    {
        // Get the current URI
        $routes = $this->request->uri->getPath();

        // Get the segments of the URI
        $segments = explode('/', $routes);

        // Extract the menu_id from the URI
        $fileName = end($segments);

        $groupName = session()->get('group_name');
        $groupID = $this->ModelKaryawan->getGroupIdByName($groupName);
        $permissions = $this->ModelgPermission->get_permission($groupID);

        foreach ($permissions as $permission) {
            // Check if the permission allows viewing
            if ($permission->view == 1) {
                // Retrieve the file_name associated with the menu_id
                $menu = $this->ModelMenu->getMenuByMenuId($permission->menu_id);

                // Check if the menu exists and if its file_name is what you expect
                if ($menu && $menu->file_name == $fileName) {
                    // If so, return true
                    return true;
                }
            }
        }
        // If no matching permission is found, or file_name does not match, return false
        return false;
    }
}
