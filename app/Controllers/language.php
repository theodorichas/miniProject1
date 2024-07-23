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

        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        $data['languages'] = $this->ModelLanguage->getLanguages();
        return view('language/index', $data);
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
            'key' => $langKey,
            'en' => $langValueEn,
            'indo' => $langValueIndo,
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
