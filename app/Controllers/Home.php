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
    }

    public function index()
    {
        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('home/index', $data);
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

    public function changeLanguage($language)
    {
        /// Set the selected language as the user's session language.
        session()->set('language', $language);
        // Set a cookie for language preference for one year.
        set_cookie('lang', $language, 3600 * 24 * 365);
        // $this->setCookie();
        return redirect()->back()->withCookies();
    }

    public function setLanguage()
    {
        $language = \Config\Services::language();
        $userLanguage = session()->get('language');

        // Check if a language cookie exists and set the locale based on the cookie if session is not set.
        if (!$userLanguage) {
            $userLanguage = get_cookie('lang') ?? 'en'; // Default to 'en' if no cookie is found
            session()->set('language', $userLanguage);
        }

        $language->setLocale($userLanguage);
    }

    public function testing()
    {
        return view('template/testing');
    }
    public function testing2()
    {
        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('template/testing2', $data);
    }

    public function setCookie()
    {
        set_cookie('testing', 'This is just a test', 10);
        return 'Cookie has been set';
    }

    public function deleteCookie()
    {
        delete_cookie('language_preference');
        return 'Cookie has been deleted';
    }

    public function addLanguage()
    {
        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('language/index', $data);
    }
}
