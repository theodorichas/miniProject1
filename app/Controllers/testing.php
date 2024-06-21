<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;


class testing extends Home
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
        // Access the language service from the framework
        $language = \Config\Services::language();

        // Get the user's preferred language from the session.
        // If the user hasn't set a language preference, use the default language ('en').
        $userLanguage = session()->get('language') ?? 'en';

        // Set the language to be used in the user interface.
        // The `setLocale` method takes the language code as an argument.
        // The language code is used to determine which language files to load.
        // The language files contain the translations for the user interface elements.
        // The translations are used to display the user interface elements in the user's preferred language.
        $language->setLocale($userLanguage);
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('home/index', $data);
    }

    public function changeLanguage($language)
    {
        $this->setLanguage();
        // Set the selected language as the user's session language.
        // This will be used to localize the user interface in the future.
        session()->set('language', $language);

        // Redirect the user back to the previous page.
        // This ensures that the user stays on the same page after changing the language.
        return redirect()->back();
    }

    public function testing()
    {
        if (!function_exists('groupMenusByParent')) {
            echo "Gagal";
        } else {
            echo "Berhasil";
        }
    }
}
