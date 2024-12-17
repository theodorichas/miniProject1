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
        // $sessionData = session()->get();
        // print_r($sessionData);
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
        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('template/testing', $data);
    }
    public function testing2()
    {
        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('template/testing2', $data);
    }

    public function loader()
    {
        return view('testing/index');
    }

    public function placeholder()
    {
        $this->setLanguage();
        $data['title'] = 'Home';
        $data['menus'] = $this->ModelMenu->getMenuNames();
        $data['nama'] = $_SESSION['nama'] ?? '';
        $data['groupedMenus'] = groupMenusByParent($data['menus']);
        $groupName = $_SESSION['group_name'] ?? '';
        $groupId = $this->ModelKaryawan->getGroupIdByName($groupName);
        $data['permission'] = $this->ModelgPermission->get_permission($groupId);
        return view('template/placeholder', $data);
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

    // public function printPdf()
    // {
    //     // 1. Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     $excelData = $this->readExcelDataV2($uploadFile); // Returns an associative array

    //     // Get the filter values to decide which month to show
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');

    //     // Filter the data by Periode (month) and Paycek if provided
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek) {
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;

    //         // Apply Periode filter if it's set
    //         if ($filterPeriode && isset($row['Periode'])) {
    //             $rowPeriode = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : null;

    //             // Extract only the month part from $rowPeriode and compare with $filterPeriode
    //             $rowMonth = substr($rowPeriode, 5, 2); // Assuming 'YYYY-MM-DD' format

    //             // Compare only the month (ensure that $filterPeriode is the same format, e.g., '03' for March)
    //             $matchesPeriode = ($rowMonth === $filterPeriode);
    //         }

    //         // Apply Paycek filter if it's set
    //         if ($filterPaycek && isset($row['Paycek'])) {
    //             $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //         }

    //         return $matchesPeriode && $matchesPaycek;
    //     });

    //     // Set the test email address (use your actual email for testing)
    //     $testEmail = 'silvanus.adytia@gmail.com';

    //     // Load email library
    //     $emailConfig = new Email();
    //     $results = [];

    //     // Limit to only sending to one recipient for testing
    //     $sendCount = 0;

    //     // Iterate through each employee's data
    //     foreach ($excelData['data'] as $employee) {
    //         // If you've already sent to one recipient during testing, stop
    //         if ($sendCount >= 1) {
    //             break;
    //         }

    //         // Skip employees without an email address
    //         if (empty($employee['Email'])) {
    //             continue;
    //         }

    //         // For testing, override the email address with a test email
    //         $employee['Email'] = $testEmail;



    //         // 2. Create a new TCPDF instance for each employee
    //         $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    //         $pdf->SetCreator(PDF_CREATOR);
    //         $pdf->SetAuthor('Your Name');
    //         $pdf->SetTitle('Paycheck');
    //         $pdf->SetSubject('Paycheck Details');

    //         // 3. Add a new page
    //         $pdf->AddPage();

    //         // 4. Load the view page and grab its content for the current employee
    //         $htmlContent = view('testing/index', ['excelData' => $employee]);

    //         // Format specific columns as needed
    //         $columnsToFormat = ['gaji_pokok', 'tj_jabatan', 'tj_keahlian', 'tj_masa_kerja', 'tj_keluarga', 'tj_transport', 'tj_makan', 'tj_komunikasi', 'tj_pph21', 'tj_hari_raya', 'tj_bpjs_kesehatan', 'bonus', 'lain_lain', 'Total Penerimaan', 'total_pj', 'pj_dibayar', 'sisa_pj', 'pot_absensi', 'pot_keterlambatan', 'Total Potongan', 'total_transfer'];
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($employee[$column])) {
    //                 $employee[$column] = !empty($employee[$column]) ? $this->formatRupiah($employee[$column]) : '-';
    //             }
    //             if (isset($employee['Periode'])) {
    //                 $employee['Periode'] = !empty($employee['Periode']) ? $this->excelSerialToDate($employee['Periode']) : '-';
    //             }
    //         }

    //         // Replace placeholders with actual employee data
    //         foreach ($employee as $key => $value) {
    //             $htmlContent = str_replace("{{{$key}}}", $value, $htmlContent);
    //         }

    //         // 5. Write the HTML content to the PDF
    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');

    //         // Save the PDF as a file on the server temporarily
    //         $pdfOutput = FCPATH . "uploads/paycheck_" . $employee['EmployeeId'] . ".pdf";
    //         $pdf->Output($pdfOutput, 'F'); // Save as a file

    //         // 6. Send email with the generated PDF attached
    //         $templateName = "Template Paycheck";
    //         $template = $this->ModelTemplates->fetchTemplateBodyTest($templateName);
    //         $message = str_replace('[Nama Lengkap]', $employee['Nama Lengkap'], $template->template_body);
    //         $message = str_replace('[Periode]', $this->excelSerialToDate($employee['Periode']), $message);
    //         $this->email->setTo($employee['Email']); // Send to the test email
    //         $this->email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
    //         $this->email->setSubject('Your Paycheck for ' . $employee['Periode']);
    //         $this->email->setMessage($message);
    //         $this->email->attach($pdfOutput); // Attach the generated PDF

    //         // 7. Send the email
    //         if (!$this->email->send()) {
    //             $results[] = ['email' => $employee['Email'], 'status' => 'error', 'message' => 'Failed to send paycheck'];
    //         } else {
    //             $results[] = ['email' => $employee['Email'], 'status' => 'success', 'message' => 'Paycheck sent successfully'];
    //         }

    //         // Delete the temporary PDF file after sending
    //         unlink($pdfOutput);

    //         // Increment send count for testing (stop after one)
    //         $sendCount++;
    //     }

    //     // 8. Return results as a response
    //     return $this->response->setJSON(['results' => $results]);
    // }
}
