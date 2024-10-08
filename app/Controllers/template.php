<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelMenu;
use App\Models\ModelgPermission;
use App\Models\ModelGroup;
use App\Models\ModelLanguage;
use App\Models\ModelTemplates;


class template extends Home
{
    protected $db, $builder, $ModelGroup, $ModelMenu, $ModelKaryawan, $ModelgPermission, $ModelLanguage, $ModelTemplates;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('translations');
        $this->ModelGroup = new ModelGroup();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelMenu = new ModelMenu();
        $this->ModelLanguage = new ModelLanguage();
        $this->ModelTemplates = new ModelTemplates();
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


        // Proceed to load the view
        $data['title'] = $pageName;
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('template/dataTable', $data);
    }

    public function templatedtb()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $data = $this->ModelTemplates->searchAndDisplay($search_value, $start, $length);
        $total_count = $this->ModelTemplates->searchAndDisplay($search_value, null, null, true);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data

        );
        echo json_encode($json_data);
    }

    public function templateAdd()
    {
        $template_id = intval($this->request->getPost('template_id'));
        $template_name = $this->request->getPost('template_name');
        $template_note = $this->request->getPost('template_note');
        $template_body = $this->request->getPost('template_body');
        $data = [
            'template_id' => $template_id,
            'template_name' => $template_name,
            'template_note' => $template_note,
            'template_body' => $template_body,
        ];

        if ($template_id > 0) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->ModelTemplates->update_template($data, $template_id);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->ModelTemplates->add_template($data);
        }
    }

    public function delete()
    {
        $template_id = $this->request->getPost('template_id');
        $this->ModelTemplates->delete_template($template_id);
        return $this->response->setJSON(['success' => true, 'message' => 'Data successfully deleted']);
    }


    public function getTemplateBody()
    {
        $templateId = $this->request->getPost('template_id');
        $template = $this->ModelTemplates->getTemplateBody($templateId);  // Use the updated method
        if ($templateId) {

            if ($template) {
                return $this->response->setJSON(['template_body' => $template->template_body]);
            } else {
                return $this->response->setJSON(['template_body' => 'No template found.']);
            }
        } else {
            return $this->response->setJSON(['template_body' => 'pepega.']);
        }

        return $this->response->setJSON(['template_body' => 'Invalid request.']);
    }
}
