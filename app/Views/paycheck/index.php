<?= $this->extend('template/index'); ?>


<?= $this->section('links'); ?>
<title><?= $title ?></title>


<!-- CSS -->
<link rel="stylesheet" href="<?= base_url('asset/css/paycheck.css') ?>">

<!-- DataTable -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')  ?>">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">

<?= $this->endSection('links'); ?>

<!-- Main Content -->
<?= $this->section('content'); ?>

<!-- Form submit -->
<form id="excelForm" enctype="multipart/form-data" action="<?= base_url('/paycheck/output') ?>" method="POST">
    <h1><?= getTranslation('testing-text') ?></h1>
    <div class="mb-3">
        <label for="formFile" id="formFilelbl" class="form-label"><?= getTranslation('text-input-excel') ?></label>
        <input class="form-control" type="file" id="formFile" name="formFile">
    </div>
    <input type="hidden" id="filterPeriodeInput" name="filterPeriode">
    <input type="hidden" id="filterPaycekInput" name="filterPaycek">
    <button type="button" id="btnModal" class="btn btn-warning"><?= getTranslation('text-generate-file') ?></button>
</form>

<!-- Datatable -->
<div class="col-12" id="dataTable" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                DataTable Group
                <span id="fileNameDisplay" style="font-weight: normal; font-size: 1rem; color: gray;"></span>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Filter Year -->
            <!-- <div class="form-group">
                <label for="filterYear"><?= getTranslation('text-filter-year') ?></label>
                <i class="material-symbols-outlined" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= getTranslation('text-info-year') ?>">info</i>
                <select name="filterYear" id="filterYear" class="form-control">
                    <option value="">asd</option>
                </select>
            </div> -->
            <!-- Filter Periode -->
            <!-- <div class="form-group">
                <label for="filterPeriode"><?= getTranslation('text-filter-periode') ?></label>
                <i class="material-symbols-outlined" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= getTranslation('text-info-periode') ?>">info</i>
                <select name="filterPeriode" id="filterPeriode" class="form-control">
                    <option value="">Select Option</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div> -->
            <div class="form-group">
                <label for="filterPeriode"><?= getTranslation('text-filter-periode') ?></label>
                <i class="material-symbols-outlined" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= getTranslation('text-info-periode') ?>">info</i>
                <select name="filterPeriode" id="filterPeriode" class="form-control">
                    <option value="">Select Periode</option>

                </select>
            </div>
            <!-- Filter Paycek -->
            <div class="form-group">
                <label for="filterPaycek"><?= getTranslation('text-filter-elegibilitas') ?></label>
                <i class="material-symbols-outlined" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= htmlspecialchars(getTranslation('text-info-filter')) ?>">info</i>
                <select name="filterPaycek" id="filterPaycek" class="form-control">
                    <option value=""><--- Select Option --></option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <!-- Datatable -->
            <table id="example" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="selectAll" />
                        </th>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">Bank</th>
                        <th scope="col">No. Rek</th>
                        <th scope="col">Send slip</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="button-container" id="button-container">
            <button type="button" id="btnPaycheck" class="btn btn-success" style="display: none;"><?= getTranslation('text-send-email') ?></button>
            <button type="button" id="btnCheckpdf" class="btn btn-info" style="display: none;"><?= getTranslation('text-check-pdf') ?></button>
        </div>
    </div>
    <!-- /.card -->
</div>

<!-- </div> -->
<?= $this->endSection('content'); ?>

<?= $this->section('scripts'); ?>

<!-- jquery-validation -->
<script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
<!-- Script Data Table -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('asset/AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('asset/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Jquery -->
<script>
    var table; //Variable to store dataTable
    $(document).ready(function() {
        $('#btnModal').click(function() {
            var fileInput = document.getElementById('formFile');
            Swal.fire({
                title: 'Processing...',
                html: '<div class="loading-spinner"></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            // Check if button text is "Insert new file"
            if ($('#btnModal').text() === '<?= getTranslation('text-insert-new-file') ?>') {
                // Reset the form and show the file input
                // Show confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to insert a new file?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, insert it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the desired page
                        window.location.href = '<?= base_url('/paycheck') ?>';
                    }
                });
                return;
                Swal.fire({
                    title: 'Processing...',
                    html: '<div class="loading-spinner"></div>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            }

            if (!fileInput.files || !fileInput.files[0]) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a file!',
                });
            } else {
                var fileName = fileInput.files[0].name;
                var fileExtension = fileName.split('.').pop().toLowerCase();
                if (fileExtension !== 'xls' && fileExtension !== 'xlsx') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incorrect file format!',
                        text: 'Please select a valid Excel file (.xls or .xlsx).',
                    });
                    return;
                }
                var formData = new FormData();
                formData.append('formFile', fileInput.files[0]);
                $.ajax({
                    url: '<?= base_url('/paycheck/read') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    // New success function v2
                    success: function(response) {
                        var responseData = JSON.parse(response); // Parsing response dari JSON
                        console.log('response data', responseData);
                        // Populate the year dropdown
                        var periodeDropdown = $('#filterPeriode');
                        periodeDropdown.empty().append('<option value="">Select Periode</option>');
                        responseData.periodes.forEach(function(periode) {
                            periodeDropdown.append('<option value="' + periode + '">' + periode + '</option>');
                        });

                        // Memfilter data dari responseData.data
                        var filteredData = responseData.data.filter(function(row) {
                            // Convert object values to an array and check if any value is not null
                            return Object.values(row).some(function(cell) {
                                return cell !== null;
                            });
                        });

                        if (filteredData.length === 0) {
                            console.log('All rows contain null values');
                            return;
                        }
                        var columns = filteredData.shift();
                        console.log('columns', columns);
                        var convertedData = filteredData.map(function(row) {
                            var rowData = {};
                            for (var i = 0; i < columns.length; i++) {
                                if (columns[i] === 'Periode') {
                                    row[i] = excelSerialToDate(row[i]);
                                    if (row[i] === 'Invalid Date') {
                                        row[i] = null;
                                    }
                                }
                                // Check if Employee ID is missing
                                if (columns[i] === 'EmployeeId' && !row[i]) {
                                    row[i] = 'No Employee ID'; // Add text when missing
                                }
                                rowData[columns[i]] = row[i];
                            }
                            return rowData;
                        });

                        // Convert Periode column to match dropdown format (DD-MMM-YY) for filtering
                        convertedData.forEach(row => {
                            if (row.Periode) {
                                row.Periode = formatDateToMatchDropdown(row.Periode); // Custom function
                            }
                        });

                        table = $('#example').DataTable({
                            responsive: true,
                            lengthChange: false,
                            autoWidth: false,
                            data: convertedData, // This should contain the full data but we'll only show specific columns
                            destroy: true,
                            columns: [{ // Checkbox column
                                    data: null,
                                    orderable: false,
                                    className: 'select-checkbox',
                                    render: function(data, type, row) {
                                        return '<input type="checkbox" class="row-select" />';
                                    }
                                }, {
                                    data: 'EmployeeId' // Column for Employee ID
                                }, {
                                    data: 'Periode' // Column for Periode
                                },
                                {
                                    data: 'Nama Lengkap' // Column for Nama
                                },
                                {
                                    data: 'total_transfer', // Column for total_transfer with custom rendering
                                    render: function(data, type, row) {
                                        return formatRupiah(data); // Ensure salary is displayed in currency format
                                    }
                                }, {
                                    data: 'Bank' // Column for Bank
                                }, {
                                    data: 'AccountNo' // Column for Account No.
                                }, {
                                    data: 'Send Salary Slip' // Column for Salary.
                                }, {
                                    data: 'Email' // Column for Salary.
                                }
                            ]
                        });

                        //Success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!!',
                            text: 'Record has been updated!',
                            allowOutsideClick: false,
                        });


                        // Event listener for year and period filters
                        $('#filterPeriode').on('change', function() {
                            const selectedPeriod = $('#filterPeriode').val();

                            if (selectedPeriod) {
                                table.column(2).search(`^${selectedPeriod}$`, true, false).draw(); // Exact match
                                $('#example').show();
                            } else {
                                table.column(2).search('').draw(); // Clear filter
                                $('#example').hide();
                            }
                        });


                        // Event listener for eligible dropdown
                        $('#filterPaycek').on('change', function() {
                            var selectedOption = $(this).val();

                            // Filter the DataTable by month
                            var table = $('#example').DataTable();

                            // If no month is selected, reset the filter
                            if (selectedOption === "") {
                                table.column(7).search('').draw(); // Reset filter
                            } else {
                                // Use a regular expression to match the month in "YYYY-MM-DD" format
                                table.column(7).search('^' + selectedOption + '$', true, false).draw(); // Apply the filter
                            }
                        });

                        console.log('Converted Data Periode:', convertedData.map(row => row.Periode));


                        $('#btnModal').text('<?= getTranslation('text-insert-new-file') ?>');
                        $('#formFilelbl').hide();
                        $('#fileNameDisplay').text(` - ${fileName}`);
                        $('#formFile').hide();
                        $('#dataTable').show();
                        $('#example').hide();
                        // Handle "Select All" checkbox
                        $('#selectAll').on('click', function() {
                            // Get all checkboxes within the table body
                            var $checkboxes = $('#example tbody input[type="checkbox"]');
                            // Check or uncheck all checkboxes based on the state of the "selectAll" checkbox
                            $checkboxes.prop('checked', $(this).is(':checked'));
                            // Log the state of the "selectAll" checkbox to the console
                            console.log('"selectAll" checkbox is checked:', $(this).is(':checked'));

                            // Log the number of checked checkboxes in the table
                            console.log('Number of checked checkboxes:', $checkboxes.filter(':checked').length);
                        });
                        // Handle individual checkbox click
                        $('#example tbody').on('change', 'input[type="checkbox"]', function() {
                            if (!$(this).is(':checked')) {
                                $('#selectAll').prop('checked', false);
                            }

                            // Log the state of the individual checkbox to the console
                            console.log('Individual checkbox is checked:', $(this).is(':checked'));

                            // Log the number of checked checkboxes in the table
                            var $checkboxes = $('#example tbody input[type="checkbox"]');
                            console.log('Number of checked checkboxes:', $checkboxes.filter(':checked').length);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed!');
                        console.log('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Incorrect format!',
                            text: 'Please insert the correct file format',
                        });
                    }
                });
            }
        });
    });

    $('#btnPaycheck').click(function() {
        // Updated: Get selected checkboxes across all pages with "Nama Lengkap"
        var selectedRows = table.rows().nodes().to$().find('input[type="checkbox"]:checked').map(function() {
            const rowData = table.row($(this).closest('tr')).data();
            return {
                EmployeeId: rowData.EmployeeId,
                name: rowData['Nama Lengkap']
            }; // Handle "Nama Lengkap" with space
        }).get();

        console.log('Selected Rows:', selectedRows);

        if (selectedRows.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Users Selected',
                text: 'Please select at least one user to proceed.',
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to generate the PDF and display it inline for the filtered data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate and display!',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                let completedUsers = 0;

                Swal.fire({
                    title: 'Processing...',
                    html: `
                <div style="width: 100%; background: #eee; height: 10px; position: relative; margin-top: 10px;">
                    <div id="swal-progress" style="background: #28a745; width: 0%; height: 100%;"></div>
                </div>
                <p id="swal-progress-text" style="margin-top: 10px;">Please wait...</p>
                <ul id="swal-user-status" style="text-align: left; padding: 10px; max-height: 150px; overflow-y: auto; border: 1px solid #ccc; list-style: none;">
                </ul>
            `,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        const updateProgress = () => {
                            const progressPercent = Math.round((completedUsers / selectedRows.length) * 100);
                            $('#swal-progress').css('width', `${progressPercent}%`);
                            $('#swal-progress-text').text(`Progress: ${progressPercent}%`);
                        };

                        const updateUserStatus = (username, status, success = true) => {
                            const color = success ? 'green' : 'red';
                            $('#swal-user-status').append(
                                `<li style="color: ${color};">${username} - ${status}</li>`
                            );
                        };

                        const processRow = (row, index) => {
                            updateUserStatus(`${row.name} (${row.employeeId})`, 'Compiling...');
                            setTimeout(() => {
                                // Simulate server response (replace with actual AJAX logic)
                                const isSuccess = Math.random() > 0.2; // Simulate 80% success rate

                                if (isSuccess) {
                                    updateUserStatus(`${row.name} (${row.employeeId})`, 'Done', true);
                                } else {
                                    updateUserStatus(row[`${row.name} (${row.employeeId})`], 'Failed. Retrying...', false);
                                    processRow(row, index); // Retry failed row
                                }

                                completedUsers++;
                                updateProgress();

                                if (completedUsers === selectedRows.length) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Processing Completed',
                                        text: 'All selected users have been processed',
                                        allowOutsideClick: false,
                                    }).then(() => {
                                        // After "Processing Completed", show the loading spinner
                                        Swal.fire({
                                            title: 'Loading, please wait...',
                                            showConfirmButton: false,
                                            allowOutsideClick: false,
                                            showCloseButton: false,
                                            didOpen: () => {
                                                // Start the AJAX request after the spinner is shown
                                                var formData = new FormData();
                                                formData.append('formFile', $('#formFile')[0].files[0]);
                                                formData.append('filterPeriode', $('#filterPeriode').val());
                                                formData.append('filterPaycek', $('#filterPaycek').val());
                                                formData.append(
                                                    'selectedRows',
                                                    JSON.stringify(selectedRows.map(row => ({
                                                        EmployeeId: row.EmployeeId,
                                                        name: row.name
                                                    })))
                                                );
                                                $.ajax({
                                                    url: '/paycheck/output',
                                                    type: 'POST',
                                                    data: formData,
                                                    processData: false,
                                                    contentType: false,
                                                    success: function(response) {
                                                        Swal.close();
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Paycheck Sent!',
                                                            text: 'The paycheck has been sent to your employee.',
                                                            allowOutsideClick: false,
                                                            confirmButtonText: 'OK'
                                                        });
                                                    },
                                                    error: function(xhr, status, error) {
                                                        Swal.close();
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Error!',
                                                            text: 'Failed to generate the PDF. Please try again.',
                                                        });
                                                        console.error('AJAX request failed:', error);
                                                    }
                                                });
                                            }
                                        });
                                    });
                                }
                            }, 1000 * (index + 1)); // Simulate staggered delay
                        };

                        selectedRows.forEach(processRow);
                    }
                });
            }
        });
    });



    $('#btnCheckpdf').click(function() {
        // Updated: Get selected checkboxes across all pages
        var selectedRows = table.rows().nodes().to$().find('input[type="checkbox"]:checked').map(function() {
            return table.row($(this).closest('tr')).data().EmployeeId; // Adjust to match backend field
        }).get();

        console.log('Selected Rows:', selectedRows);
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to generate the PDF and display it inline for the filtered data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate and display!',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Generating PDF...',
                    text: 'Please wait while the PDF is being generated.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });

                var formData = new FormData();
                formData.append('formFile', $('#formFile')[0].files[0]);
                formData.append('filterPeriode', $('#filterPeriode').val());
                formData.append('filterPaycek', $('#filterPaycek').val());
                formData.append('selectedRows', JSON.stringify(selectedRows));
                console.log(formData);
                $.ajax({
                    url: '/paycheck/checkpdf',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhrFields: {
                        responseType: 'blob' // Important to receive PDF as blob
                    },
                    success: function(response) {
                        Swal.close();

                        Swal.fire({
                            icon: 'success',
                            title: 'PDF Generated!',
                            text: 'Your PDF has been generated and will open in a new tab!',
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Create a blob URL for the PDF
                            var blob = new Blob([response], {
                                type: 'application/pdf'
                            });
                            var blobUrl = URL.createObjectURL(blob);

                            // Open the PDF in a new tab
                            window.open(blobUrl, '_blank');
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to generate the PDF. Please try again.',
                        });
                        console.error('AJAX request failed:', error);
                    }
                });
            }
        });
    });

    // Format Rupiah
    function formatRupiah(value) {
        // Ensure value is converted to a float for decimal handling
        return 'Rp' + parseFloat(value).toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2 // Adjust to display up to 2 decimal places if needed
        });
    }
    //format tanggal sesuai dengan drop down periode
    function formatDateToMatchDropdown(date) {
        const options = {
            day: '2-digit',
            month: 'short',
            year: '2-digit'
        };
        return new Date(date).toLocaleDateString('en-GB', options).replace(/ /g, '-');
    }
    // Fungsi convert serial nomor ke tanggal pada excel
    function excelSerialToDate(serial) {
        var utc_days = Math.floor(serial - 25569);
        var utc_value = utc_days * 86400;
        var date_info = new Date(utc_value * 1000);

        var year = date_info.getUTCFullYear();
        var month = date_info.getUTCMonth() + 1;
        var day = date_info.getUTCDate();

        return year + "-" + (month < 10 ? "0" + month : month) + "-" + (day < 10 ? "0" + day : day);
    }
    // Combined function to handle button visibility based on both dropdowns
    function updateButtonVisibility() {
        var selectedYear = $('#filterYear').val(); // Get the selected Periode value
        var selectedPeriode = $('#filterPeriode').val(); // Get the selected Periode value
        var selectedPaycek = $('#filterPaycek').val(); // Get the selected Paycek value

        console.log('Selected Periode:', selectedPeriode);
        console.log('Selected Paycek:', selectedPaycek);

        // Logic to determine button visibility
        if (selectedPeriode === '') {
            // Hide buttons if no period is selected
            $('#btnPaycheck, #btnCheckpdf').hide();
        } else if (selectedPeriode != '') {
            // Show buttons if a period is selected
            $('#btnPaycheck, #btnCheckpdf').show();
            if (selectedPaycek === 'no') {
                $('#btnPaycheck, #btnCheckpdf').hide(); // Hide both if Paycek is 'no'
            }
        } else {
            // Period is selected, check Paycek filter
            if (selectedPaycek === 'no') {
                $('#btnPaycheck, #btnCheckpdf').hide(); // Hide both if Paycek is 'no'
            } else if (selectedPaycek === '') {
                $('#btnCheckpdf').hide(); // Show only btnCheckpdf if Paycek is blank
                $('#btnPaycheck').hide();
            } else {
                $('#btnPaycheck, #btnCheckpdf').show(); // Show both if Paycek is 'yes' or other valid selection
            }
        }
    }

    // Attach the combined function to both dropdown change events
    $('#filterYear').change(updateButtonVisibility);
    $('#filterPeriode').change(updateButtonVisibility);
    $('#filterPaycek').change(updateButtonVisibility);
</script>

<!-- Script Tool Tips -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>



<?= $this->endSection('scripts'); ?>