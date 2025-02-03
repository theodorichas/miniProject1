<?php

namespace App\Controllers;

use App\Models\ModelMenu;
use App\Models\ModelKaryawan;
use App\Models\ModelgPermission;
use App\Models\ModelTemplates;
use App\Models\ModelExcelv2;
use TCPDF;
use Dompdf\Dompdf;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Html as HtmlWriter;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

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

    public function changeLanguage($language)
    {
        session()->set('language', $language);
        return redirect()->back();
    }

    // public function printPdf()
    // {
    //     // 1. Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     $excelData = $this->readExcelDataV2($uploadFile);

    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');
    //     $selectedRows = json_decode($this->request->getPost('selectedRows'), true);
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;
    //         $isRowSelected = empty($selectedRows) || in_array((string)$row['EmployeeId'], array_map('strval', $selectedRows));

    //         if ($filterPeriode && isset($row['Periode'])) {
    //             $rowPeriode = $this->excelSerialToDate($row['Periode']);
    //             $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
    //             $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
    //         }

    //         if ($filterPaycek && isset($row['Paycek'])) {
    //             $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //         }

    //         return $matchesPeriode && $matchesPaycek && $isRowSelected;
    //     });

    //     $emailConfig = new Email();
    //     $results = [];

    //     foreach ($filteredData as $employee) {
    //         if (empty($employee['EmployeeId']) && empty($employee['Periode'])) {
    //             continue;
    //         }

    //         // Initialize and set up PDF
    //         $pdf = new TCPDF();
    //         $pdf->AddPage();

    //         $htmlContent = view('testing/index', ['excelData' => $employee]);

    //         // Format columns as needed
    //         $columnsToFormat = ['gaji_pokok', 'tj_jabatan', 'tj_keahlian', 'tj_masa_kerja', 'tj_keluarga', 'tj_transport', 'tj_makan', 'tj_komunikasi', 'tj_pph21', 'tj_hari_raya', 'tj_bpjs_kesehatan', 'bonus', 'lain_lain', 'Total Penerimaan', 'total_pj', 'pj_dibayar', 'sisa_pj', 'pot_absensi', 'pot_keterlambatan', 'Total Potongan', 'total_transfer'];
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($employee[$column])) {
    //                 $employee[$column] = !empty($employee[$column]) ? $this->formatRupiah($employee[$column]) : '-';
    //             }
    //         }

    //         if (isset($employee['Periode'])) {
    //             $employee['Periode'] = !empty($employee['Periode']) ? $this->excelSerialToDate($employee['Periode']) : '-';
    //         }

    //         foreach ($employee as $key => $value) {
    //             $htmlContent = str_replace("{{{$key}}}", $value, $htmlContent);
    //         }

    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');
    //         $pdfOutput = FCPATH . "uploads/paycheck_" . $employee['EmployeeId'] . ".pdf";
    //         $pdf->Output($pdfOutput, 'F');

    //         // Format month and send email
    //         $periodeDate = DateTime::createFromFormat('Y-m-d', $employee['Periode']);
    //         $monthName = $periodeDate->format('F');
    //         $message = str_replace('[Nama Lengkap]', $employee['Nama Lengkap'], $this->ModelTemplates->fetchTemplateBodyTest("Template Paycheck")->template_body);
    //         $message = str_replace('[Periode]', "<b>$monthName</b>", $message);

    //         $this->email->clear(true);
    //         $this->email->setTo($employee['Email']);
    //         $this->email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
    //         $this->email->setSubject('Your Paycheck for ' . $monthName);
    //         $this->email->setMessage($message);
    //         $this->email->attach($pdfOutput);

    //         if (!$this->email->send()) {
    //             $results[] = ['email' => $employee['Email'], 'status' => 'error', 'message' => 'Failed to send paycheck'];
    //         } else {
    //             $results[] = ['email' => $employee['Email'], 'status' => 'success', 'message' => 'Paycheck sent successfully'];
    //         }

    //         unlink($pdfOutput);
    //     }

    //     return $this->response->setJSON(['results' => $results]);
    // }

    // Currently using this working printPDF with DomPDF
    public function printPdf()
    {
        try {
            $templateFilePath = FCPATH . 'asset/layout_slip_gaji.xlsx';
            $templateSpreadsheet = IOFactory::load($templateFilePath);
            $sheetTemplate = $templateSpreadsheet->getActiveSheet();

            // Upload and validate the Excel file
            $uploadFile = $this->request->getFile('formFile');
            if (!$uploadFile->isValid()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid Excel file uploaded.']);
            }
            $excelData = $this->readExcelDataV2($uploadFile);

            // Extract filters and selected rows
            $filterPeriode = $this->request->getPost('filterPeriode');
            $filterPaycek = $this->request->getPost('filterPaycek');
            $selectedRows = json_decode($this->request->getPost('selectedRows'), true);

            // Filter the data based on the given conditions
            $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
                $matchesPeriode = true;
                $matchesPaycek = true;
                // Check if row matches selectedRows (both EmployeeId and name)
                $isRowSelected = empty($selectedRows) || array_filter($selectedRows, function ($selectedRow) use ($row) {
                    return (string)$row['EmployeeId'] === (string)$selectedRow['EmployeeId'] &&
                        $row['Nama Lengkap'] === $selectedRow['name'];
                });
                if ($filterPeriode && isset($row['Periode'])) {
                    $rowPeriode = $this->excelSerialToDate($row['Periode']);
                    $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
                    $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
                }

                if ($filterPaycek && isset($row['Paycek'])) {
                    $matchesPaycek = ($row['Paycek'] === $filterPaycek);
                }

                return $matchesPeriode && $matchesPaycek && $isRowSelected;
            });

            // Prepare email configuration
            $emailConfig = new Email();
            $results = [];

            // Image processing
            $imagePath = FCPATH . 'asset/img/logoken.png';
            $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
            $imageTag = $imageData ? '<img src="data:image/png;base64,' . $imageData . '" style="width:100px;height:auto;">' : '';

            // Convert data to PDF
            foreach ($filteredData as $employee) {
                // Prepare the spreadsheet for the employee
                $spreadsheet = $templateSpreadsheet->copy();
                $sheet = $spreadsheet->getActiveSheet()->setShowGridlines(false);
                // Extract first name for password
                $fullName = $employee['Nama Lengkap'];
                $firstName = explode(' ', $fullName)[0]; // Take the first word as the first name
                $pdfPassword = $firstName . '123'; // Password format: FirstName123

                // Format columns as needed
                $columnsToFormat = ['gaji_pokok', 'tj_jabatan', 'tj_keahlian', 'tj_masa_kerja', 'tj_keluarga', 'tj_transport', 'tj_makan', 'tj_komunikasi', 'tj_pph21', 'tj_hari_raya', 'tj_bpjs_kesehatan', 'bonus', 'lain_lain', 'Total Penerimaan', 'total_pj', 'pj_dibayar', 'sisa_pj', 'pot_absensi', 'pot_keterlambatan', 'Total Potongan', 'total_transfer'];

                // Currency formatting
                foreach ($columnsToFormat as $column) {
                    if (isset($employee[$column])) {
                        $employee[$column] = !empty($employee[$column]) ? $this->formatRupiah($employee[$column]) : '-';
                    }
                }

                // Date formatting
                if (isset($employee['Periode'])) {
                    $employee['Periode'] = !empty($employee['Periode']) ? $this->excelSerialToDate($employee['Periode']) : '-';
                }

                // Replace placeholders
                foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
                    $cellIterator = $rowObj->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    foreach ($cellIterator as $cell) {
                        $cellAddress = $cell->getCoordinate();
                        $cellValue = $cell->getValue();

                        foreach ($employee as $key => $value) {
                            $placeholder = "{{{$key}}}";
                            if (strpos($cellValue, $placeholder) !== false) {
                                $updatedValue = str_replace($placeholder, $value, $cellValue);
                                $sheet->setCellValueExplicit($cellAddress, $updatedValue, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                            }
                        }
                    }
                }

                // Convert spreadsheet to PDF
                $dompdf = new \Dompdf\Dompdf();
                $htmlWriter = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
                ob_start();
                $htmlWriter->save('php://output');
                $htmlContent = ob_get_clean();
                $htmlContent = str_replace('{{ImagePlaceholder}}', $imageTag, $htmlContent);

                $dompdf->loadHtml($htmlContent);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                // Add password protection
                $dompdf->getCanvas()->get_cpdf()->setEncryption($pdfPassword, null, ['print']);
                $pdfOutput = $dompdf->output();



                // Prepare and send the email
                // Format month and send email
                $periodeDate = DateTime::createFromFormat('Y-m-d', $employee['Periode']);
                $monthName = $periodeDate->format('F');
                $message = str_replace('[Nama Lengkap]', $employee['Nama Lengkap'], $this->ModelTemplates->fetchTemplateBodyTest("Template Paycheck")->template_body);
                $message = str_replace('[Periode]', "<b>$monthName</b>", $message);

                $this->email->clear(true);
                $this->email->setTo($employee['Email']);
                $this->email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
                $this->email->setSubject('Your Paycheck for ' . $monthName);
                $this->email->setMessage($message . "<br><br>Your PDF password: <b>{$pdfPassword}</b>");
                $this->email->attach($pdfOutput, 'attachment', 'Paycheck_' . $monthName . '.pdf', 'application/pdf');

                if ($this->email->send()) {
                    $results[] = ['email' => $employee['Email'], 'status' => 'success', 'message' => 'Paycheck sent successfully'];
                } else {
                    $results[] = ['email' => $employee['Email'], 'status' => 'error', 'message' => 'Failed to send paycheck'];
                }
            }

            return $this->response->setJSON(['results' => $results]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // working printPDF with TCPDF
    // public function printPdf()
    // {
    //     try {
    //         $templateFilePath = FCPATH . 'asset/layout_slip_gaji.xlsx';
    //         $templateSpreadsheet = IOFactory::load($templateFilePath);
    //         $sheetTemplate = $templateSpreadsheet->getActiveSheet();

    //         // Upload and validate the Excel file
    //         $uploadFile = $this->request->getFile('formFile');
    //         if (!$uploadFile->isValid()) {
    //             return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid Excel file uploaded.']);
    //         }
    //         $excelData = $this->readExcelDataV2($uploadFile);

    //         // Extract filters and selected rows
    //         $filterPeriode = $this->request->getPost('filterPeriode');
    //         $filterPaycek = $this->request->getPost('filterPaycek');
    //         $selectedRows = json_decode($this->request->getPost('selectedRows'), true);

    //         // Filter the data based on the given conditions
    //         $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
    //             $matchesPeriode = true;
    //             $matchesPaycek = true;
    //             // Check if row matches selectedRows (both EmployeeId and name)
    //             $isRowSelected = empty($selectedRows) || array_filter($selectedRows, function ($selectedRow) use ($row) {
    //                 return (string)$row['EmployeeId'] === (string)$selectedRow['EmployeeId'] &&
    //                     $row['Nama Lengkap'] === $selectedRow['name'];
    //             });
    //             if ($filterPeriode && isset($row['Periode'])) {
    //                 $rowPeriode = $this->excelSerialToDate($row['Periode']);
    //                 $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
    //                 $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
    //             }

    //             if ($filterPaycek && isset($row['Paycek'])) {
    //                 $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //             }

    //             return $matchesPeriode && $matchesPaycek && $isRowSelected;
    //         });

    //         // Prepare email configuration
    //         $emailConfig = new Email();
    //         $results = [];

    //         // Image processing
    //         $imagePath = FCPATH . 'asset/img/logoken.png';
    //         $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
    //         $imageTag = $imageData ? '<img src="data:image/png;base64,' . $imageData . '" style="width:100px;height:auto;">' : '';

    //         // Convert data to PDF
    //         foreach ($filteredData as $employee) {
    //             // Prepare the spreadsheet for the employee
    //             $spreadsheet = $templateSpreadsheet->copy();
    //             $sheet = $spreadsheet->getActiveSheet();
    //             $sheet->setShowGridlines(false);
    //             // Extract first name for password
    //             $fullName = $employee['Nama Lengkap'];
    //             $firstName = explode(' ', $fullName)[0]; // Take the first word as the first name
    //             $pdfPassword = $firstName . '123'; // Password format: FirstName123

    //             // Format columns as needed
    //             $columnsToFormat = ['gaji_pokok', 'tj_jabatan', 'tj_keahlian', 'tj_masa_kerja', 'tj_keluarga', 'tj_transport', 'tj_makan', 'tj_komunikasi', 'tj_pph21', 'tj_hari_raya', 'tj_bpjs_kesehatan', 'bonus', 'lain_lain', 'Total Penerimaan', 'total_pj', 'pj_dibayar', 'sisa_pj', 'pot_absensi', 'pot_keterlambatan', 'Total Potongan', 'total_transfer'];

    //             // Currency formatting
    //             foreach ($columnsToFormat as $column) {
    //                 if (isset($employee[$column])) {
    //                     $employee[$column] = !empty($employee[$column]) ? $this->formatRupiah($employee[$column]) : '-';
    //                 }
    //             }

    //             // Date formatting
    //             if (isset($employee['Periode'])) {
    //                 $employee['Periode'] = !empty($employee['Periode']) ? $this->excelSerialToDate($employee['Periode']) : '-';
    //             }

    //             // Replace placeholders
    //             foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
    //                 $cellIterator = $rowObj->getCellIterator();
    //                 $cellIterator->setIterateOnlyExistingCells(false);

    //                 foreach ($cellIterator as $cell) {
    //                     $cellAddress = $cell->getCoordinate();
    //                     $cellValue = $cell->getValue();

    //                     foreach ($employee as $key => $value) {
    //                         $placeholder = "{{{$key}}}";
    //                         if (strpos($cellValue, $placeholder) !== false) {
    //                             $updatedValue = str_replace($placeholder, $value, $cellValue);
    //                             $sheet->setCellValueExplicit($cellAddress, $updatedValue, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    //                         }
    //                     }
    //                 }
    //             }

    //             // / Convert spreadsheet to HTML
    //             $htmlWriter = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
    //             ob_start();
    //             $htmlWriter->save('php://output');
    //             $htmlContent = ob_get_clean();
    //             $htmlContent = str_replace('{{ImagePlaceholder}}', $imageTag, $htmlContent);

    //             // Initialize TCPDF
    //             $pdf = new \TCPDF();

    //             // Set document information
    //             $pdf->SetCreator(PDF_CREATOR);
    //             $pdf->SetAuthor('Your Name');
    //             $pdf->SetTitle('Paycheck');
    //             $pdf->SetSubject('Employee Paycheck');
    //             $pdf->SetKeywords('paycheck, pdf, tcpdf');
    //             // Set default header and footer
    //             $pdf->setPrintHeader(false);
    //             $pdf->setPrintFooter(false);

    //             // Set default font
    //             $pdf->SetFont('helvetica', '', 12);

    //             // Add a page
    //             $pdf->AddPage();

    //             // Write the HTML content
    //             $pdf->writeHTML($htmlContent, true, false, true, false, '');

    //             // Set password protection
    //             $pdf->SetProtection(['print'], $pdfPassword);

    //             // Output PDF as a string
    //             $pdfOutput = $pdf->Output('Paycheck_' . $employee['EmployeeId'] . '.pdf', 'S');

    //             // Prepare and send the email
    //             // Format month and send email
    //             $periodeDate = DateTime::createFromFormat('Y-m-d', $employee['Periode']);
    //             $monthName = $periodeDate->format('F');
    //             $message = str_replace('[Nama Lengkap]', $employee['Nama Lengkap'], $this->ModelTemplates->fetchTemplateBodyTest("Template Paycheck")->template_body);
    //             $message = str_replace('[Periode]', "<b>$monthName</b>", $message);

    //             $this->email->clear(true);
    //             $this->email->setTo($employee['Email']);
    //             $this->email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
    //             $this->email->setSubject('Your Paycheck for ' . $monthName);
    //             $this->email->setMessage($message . "<br><br>Your PDF password: <b>{$pdfPassword}</b>");
    //             $this->email->attach($pdfOutput, 'attachment', 'Paycheck_' . $monthName . '.pdf', 'application/pdf');

    //             if ($this->email->send()) {
    //                 $results[] = ['email' => $employee['Email'], 'status' => 'success', 'message' => 'Paycheck sent successfully'];
    //             } else {
    //                 $results[] = ['email' => $employee['Email'], 'status' => 'error', 'message' => 'Failed to send paycheck'];
    //             }
    //         }

    //         return $this->response->setJSON(['results' => $results]);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
    //     }
    // }


    //Old checkPDF
    // public function checkPdf()
    // {
    //     // 1. Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     $excelData = $this->readExcelDataV2($uploadFile); // Returns an associative array

    //     // Get filters from POST
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');

    //     if ($filterPeriode) {
    //         $filterPeriode = $this->monthToNumber($filterPeriode);
    //     }


    //     // Filter the data by Periode (month) and Paycek if provided
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek) {
    //         // Skip rows without essential data
    //         if (empty($row['EmployeeId']) || empty($row['Periode'])) {
    //             return false;
    //         }

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


    //     // 3. Create a new TCPDF instance
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Your Name');
    //     $pdf->SetTitle('Paycheck');
    //     $pdf->SetSubject('Paycheck Details');


    //     // Data that is going to be formatted as currency
    //     $columnsToFormat = ['gaji_pokok', 'tj_jabatan', 'tj_keahlian', 'tj_masa_kerja', 'tj_keluarga', 'tj_transport', 'tj_makan', 'tj_komunikasi', 'tj_pph21', 'tj_hari_raya', 'tj_bpjs_kesehatan', 'bonus', 'lain_lain', 'Total Penerimaan', 'total_pj', 'pj_dibayar', 'sisa_pj', 'pot_absensi', 'pot_keterlambatan', 'Total Potongan', 'total_transfer'];

    //     // 4. Loop through each filtered user's data and add a new page for each user
    //     foreach ($filteredData as $row) {
    //         if (empty($row['EmployeeId']) && empty($row['Periode'])) {
    //             continue; // Skip rows without meaningful data
    //         }
    //         // Apply date formatting
    //         if (isset($row['Periode'])) {
    //             $row['Periode'] = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : '-';
    //         }

    //         // Apply currency formatting
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($row[$column])) {
    //                 $row[$column] = !empty($row[$column]) ? $this->formatRupiah($row[$column]) : '-';
    //             }
    //         }

    //         // Add a new page for each user
    //         $pdf->AddPage();

    //         // Load the view page and grab its content
    //         $htmlContent = view('testing/index', ['excelData' => $row]);

    //         // Replace placeholders in the HTML with actual user data
    //         foreach ($row as $key => $value) {
    //             $htmlContent = str_replace("{{{$key}}}", $value, $htmlContent);
    //         }

    //         // Write the HTML content to the PDF
    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');
    //     }

    //     // 5. Set the response content type and output the PDF to the browser
    //     $this->response->setContentType('application/pdf');
    //     // Generate the PDF as inline display
    //     $pdfContent = $pdf->Output('paycheck.pdf', 'S'); // 'S' returns the PDF as a string

    //     // Return the response with appropriate headers for inline display
    //     return $this->response
    //         ->setHeader('Content-Type', 'application/pdf')
    //         ->setHeader('Content-Disposition', 'inline; filename="paycheck.pdf"')
    //         ->setBody($pdfContent);
    // }

    //New checkPDF v1
    // public function checkPdf()
    // {
    //     // 1. Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     $excelData = $this->readExcelDataV2($uploadFile); // Returns an associative array

    //     // Get filters from POST
    //     $filterYear = $this->request->getPost('filterYear');
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');

    //     // Filter the data based on Year, Periode (month), and Paycek
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterYear, $filterPeriode, $filterPaycek) {
    //         if (empty($row['EmployeeId']) || empty($row['Periode'])) {
    //             return false; // Skip rows without essential data
    //         }

    //         $matchesYear = true;
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;

    //         // Filter by Year
    //         if ($filterYear) {
    //             $rowYear = substr($row['Periode'], 0, 4); // Extract year
    //             var_dump("Row Year: {$rowYear}, Filter Year: {$filterYear}");
    //             $matchesYear = ($rowYear === $filterYear);
    //         }


    //         // Filter by Periode (month)
    //         if ($filterPeriode) {
    //             $rowPeriode = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : null;
    //             $rowMonth = substr($rowPeriode, 5, 2); // Extract month
    //             var_dump("Row Month: {$rowMonth}, Filter Periode: {$filterPeriode}");
    //             $matchesPeriode = ($rowMonth === $filterPeriode);
    //         }


    //         // Filter by Paycek
    //         if ($filterPaycek) {
    //             $matchesPaycek = (isset($row['Paycek']) && $row['Paycek'] === $filterPaycek);
    //         }

    //         var_dump("Row: ", $row, "Matches Year: {$matchesYear}, Matches Periode: {$matchesPeriode}, Matches Paycek: {$matchesPaycek}");

    //         // Return true if all conditions are met
    //         return $matchesYear && $matchesPeriode && $matchesPaycek;
    //     });
    //     die;
    //     // 2. Initialize TCPDF
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Your Name');
    //     $pdf->SetTitle('Paycheck');
    //     $pdf->SetSubject('Paycheck Details');

    //     // Format columns as currency
    //     $columnsToFormat = [
    //         'gaji_pokok',
    //         'tj_jabatan',
    //         'tj_keahlian',
    //         'tj_masa_kerja',
    //         'tj_keluarga',
    //         'tj_transport',
    //         'tj_makan',
    //         'tj_komunikasi',
    //         'tj_pph21',
    //         'tj_hari_raya',
    //         'tj_bpjs_kesehatan',
    //         'bonus',
    //         'lain_lain',
    //         'Total Penerimaan',
    //         'total_pj',
    //         'pj_dibayar',
    //         'sisa_pj',
    //         'pot_absensi',
    //         'pot_keterlambatan',
    //         'Total Potongan',
    //         'total_transfer'
    //     ];

    //     // 3. Generate PDF pages for filtered data
    //     foreach ($filteredData as $row) {
    //         if (empty($row['EmployeeId']) || empty($row['Periode'])) {
    //             continue; // Skip invalid rows
    //         }

    //         // Format the Periode column as a readable date
    //         if (isset($row['Periode'])) {
    //             $row['Periode'] = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : '-';
    //         }

    //         // Format currency columns
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($row[$column])) {
    //                 $row[$column] = !empty($row[$column]) ? $this->formatRupiah($row[$column]) : '-';
    //             }
    //         }

    //         // Add a new page to the PDF for each row
    //         $pdf->AddPage();

    //         // Load the view and replace placeholders with actual data
    //         $htmlContent = view('testing/index', ['excelData' => $row]);
    //         foreach ($row as $key => $value) {
    //             $htmlContent = str_replace("{{{$key}}}", $value, $htmlContent);
    //         }

    //         // Write the HTML content to the PDF
    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');
    //     }

    //     // 4. Output the PDF to the browser
    //     $this->response->setContentType('application/pdf');
    //     $pdfContent = $pdf->Output('paycheck.pdf', 'S'); // Generate the PDF as a string
    //     return $this->response
    //         ->setHeader('Content-Type', 'application/pdf')
    //         ->setHeader('Content-Disposition', 'inline; filename="paycheck.pdf"')
    //         ->setBody($pdfContent);
    // }

    // Current working CheckPDF
    // public function checkPdf()
    // {
    //     // 1. Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     $excelData = $this->readExcelDataV2($uploadFile); // Returns an associative array

    //     // Get filters from POST
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');
    //     $selectedRows = json_decode($this->request->getPost('selectedRows'), true);
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;
    //         $isRowSelected = empty($selectedRows) || in_array((string)$row['EmployeeId'], array_map('strval', $selectedRows));

    //         if ($filterPeriode && isset($row['Periode'])) {
    //             $rowPeriode = $this->excelSerialToDate($row['Periode']);
    //             $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
    //             $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
    //         }

    //         if ($filterPaycek && isset($row['Paycek'])) {
    //             $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //         }

    //         return $matchesPeriode && $matchesPaycek && $isRowSelected;
    //     });



    //     // 3. Create a new TCPDF instance
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Your Name');
    //     $pdf->SetTitle('Paycheck');
    //     $pdf->SetSubject('Paycheck Details');


    //     // Data that is going to be formatted as currency
    //     $columnsToFormat = ['gaji_pokok', 'tj_jabatan', 'tj_keahlian', 'tj_masa_kerja', 'tj_keluarga', 'tj_transport', 'tj_makan', 'tj_komunikasi', 'tj_pph21', 'tj_hari_raya', 'tj_bpjs_kesehatan', 'bonus', 'lain_lain', 'Total Penerimaan', 'total_pj', 'pj_dibayar', 'sisa_pj', 'pot_absensi', 'pot_keterlambatan', 'Total Potongan', 'total_transfer'];

    //     // 4. Loop through each filtered user's data and add a new page for each user
    //     foreach ($filteredData as $row) {
    //         if (empty($row['EmployeeId']) && empty($row['Periode'])) {
    //             continue; // Skip rows without meaningful data
    //         }
    //         // Apply date formatting
    //         if (isset($row['Periode'])) {
    //             $row['Periode'] = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : '-';
    //         }

    //         // Apply currency formatting
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($row[$column])) {
    //                 $row[$column] = !empty($row[$column]) ? $this->formatRupiah($row[$column]) : '-';
    //             }
    //         }

    //         // Add a new page for each user
    //         $pdf->AddPage();

    //         // Load the view page and grab its content
    //         $htmlContent = view('testing/index', ['excelData' => $row]);

    //         // Replace placeholders in the HTML with actual user data
    //         foreach ($row as $key => $value) {
    //             $htmlContent = str_replace("{{{$key}}}", $value, $htmlContent);
    //         }

    //         // Write the HTML content to the PDF
    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');
    //     }

    //     // 5. Set the response content type and output the PDF to the browser
    //     $this->response->setContentType('application/pdf');
    //     // Generate the PDF as inline display
    //     $pdfContent = $pdf->Output('paycheck.pdf', 'S'); // 'S' returns the PDF as a string

    //     // Return the response with appropriate headers for inline display
    //     return $this->response
    //         ->setHeader('Content-Type', 'application/pdf')
    //         ->setHeader('Content-Disposition', 'inline; filename="paycheck.pdf"')
    //         ->setBody($pdfContent);
    // }

    // Xls CheckPDF test ver 1.0
    // public function checkPdf()
    // {
    //     // Load the Excel template
    //     $templateFilePath = FCPATH . 'asset/layout_slip_gaji.xlsx';
    //     $spreadsheet = IOFactory::load($templateFilePath);
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     $excelData = $this->readExcelDataV2($uploadFile);

    //     // Get filters from POST
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');
    //     $selectedRows = json_decode($this->request->getPost('selectedRows'), true);

    //     // Filter the data
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;
    //         $isRowSelected = empty($selectedRows) || in_array((string)$row['EmployeeId'], array_map('strval', $selectedRows));

    //         if ($filterPeriode && isset($row['Periode'])) {
    //             $rowPeriode = $this->excelSerialToDate($row['Periode']);
    //             $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
    //             $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
    //         }

    //         if ($filterPaycek && isset($row['Paycek'])) {
    //             $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //         }

    //         return $matchesPeriode && $matchesPaycek && $isRowSelected;
    //     });

    //     // Create a PDF instance
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Your Name');
    //     $pdf->SetTitle('Paycheck');
    //     $pdf->SetSubject('Paycheck Details');

    //     foreach ($filteredData as $row) {
    //         // Add a new page to the PDF
    //         $pdf->AddPage();

    //         // Replace placeholders in the Excel template
    //         foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
    //             $cellIterator = $rowObj->getCellIterator();
    //             $cellIterator->setIterateOnlyExistingCells(false);

    //             foreach ($cellIterator as $cell) {
    //                 $cellAddress = $cell->getCoordinate();
    //                 $cellValue = $cell->getValue();

    //                 foreach ($row as $key => $value) {
    //                     $placeholder = "{{{$key}}}";
    //                     if (strpos($cellValue, $placeholder) !== false) {
    //                         $cellValue = str_replace($placeholder, $value, $cellValue);
    //                         $sheet->setCellValue($cellAddress, $cellValue);
    //                     }
    //                 }
    //             }
    //         }
    //         // Export the filled Excel template to HTML
    //         $htmlWriter = IOFactory::createWriter($spreadsheet, 'Html');
    //         ob_start();
    //         $htmlWriter->save('php://output');
    //         $htmlContent = ob_get_clean();

    //         // Write the HTML content to the PDF
    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');
    //     }

    //     // Output the PDF to the browser
    //     $this->response->setContentType('application/pdf');
    //     $pdfContent = $pdf->Output('paycheck.pdf', 'S');

    //     return $this->response
    //         ->setHeader('Content-Type', 'application/pdf')
    //         ->setHeader('Content-Disposition', 'inline; filename="paycheck.pdf"')
    //         ->setBody($pdfContent);
    // }

    // Xls CheckPDF Ver 2.0 with tcpdf
    // public function checkPdf()
    // {
    //     // Load the Excel template
    //     $templateFilePath = FCPATH . 'asset/layout_slip_gaji.xlsx';
    //     $spreadsheet = IOFactory::load($templateFilePath);
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     if (!$uploadFile->isValid()) {
    //         throw new \RuntimeException('Invalid Excel file uploaded.');
    //     }
    //     $excelData = $this->readExcelDataV2($uploadFile);

    //     // Get filters from POST
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');
    //     $selectedRows = json_decode($this->request->getPost('selectedRows'), true);

    //     // Filter the data
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;
    //         $isRowSelected = empty($selectedRows) || in_array((string)$row['EmployeeId'], array_map('strval', $selectedRows));

    //         if ($filterPeriode && isset($row['Periode'])) {
    //             $rowPeriode = $this->excelSerialToDate($row['Periode']);
    //             $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
    //             $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
    //         }

    //         if ($filterPaycek && isset($row['Paycek'])) {
    //             $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //         }

    //         return $matchesPeriode && $matchesPaycek && $isRowSelected;
    //     });

    //     // Create a PDF instance
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Your Name');
    //     $pdf->SetTitle('Paycheck');
    //     $pdf->SetSubject('Paycheck Details');

    //     // Format columns as currency
    //     $columnsToFormat = [
    //         'gaji_pokok',
    //         'tj_jabatan',
    //         'tj_keahlian',
    //         'tj_masa_kerja',
    //         'tj_keluarga',
    //         'tj_transport',
    //         'tj_makan',
    //         'tj_komunikasi',
    //         'tj_pph21',
    //         'tj_hari_raya',
    //         'tj_bpjs_kesehatan',
    //         'bonus',
    //         'lain_lain',
    //         'Total Penerimaan',
    //         'total_pj',
    //         'pj_dibayar',
    //         'sisa_pj',
    //         'pot_absensi',
    //         'pot_keterlambatan',
    //         'Total Potongan',
    //         'total_transfer'
    //     ];

    //     foreach ($filteredData as $row) {
    //         // Reload the Excel template for each row
    //         $spreadsheet = IOFactory::load($templateFilePath);
    //         $sheet = $spreadsheet->getActiveSheet();
    //         // Apply currency formatting
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($row[$column])) {
    //                 $row[$column] = !empty($row[$column]) ? $this->formatRupiah($row[$column]) : '-';
    //             }
    //         }

    //         // Add a new page to the PDF
    //         $pdf->AddPage();

    //         // Replace placeholders in the Excel template
    //         foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
    //             $cellIterator = $rowObj->getCellIterator();
    //             $cellIterator->setIterateOnlyExistingCells(false);

    //             foreach ($cellIterator as $cell) {
    //                 $cellAddress = $cell->getCoordinate();
    //                 $cellValue = $cell->getValue();

    //                 foreach ($row as $key => $value) {
    //                     $placeholder = "{{{$key}}}";
    //                     if (strpos($cellValue, $placeholder) !== false) {
    //                         $cellValue = str_replace($placeholder, $value, $cellValue);
    //                         $sheet->setCellValue($cellAddress, $cellValue);
    //                     }
    //                 }
    //             }
    //         }

    //         // Export the filled Excel template to HTML
    //         $htmlWriter = IOFactory::createWriter($spreadsheet, 'Html');
    //         ob_start();
    //         $htmlWriter->setPreCalculateFormulas(true); // Enable formula calculations
    //         $htmlWriter->save('php://output');
    //         $htmlContent = ob_get_clean();

    //         // Write the HTML content to the PDF
    //         $pdf->writeHTML($htmlContent, true, false, true, false, '');
    //         // Save the HTML content to a file
    //         file_put_contents(FCPATH . 'debug_output.html', $htmlContent);
    //     }

    //     // Output the PDF to the browser
    //     return $this->response
    //         ->setHeader('Content-Type', 'application/pdf')
    //         ->setHeader('Content-Disposition', 'inline; filename="paycheck.pdf"')
    //         ->setBody($pdf->Output('paycheck.pdf', 'S'));
    // }

    //Xls checkPDF with dom (Currently using this 14 Jan 2025)
    // public function checkPdf()
    // {
    //     // Load the Excel template
    //     $templateFilePath = FCPATH . 'asset/layout_slip_gaji.xlsx';
    //     $spreadsheet = IOFactory::load($templateFilePath);
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // Read data from the uploaded Excel file
    //     $uploadFile = $this->request->getFile('formFile');
    //     if (!$uploadFile->isValid()) {
    //         throw new \RuntimeException('Invalid Excel file uploaded.');
    //     }
    //     $excelData = $this->readExcelDataV2($uploadFile);

    //     // Get filters from POST
    //     $filterPeriode = $this->request->getPost('filterPeriode');
    //     $filterPaycek = $this->request->getPost('filterPaycek');
    //     $selectedRows = json_decode($this->request->getPost('selectedRows'), true);

    //     // Filter the data
    //     $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
    //         $matchesPeriode = true;
    //         $matchesPaycek = true;
    //         $isRowSelected = empty($selectedRows) || in_array((string)$row['EmployeeId'], array_map('strval', $selectedRows));

    //         if ($filterPeriode && isset($row['Periode'])) {
    //             $rowPeriode = $this->excelSerialToDate($row['Periode']);
    //             $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
    //             $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
    //         }

    //         if ($filterPaycek && isset($row['Paycek'])) {
    //             $matchesPaycek = ($row['Paycek'] === $filterPaycek);
    //         }

    //         return $matchesPeriode && $matchesPaycek && $isRowSelected;
    //     });

    //     // Initialize a variable to store the combined HTML content
    //     $combinedHtmlContent = '';

    //     foreach ($filteredData as $row) {
    //         // Reload the Excel template for each row
    //         $spreadsheet = IOFactory::load($templateFilePath);
    //         $sheet = $spreadsheet->getActiveSheet();
    //         // Hide gridlines in the HTML   
    //         $sheet->setShowGridlines(false);

    //         // Currency to format
    //         $columnsToFormat = [
    //             'gaji_pokok',
    //             'tj_jabatan',
    //             'tj_keahlian',
    //             'tj_masa_kerja',
    //             'tj_keluarga',
    //             'tj_transport',
    //             'tj_makan',
    //             'tj_komunikasi',
    //             'tj_pph21',
    //             'tj_hari_raya',
    //             'tj_bpjs_kesehatan',
    //             'bonus',
    //             'lain_lain',
    //             'Total Penerimaan',
    //             'total_pj',
    //             'pj_dibayar',
    //             'sisa_pj',
    //             'pot_absensi',
    //             'pot_keterlambatan',
    //             'Total Potongan',
    //             'total_transfer'
    //         ];

    //         // Apply currency formatting
    //         foreach ($columnsToFormat as $column) {
    //             if (isset($row[$column])) {
    //                 $row[$column] = !empty($row[$column]) ? $this->formatRupiah($row[$column]) : '-';
    //             }
    //         }

    //         // Apply date formatting
    //         if (isset($row['Periode'])) {
    //             $row['Periode'] = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : '-';
    //         }

    //         // Replace placeholders in the Excel template
    //         foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
    //             $cellIterator = $rowObj->getCellIterator();
    //             $cellIterator->setIterateOnlyExistingCells(false);

    //             foreach ($cellIterator as $cell) {
    //                 $cellAddress = $cell->getCoordinate();
    //                 $cellValue = $cell->getValue();

    //                 //replace all the placeholder with the value
    //                 foreach ($row as $key => $value) {
    //                     $placeholder = "{{{$key}}}";
    //                     if (strpos($cellValue, $placeholder) !== false) {
    //                         $cellValue = str_replace($placeholder, $value, $cellValue);
    //                         $sheet->setCellValue($cellAddress, $cellValue);
    //                     }
    //                 }
    //             }
    //         }

    //         // Convert the populated Excel to HTML
    //         $htmlWriter = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
    //         ob_start();
    //         $htmlWriter->save('php://output');
    //         $htmlContent = ob_get_clean();
    //         // Embed image as Base64
    //         $imagePath = FCPATH . 'asset/img/logoken.png'; // Path to the image file
    //         if (file_exists($imagePath)) {
    //             $imageData = base64_encode(file_get_contents($imagePath));
    //             $imageSrc = 'data:image/png;base64,' . $imageData;
    //             $htmlContent = str_replace('{{ImagePlaceholder}}', '<img src="' . $imageSrc . '" alt="Company Logo" style="width:100px;height:auto;">', $htmlContent);
    //         }
    //         // Append this row's HTML content to the combined content
    //         $combinedHtmlContent .= $htmlContent;
    //     }

    //     // Generate PDF using DomPDF with all the combined content
    //     $dompdf = new \Dompdf\Dompdf();
    //     $dompdf->loadHtml($combinedHtmlContent);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Return PDF as a response
    //     $pdfOutput = $dompdf->output();
    //     return $this->response->setHeader('Content-Type', 'application/pdf')->setBody($pdfOutput);
    // }

    // Xls CheckPDF with Dom Optimize testing
    public function checkPdf()
    {
        $templateFilePath = FCPATH . 'asset/layout_slip_gaji.xlsx';
        $templateSpreadsheet = IOFactory::load($templateFilePath);
        $sheetTemplate = $templateSpreadsheet->getActiveSheet();

        $uploadFile = $this->request->getFile('formFile');
        if (!$uploadFile->isValid()) {
            throw new \RuntimeException('Invalid Excel file uploaded.');
        }
        $excelData = $this->readExcelDataV2($uploadFile);

        $filterPeriode = $this->request->getPost('filterPeriode');
        $filterPaycek = $this->request->getPost('filterPaycek');
        $selectedRows = json_decode($this->request->getPost('selectedRows'), true);

        $filteredData = array_filter($excelData['data'], function ($row) use ($filterPeriode, $filterPaycek, $selectedRows) {
            $matchesPeriode = true;
            $matchesPaycek = true;
            $isRowSelected = empty($selectedRows) || in_array((string)$row['EmployeeId'], array_map('strval', $selectedRows));

            if ($filterPeriode && isset($row['Periode'])) {
                $rowPeriode = $this->excelSerialToDate($row['Periode']);
                $filterPeriodeFormatted = date('Y-m-d', strtotime($filterPeriode));
                $matchesPeriode = ($rowPeriode === $filterPeriodeFormatted);
            }

            if ($filterPaycek && isset($row['Paycek'])) {
                $matchesPaycek = ($row['Paycek'] === $filterPaycek);
            }

            return $matchesPeriode && $matchesPaycek && $isRowSelected;
        });

        $imagePath = FCPATH . 'asset/img/logoken.png';
        $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
        $imageTag = $imageData ? '<img src="data:image/png;base64,' . $imageData . '" style="width:100px;height:auto;">' : '';

        $htmlContents = [];
        foreach ($filteredData as $row) {
            $spreadsheet = $templateSpreadsheet->copy();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setShowGridlines(false);

            // Adjust column widths
            foreach ($sheet->getColumnIterator() as $column) {
                $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
            }

            // Adjust row heights
            foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(-1); // Auto-adjust row height
            }

            // Currency formatting
            $columnsToFormat = [
                'gaji_pokok',
                'tj_jabatan',
                'tj_keahlian',
                'tj_masa_kerja',
                'tj_keluarga',
                'tj_transport',
                'tj_makan',
                'tj_komunikasi',
                'tj_pph21',
                'tj_hari_raya',
                'tj_bpjs_kesehatan',
                'bonus',
                'lain_lain',
                'Total Penerimaan',
                'total_pj',
                'pj_dibayar',
                'sisa_pj',
                'pot_absensi',
                'pot_keterlambatan',
                'Total Potongan',
                'total_transfer'
            ];

            // Currency formatting
            foreach ($columnsToFormat as $column) {
                if (isset($row[$column])) {
                    $row[$column] = !empty($row[$column]) ? $this->formatRupiah($row[$column]) : '-';
                }
            }

            // Date formatting
            if (isset($row['Periode'])) {
                $row['Periode'] = !empty($row['Periode']) ? $this->excelSerialToDate($row['Periode']) : '-';
            }

            // Replace placeholders
            foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
                $cellIterator = $rowObj->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                foreach ($cellIterator as $cell) {
                    $cellAddress = $cell->getCoordinate();
                    $cellValue = $cell->getValue();

                    foreach ($row as $key => $value) {
                        $placeholder = "{{{$key}}}";
                        if (strpos($cellValue, $placeholder) !== false) {
                            $updatedValue = str_replace($placeholder, $value, $cellValue);
                            $sheet->setCellValueExplicit($cellAddress, $updatedValue, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                        }
                    }
                }
            }

            // Convert to HTML
            $htmlWriter = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
            ob_start();
            $htmlWriter->save('php://output');
            $htmlContents[] = str_replace('{{ImagePlaceholder}}', $imageTag, ob_get_clean());
        }

        // Combine and add styles
        $combinedHtmlContent = '<style>
        table { border-collapse: collapse; width: 100%; }
        td, th { padding: 5px; text-align: left; }
    </style>' . implode('<hr>', $htmlContents);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($combinedHtmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response->setHeader('Content-Type', 'application/pdf')->setBody($dompdf->output());
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
            // var_dump($excelData);
            // Return the data in JSON format
            echo json_encode($excelData);
        }
    }

    // Read function baru 
    // public function read()
    // {
    //     $uploadFile = $this->request->getFile('formFile');

    //     if (!$uploadFile) {
    //         echo json_encode(["error" => "No file uploaded."]);
    //     } else {
    //         // Read data from Excel file
    //         $excelData = $this->readExcelData($uploadFile);
    //         // Return only unique Periode values to the front-end
    //         echo json_encode([
    //             'columns' => $excelData['columns'],
    //             'data' => $excelData['data'],
    //             'periodes' => $excelData['periodes']
    //         ]);
    //     }
    // }


    // Method to process the Excel data for DataTable
    // protected function readExcelData($file)
    // {
    //     $spreadsheet = IOFactory::load($file->getTempName());
    //     $worksheet = $spreadsheet->getActiveSheet();

    //     $data = [];
    //     foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
    //         $rowData = [];
    //         foreach ($row->getCellIterator() as $cell) {
    //             // Use getCalculatedValue to evaluate formulas
    //             $rowData[] = $cell->getCalculatedValue();
    //         }

    //         // Skip the first row if it contains headers
    //         if ($rowIndex === 2) {
    //             $columns = $rowData; // Store column names for the DataTable
    //         } else {
    //             $data[] = $rowData;
    //         }
    //     }
    //     return ['columns' => $columns, 'data' => $data];
    // }

    // Fungsi baru readExcelData v1
    protected function readExcelData($file)
    {
        $spreadsheet = IOFactory::load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        $periodes = []; // Array to store extracted years
        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $value = $cell->getCalculatedValue();
                $rowData[] = $value;

                // Extract year if it's in a recognizable date format
                if ($rowIndex > 1 && $cell->getColumn() === 'F') { // Assuming "Periode" is in column D
                    if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                        $formattedDate = $dateValue->format('d-M-y'); // Format as "31-Jan-24"
                        $periodes[] = $formattedDate;
                    }
                }
            }

            // Skip the first row if it contains headers
            if ($rowIndex === 2) {
                $columns = $rowData; // Store column names for the DataTable
            } else {
                $data[] = $rowData;
            }
        }

        $uniqueYears = array_unique($periodes);
        sort($uniqueYears); // Sort years in ascending order

        return ['columns' => $columns, 'data' => $data, 'periodes' => $uniqueYears];
    }

    // Fungsi baru readExcelData v2
    // protected function readExcelData($file)
    // {
    //     $spreadsheet = IOFactory::load($file->getTempName());
    //     $worksheet = $spreadsheet->getActiveSheet();

    //     $data = [];
    //     $columns = [];
    //     $periodes = []; // Array to store extracted Periode values

    //     foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
    //         $rowData = [];
    //         foreach ($row->getCellIterator() as $cell) {
    //             $value = $cell->getCalculatedValue();
    //             $rowData[] = $value;

    //             // Check if the column is "Periode" and extract its unique value
    //             if ($rowIndex > 1 && $cell->getColumn() === 'F') { // Assuming "Periode" is in column D
    //                 if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
    //                     $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
    //                     $formattedDate = $dateValue->format('d-M-y'); // Format as "31-Jan-24"
    //                     $periodes[] = $formattedDate;
    //                 }
    //             }
    //         }

    //         if ($rowIndex === 1) {
    //             $columns = $rowData; // Store column names for DataTable headers
    //         } else {
    //             $data[] = $rowData;
    //         }
    //     }

    //     $uniquePeriodes = array_unique($periodes); // Remove duplicates
    //     sort($uniquePeriodes); // Sort the periods in ascending order

    //     return ['columns' => $columns, 'data' => $data, 'periodes' => $uniquePeriodes];
    // }



    // Method to format the excel value to rupiah
    protected function formatRupiah($value)
    {
        // Ensure the value is a float and format it as Indonesian Rupiah (Rp)
        return number_format((float) $value, 0, ',', '.');
    }

    // Method to convert serial number to date from excel
    protected function excelSerialToDate($serial)
    {
        $serial = (float)$serial;
        // Excel dates start from January 1, 1900
        $unixDate = ($serial - 25569) * 86400;
        $excelDate = gmdate("Y-m-d", $unixDate);

        return $excelDate;
    }

    // Method to process the Excel data for pdf
    protected function readExcelDataV2($uploadFile)
    {
        $spreadsheet = IOFactory::load($uploadFile->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $data = [];
        $columns = [];

        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getCalculatedValue();
            }

            if ($rowIndex === 1) {
                // First row contains the headers/column names
                $columns = $rowData;
            } else {
                // Combine column names with data rows
                $data[] = array_combine($columns, $rowData);
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

    protected function monthToNumber($month)
    {
        $months = [
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sep' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        ];
        return $months[$month] ?? null;
    }

    public function testingpdf()
    {
        // Initialize DomPDF
        $dompdf = new \Dompdf\Dompdf();

        // Get the base64-encoded image
        $imagePath = FCPATH . 'asset/img/logoken.png'; // Adjust to your image path
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Simple HTML content with the base64 image
        $htmlContent = '
        <html>
            <head>
                <title>Base64 Image Test</title>
            </head>
            <body>
                <h1>Test PDF with Embedded Base64 Image</h1>
                <img src="' . $imageSrc . '" alt="Base64 Image" style="width:200px; height:auto;">
            </body>
        </html>
    ';

        // Load HTML content
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Output the PDF to the browser
        return $this->response->setHeader('Content-Type', 'application/pdf')->setBody($dompdf->output());
    }
}
