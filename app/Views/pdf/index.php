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
    <div class="mb-3">
        <label for="formFile" id="formFilelbl" class="form-label"><?= lang('app.text-input-excel') ?></label>
        <input class="form-control" type="file" id="formFile" name="formFile">
    </div>
    <button type="button" id="btnModal" class="btn btn-warning"><?= lang('app.text-generate-file') ?></button>
    <button type="button" id="btnEmail" class="btn btn-info" style="display: none;">Send Paycheck</button>
    <!-- <button type="button" id="btnAttach" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Send Attachments</button> -->
    <button type="button" id="btnTesting" class="btn btn-danger" data-toggle="modal" style="display: none;" data-target="#exampleModal">Send Files</button>
    <!-- <button type="submit" id="btnPaycheck" class="btn btn-success" style="display: none;"><?= lang('app.text-send-email') ?></button> -->
    <!-- <button type="button" id="btnSendtoEmail" class="btn btn-secondary" data-toggle="modal" style="display: none;" data-target="#exampleModal2">Send to email</button> -->

</form>

<!-- Modal untuk attachments-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Attachments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="excelForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="template_name" class="form-label">Select which template you want to choose</label>
                        <select name="template_name" id="template_name" class="form-select">
                            <option value="">Select Template</option>
                            <?php foreach ($templates as $template) : ?>
                                <option value="<?= $template['template_id'] ?>"><?= $template['template_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="template_preview" class="form-label">Template Preview</label>
                            <div id="template_preview" class="border p-2" style="min-height: 200px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formAttach" id="formAttachlbl" class="form-label">Select which file you want to send</label>
                            <input class="form-control" type="file" id="formAttach" name="formAttach">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSendFileTesting" class="btn btn-primary">Send file</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk sent to email-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Testing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Testing</h1>
                <form name="excelForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="template_name" class="form-label">Select which template you want to choose</label>
                        <select name="template_name" id="template_name" class="form-select">
                            <option value="">Select Template</option>
                            <?php foreach ($templates as $template) : ?>
                                <option value="<?= $template['template_id'] ?>"><?= $template['template_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formAttach" id="formAttachlbl" class="form-label">Select which file you want to send</label>
                            <input class="form-control" type="file" id="formAttach" name="formAttach">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSendFileToEmail" class="btn btn-primary">Send file</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
                        <th scope="col">Nama</th>
                        <th scope="col">Nip</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">email</th>
                        <th scope="col">No telp[Whatsapp]</th>
                        <th scope="col">Salary</th>
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
        $('#example').DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });
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
                        window.location.href = '<?= base_url('/pdf') ?>';
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
                    url: '<?= base_url('/read') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        var filteredData = responseData.filter(function(row) {
                            return row.some(function(cell) {
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
                                if (columns[i] === 'tgl_lahir') {
                                    row[i] = excelSerialToDate(row[i]);
                                    if (row[i] === 'Invalid Date') {
                                        row[i] = null;
                                    }
                                }
                                rowData[columns[i]] = row[i];
                            }
                            return rowData;
                        });
                        $('#example').DataTable({
                            responsive: true,
                            lengthChange: false,
                            autoWidth: false,
                            data: convertedData,
                            destroy: true,
                            columns: columns.map(function(column) {
                                if (column === 'salary') {
                                    return {
                                        data: column,
                                        render: function(data, type, row) {
                                            return formatRupiah(data);
                                        }
                                    };
                                }
                                return {
                                    data: column
                                };
                            })
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!!',
                            text: 'Record has been Updated',
                        });

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
        $('#btnEmail').click(function() {
            var formData = new FormData();
            formData.append('formFile', $('#formFile')[0].files[0]);
            Swal.fire({
                title: 'Processing...',
                html: '<div class="loading-spinner"></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '<?= base_url('/send-email') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // The response is already a JavaScript object, so no need to parse it
                    console.log('Raw Response:', response);

                    if (response.error) {
                        console.error('Error:', response.error);
                        alert(response.error);
                        return;
                    }

                    var filteredData = response.results.filter(function(row) {
                        return Object.values(row).some(function(cell) {
                            return cell !== null && cell !== '';
                        });
                    });

                    if (filteredData.length === 0) {
                        console.log('All rows contain null values');
                        return;
                    }

                    // Display the extracted information
                    console.log('Filtered Data:', filteredData);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!!',
                        text: "Paycheck has been sent to employee's email address!!",
                    });
                    alert('Emails processed successfully. Check the console for details.');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        $('#btnSendFile').click(function() {
            var fileInput = document.getElementById('formAttach');
            var emailInput = document.getElementById('email').value;
            var formData = new FormData();
            formData.append('formAttach', fileInput.files[0]);
            formData.append('email', emailInput);
            $.ajax({
                url: '<?= base_url('/sendAttach') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Raw Response:', response);
                    Swal.fire({
                        title: 'Success',
                        text: 'The file has been sent successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Add error handling here
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error sending the file.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
        });
        $('#btnSendFileTesting').click(function() {
            var fileInput = document.getElementById('formAttach');
            var templateName = $('#template_name').val(); // Get the selected template name
            var formData = new FormData();
            formData.append('formFile', $('#formFile')[0].files[0]);
            formData.append('template_name', templateName);
            formData.append('formAttach', fileInput.files[0]);
            Swal.fire({
                title: 'Processing...',
                html: '<div class="loading-spinner"></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                url: '<?= base_url('/sendAttachTesting') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Raw Response:', response);
                    Swal.fire({
                        title: 'Success',
                        text: 'The file has been sent successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Add error handling here
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error sending the file.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })

        });
    });

    // Format Rupiah
    function formatRupiah(value) {
        return 'Rp' + parseInt(value, 10).toLocaleString('id-ID', {
            minimumFractionDigits: 0
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

<!-- Script untuk preview template -->
<script>
    document.getElementById('template_name').addEventListener('change', function() {
        var templateId = this.value;
        console.log('Template ID:', templateId);
        if (templateId) {
            fetchTemplate(templateId);
        } else {
            document.getElementById('template_preview').innerHTML = '';
        }
    });

    function fetchTemplate(templateId) {
        $.ajax({
            url: '<?= base_url('/getTemplateBody') ?>',
            type: 'POST',
            dataType: 'json', // Ensure the server returns JSON
            data: {
                template_id: templateId
            },
            success: function(response) {
                console.log('Raw Response:', response);
                if (response.template_body) {
                    document.getElementById('template_preview').innerHTML = response.template_body;
                } else {
                    document.getElementById('template_preview').innerHTML = 'No template found.';
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error fetching the template.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
</script>


<?= $this->endSection('scripts'); ?>