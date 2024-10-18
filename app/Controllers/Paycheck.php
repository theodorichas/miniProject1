<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;
use App\Models\ModelTemplates;
use App\Models\ModelExcelv2;
use TCPDF;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use config\Email;



class Paycheck extends Home
{
    protected $db, $builder, $ModelMenu, $ModelKaryawan, $ModelgPermission, $ModelTemplates, $ModelExcelv2, $email;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelMenu = new ModelMenu();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
        $this->ModelTemplates = new ModelTemplates();
        $this->ModelExcelv2 = new ModelExcelv2();
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

    public function printPdf()
    {
        // Create a new TCPDF instance
        $uploadFile = $this->request->getFile('formFile');
        $excelData = $this->readExcelData($uploadFile);

        $pdf = new TCPDF();

        // Set the PDF document details
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Author Name');
        $pdf->SetTitle('Paycheck');
        $pdf->SetSubject('Paycheck Template');

        // Add a page
        $pdf->AddPage();

        // Write the content with HTML
        $htmlContent = view('testing/index', ['excelData' => $excelData]);

        // Output the HTML content
        $pdf->writeHTML($htmlContent, true, false, true, false, '');

        // Set the Content-Type to application/pdf
        header('Content-Type: application/pdf');

        // Output the PDF inline (I) or as download (D)
        $pdf->Output('paycheck.pdf', 'I'); // Change 'I' to 'D' for download
        exit(); // Ensure no further output is sent after the PDF
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

    public function excelToDB()
    {
        $excelData = $this->request->getPost('excelData');

        foreach ($excelData as $index => $row) {

            $employeeData = [
                'employee_id'      => $row['EmployeeId'],
                'nama'      => $row['Nama Lengkap'],
                'grade'      => $row['Grade'],
                'periode'      => $row['Periode'],
                'gaji_pokok'      => $row['gaji_pokok'],
                'workdays'      => $row['workdays'],
                'wfo'      => $row['WFO'],
                'wfa'      => $row['WFA'],
                'ijin'      => $row['Ijin'],
                'alpha'      => $row['Alpha'],
                'total_transfer' => $row['total_transfer'],
                'bca_source' => $row['Bank'],
                'email' => $row['Email'],


            ];
            $this->ModelExcelv2->insertExcel($employeeData);
        }
        return $this->response->setJSON(['status' => 'success']);
    }
}
