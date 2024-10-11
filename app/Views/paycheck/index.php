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
<form id="excelForm" enctype="multipart/form-data" action="<?= base_url('/output') ?>" method="POST">
    <h1>Ini paycek</h1>
    <div class="mb-3">
        <label for="formFile" id="formFilelbl" class="form-label"><?= lang('app.text-input-excel') ?></label>
        <input class="form-control" type="file" id="formFile" name="formFile">
    </div>
    <button type="button" id="btnModal" class="btn btn-warning"><?= lang('app.text-generate-file') ?></button>
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
            <table id="example" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Gaji Pokok</th>
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
                            // Memeriksa apakah setidaknya ada satu nilai dalam row yang tidak null
                            return row.some(function(cell) {
                                return cell !== null;
                            });
                        });
                        // console.log(filteredData); // Menampilkan hasil yang sudah difilter
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
                        console.log(convertedData);
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
                                        console.log(data); // Log the data to inspect its value
                                        return formatRupiah(data); // Ensure salary is displayed in currency format
                                    }
                                }
                            ]
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!!',
                            text: 'Record has been updated!',
                            allowOutsideClick: false,
                        })

                        $('#btnModal').text('<?= lang('app.text-insert-new-file') ?>');
                        $('#formFilelbl').hide();
                        $('#fileNameDisplay').text(` - ${fileName}`);

                        $('#formFile').hide();
                        $('#dataTable').show();
                        $('#btnPaycheck').show();
                        $('#btnEmail').show();
                        $('#btnTesting').show();
                        $('#btnSendtoEmail').show();
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