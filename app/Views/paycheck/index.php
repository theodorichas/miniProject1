<?= $this->extend('template/index'); ?>


<?= $this->section('links'); ?>
<title><?= $title ?></title>
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
    <h1>Package Paycheck Function</h1>
    <div class="mb-3">
        <label for="formFile" id="formFilelbl" class="form-label"><?= lang('app.text-input-excel') ?></label>
        <input class="form-control" type="file" id="formFile" name="formFile">
    </div>
    <button type="button" id="btnModal" class="btn btn-warning"><?= lang('app.text-generate-file') ?></button>
    <button type="submit" id="btnPaycheck" class="btn btn-success" style="display: none;"><?= lang('app.text-send-email') ?></button>
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
            <div class="form-group">
                <label for="filterPeriode">Select Period</label>
                <select name="filterPeriode" id="filterPeriode" class="form-control">
                    <option value="">All</option>
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
            </div>
            <div class="form-group">
                <label for="filterPaycek">Eligible</label>
                <select name="filterPaycek" id="filterPaycek" class="form-control">
                    <option value="">All</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <table id="example" class="table table-bordered table-hover">
                <thead>
                    <tr>
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
            if ($('#btnModal').text() === '<?= lang('app.text-insert-new-file') ?>') {
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
                    success: function(response) {
                        var responseData = JSON.parse(response); // Parsing response dari JSON
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
                        console.log(responseData.data);

                        $('#example').DataTable({
                            responsive: true,
                            lengthChange: false,
                            autoWidth: false,
                            data: convertedData, // This should contain the full data but we'll only show specific columns
                            destroy: true,
                            columns: [{
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

                        // Event listener for periode dropdown
                        $('#filterPeriode').on('change', function() {
                            var selectedMonth = $(this).val();

                            // Filter the DataTable by month
                            var table = $('#example').DataTable();

                            // If no month is selected, reset the filter
                            if (selectedMonth === "") {
                                table.column(1).search('').draw(); // Reset filter
                            } else {
                                // Use a regular expression to match the month in "YYYY-MM-DD" format
                                var regex = '^\\d{4}-' + selectedMonth + '-\\d{2}$'; // Match "2024-01-31" format
                                table.column(1).search(regex, true, false).draw(); // Apply the filter
                            }
                        });

                        // Event listener for eligible dropdown
                        $('#filterPaycek').on('change', function() {
                            var selectedOption = $(this).val();

                            // Filter the DataTable by month
                            var table = $('#example').DataTable();

                            // If no month is selected, reset the filter
                            if (selectedOption === "") {
                                table.column(6).search('').draw(); // Reset filter
                            } else {
                                // Use a regular expression to match the month in "YYYY-MM-DD" format
                                table.column(6).search('^' + selectedOption + '$', true, false).draw(); // Apply the filter
                            }
                        });

                        $('#btnModal').text('<?= lang('app.text-insert-new-file') ?>');
                        $('#formFilelbl').hide();
                        $('#fileNameDisplay').text(` - ${fileName}`);
                        $('#btnPaycheck').show();

                        $('#formFile').hide();
                        $('#dataTable').show();
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

    // Format Rupiah
    function formatRupiah(value) {
        // Ensure value is converted to a float for decimal handling
        return 'Rp' + parseFloat(value).toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2 // Adjust to display up to 2 decimal places if needed
        });
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
</script>


<?= $this->endSection('scripts'); ?>