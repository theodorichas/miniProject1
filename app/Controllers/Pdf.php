<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;
use TCPDF;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;



class pdf extends Home
{
    protected $db, $builder, $ModelMenu, $ModelKaryawan, $ModelgPermission, $email;
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->ModelMenu = new ModelMenu();
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelgPermission = new ModelgPermission();
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
            // var_dump($data);
            $data['title'] = 'pdf';
            $data['nama'] = $_SESSION['nama'] ?? '';
            $groupName = $_SESSION['group_name'] ?? '';
            $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
            $data['permission'] = $this->ModelgPermission->get_permission($groupId);
            // echo json_encode($data['permission']); -> To see the permissions
            return view('pdf/index', $data);
        }
    }

    //Pdf generation
    public function printPdf()
    {
        // Read data from uploaded Excel file
        $uploadFile = $this->request->getFile('formFile');
        $excelData = $this->readExcelData($uploadFile);

        // Convert serial dates to human-readable dates
        foreach ($excelData as &$row) {
            if (isset($row['tgl_lahir'])) {
                $row['tgl_lahir'] = $this->excelSerialToDate($row['tgl_lahir']);
            }
        }
        unset($row);
        // Generate HTML content for the salary slip
        $html = $this->generateHtmlFromData($excelData);

        // Create TCPDF instance
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetProtection(array('print', 'copy'), '123', null, 0, null);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Author Name');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Header Title', 'Header Description');
        $pdf->setHeaderFont(array('helvetica', '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array('helvetica', '', PDF_FONT_SIZE_DATA));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // Add a page
        $pdf->AddPage();

        // Print text using writeHTML()
        $pdf->writeHTML($html, true, false, true, false, '');

        // Set PDF content type
        $this->response->setContentType('application/pdf');

        // Output the PDF as inline (I) or as a download (D)
        $pdf->Output('testing.pdf', 'I');
        exit();
    }

    // Serial to date converter
    private function excelSerialToDate($serial)
    {
        $utc_days = floor($serial - 25569);
        $utc_value = $utc_days * 86400;
        $date_info = new DateTime("@$utc_value");

        $year = $date_info->format('Y');
        $month = $date_info->format('m');
        $day = $date_info->format('d');

        // Return the formatted date
        return $year . "-" . ($month < 10 ? "0" . $month : $month) . "-" . ($day < 10 ? "0" . $day : $day);
    }



    protected function readExcelData($file)
    {
        $spreadsheet = IOFactory::load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
        }

        return $data;
    }

    protected function generateHtmlFromData($data)
    {
        // Generate HTML content from the data
        // Example: Construct HTML table with data
        $html = '<table border="1" style="margin: 0 auto; text-align: center;">
                                                              ';
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . $cell . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;
    }
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
    public function readPC()
    {
        $uploadFile = $this->request->getFile('formFile');
        if (!$uploadFile) {
            // Handle case where no file is uploaded
            echo json_encode(["error" => "No file uploaded."]);
        } else {
            // Read data from Excel file
            $excelData = $this->readExcelDataPC($uploadFile);

            // Return the data in JSON format
            echo json_encode($excelData);
        }
    }
    protected function readExcelDataPC($file)
    {
        $spreadsheet = IOFactory::load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            // Skip the header row if there is one
            if ($rowIndex == 1) {
                continue;
            }

            $rowData = [];
            foreach ($row->getCellIterator() as $cellIndex => $cell) {
                // Assuming the columns are A for Name, B for Salary, C for Email
                if ($cellIndex == 'A') {
                    $rowData['name'] = $cell->getValue();
                } elseif ($cellIndex == 'G') {
                    $rowData['salary'] = $cell->getValue();
                } elseif ($cellIndex == 'E') {
                    $rowData['email'] = $cell->getValue();
                }
            }
            $data[] = $rowData;
        }

        return $data;
    }

    public function sendEmail()
    {
        // Capture output to prevent any unexpected output
        ob_start();

        $uploadFile = $this->request->getFile('formFile');
        if (!$uploadFile->isValid()) {
            // Clean the buffer
            ob_end_clean();
            return $this->response->setJSON(['error' => 'No file uploaded or file is invalid.']);
        }
        $newName = $uploadFile->getRandomName();
        $uploadFile->move(WRITEPATH . 'uploads', $newName);
        $filePath = WRITEPATH . 'uploads/' . $newName;


        // Read data from Excel file
        $excelData = $this->readExcelDataPC($uploadFile);

        // Filter out rows with empty email addresses
        $filteredData = array_filter($excelData, function ($employee) {
            return !empty($employee['email']);
        });
        // Load email library
        $email = \Config\Services::email();

        //calling the helper
        helper('formatrp');
        $results = [];
        foreach ($filteredData as $employee) {
            // Format salary
            $employee['formatted_salary'] = formatRupiah($employee['salary']);

            // Render email message
            $message = view('template/paycheck', ['employee' => $employee]);
            $email->setTo($employee['email']);
            $email->setFrom('testing.magang@gmail.com', 'Arona');
            $email->setSubject('Your Paycheck/Invoice "' . $employee['name'] . '"');
            $email->setMessage($message);
            // Attach a file
            $email->attach($filePath, 'attachment');

            if (!$email->send()) {
                $results[] = ['email' => $employee['email'], 'status' => 'error', 'message' => 'There was an error sending the invoice'];
            } else {
                $results[] = ['email' => $employee['email'], 'status' => 'success', 'message' => 'Paycheck has been sent to employees'];
            }
        }

        // Clean the buffer and return JSON response
        ob_end_clean();
        return $this->response->setJSON(['results' => $results]);
    }

    public function sendAttach()
    {
        $uploadFile = $this->request->getFile('formAttach');
        $email = $this->request->getPost('email');

        $emailService = \Config\Services::email();

        if ($uploadFile && $uploadFile->isValid() && !$uploadFile->hasMoved()) {
            $newName = $uploadFile->getRandomName();
            $uploadFile->move(WRITEPATH . 'uploads', $newName);
            $filePath = WRITEPATH . 'uploads/' . $newName;

            $emailService->setTo($email);
            $emailService->setFrom('testing.magang@gmail.com', 'Arona');
            $emailService->setSubject('Testing attachment');
            $emailService->setMessage("huehuehuehuehuheu");
            $emailService->attach($filePath, 'attachment');

            if ($emailService->send()) {
                echo "Email sent to: " . $email . "\n";
                echo "File: " . $uploadFile->getName() . "\n";
            }
        }
    }
}
