<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;
use App\Models\ModelTemplates;
use App\Models\ModelExcel;
use TCPDF;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use config\Email;



class Paycheck extends Home
{
    protected $db, $builder, $ModelMenu, $ModelKaryawan, $ModelgPermission, $ModelTemplates, $ModelExcel, $email;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelMenu = new ModelMenu();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelTemplates = new ModelTemplates();
        $this->ModelExcel = new ModelExcel();
        $this->request = \Config\Services::request();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        $this->setLanguage();
        // Get the current URI
        $routes = $this->request->uri->getPath();

        // Get the segments of the URI
        $segments = explode('/', $routes);

        // Extract the menu_id from the URI
        $fileName = end($segments); // Assuming the menu_id is at the end of the URI path

        // Retrieve user's group name from session
        $groupName = session()->get('group_name');

        // Retrieve the menu_id from the URI
        $menuId = $this->ModelMenu->getMenuIdbyURI($fileName);

        // Retrieve Page Name from menuId
        $pageName = $this->ModelMenu->getMenuPageName($menuId);

        // Retrieve group ID by group name
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);

        // Retrieve permissions for the group
        $permissions = $this->ModelgPermission->get_permission($groupId);

        // Check if the user has permission for the current route
        $hasPermission = $this->userPermission($permissions, $fileName);

        if (!$hasPermission) {
            return view('error-page/index');
        } else {
            $data['menus'] = $this->ModelMenu->getMenuNames();
            $data['groupedMenus'] = groupMenusByParent($data['menus']);
            $data['title'] = $pageName;
            $data['nama'] = $_SESSION['nama'] ?? '';
            $groupName = $_SESSION['group_name'] ?? '';
            $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
            $data['permission'] = $this->ModelgPermission->get_permission($groupId);
            $data['templates'] = $this->ModelTemplates->getTemplates();
            return view('paycheck/index', $data);
        }
    }

    // Function to read data from Excel file
    public function read()
    {
        $uploadFile = $this->request->getFile('formFile');

        if (!$uploadFile) {
            // Handle case where no file is uploaded
            echo json_encode(["error" => "No file uploaded."]);
        } else {
            // Read data from Excel file
            $excelData = $this->readExcelData($uploadFile);
            // Return the data in JSON format
            echo json_encode($excelData);
        }
    }

    // Helper to Read the Excel data
    // protected function readExcelData($file)
    // {
    //     $spreadsheet = IOFactory::load($file->getTempName());
    //     $worksheet = $spreadsheet->getActiveSheet();

    //     $data = [];
    //     foreach ($worksheet->getRowIterator() as $row) {
    //         $rowData = [];
    //         foreach ($row->getCellIterator() as $cell) {
    //             $rowData[] = $cell->getValue();
    //         }
    //         $data[] = $rowData;
    //     }
    //     return $data;
    // }

    // Helper to Read the Excel data
    protected function readExcelData($file)
    {
        $spreadsheet = IOFactory::load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                // Use getCalculatedValue to evaluate formulas
                $rowData[] = $cell->getCalculatedValue();
            }

            // Skip the first row if it contains headers
            if ($rowIndex === 3) {
                $columns = $rowData; // Store column names for the DataTable
            } else {
                $data[] = $rowData;
            }
        }
        return ['columns' => $columns, 'data' => $data];
    }
}
