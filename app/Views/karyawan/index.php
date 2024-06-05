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

<!-- Data Table -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= lang('app.card-title-user') ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Tombol Add Users -->
                <div class="btn-addKarywan">
                    <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?= lang('app.button-add-user') ?>
                    </a>
                </div>
                <!-- Tombol Import Data -->
                <!-- <a button type="button" id="btnImport" class="btn btn-info swalDefaultInfo" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Import Datas
                </a> -->
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= lang('app.text-name') ?></th>
                            <th scope="col"><?= lang('app.text-phone') ?></th>
                            <th scope="col"><?= lang('app.text-address') ?></th>
                            <th scope="col"><?= lang('app.text-email') ?></th>
                            <th scope="col"><?= lang('app.text-group-name') ?></th>
                            <th scope="col"><?= lang('app.text-action') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Modal add dan edit Karyawan (Modal dari Bootstrap)-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-addK">
                <form name="formKaryawan" id="quickForm">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="userId" id="id" value="">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="nama" class="form-label"><?= lang('app.text-name') ?></label>
                            <input type="text" name="nama" id="inputNama" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="telp" class="form-label"><?= lang('app.text-phone') ?></label>
                            <input type="text" name="telp" id="inputTelp" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="alamat" class="form-label"><?= lang('app.text-address') ?></label>
                            <input type="text" name="alamat" id="inputAlamat" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="email" class="form-label"><?= lang('app.text-email') ?></label>
                            <input type="email" name="email" id="inputEmail" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="mb-3">
                            <input type="password" name="password" id="inputPassword" class="form-control">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword" style="display: none;">
                                <span class="fas fa-eye"></span>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="groupName" class="form-label"><?= lang('app.text-group-name') ?></label>
                            <select name="groupName" id="inputGroupname" class="form-select">
                                <option value="">Select Group</option>
                                <?php foreach ($group_names as $group_name) : ?>
                                    <option value="<?= $group_name ?>"><?= $group_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="btnModal" name="update" class="btn btn-primary"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<!-- Merupakan extensi dari scripts yang ada pada view template -->
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
<!-- Script untuk menampilkan DataTable Server Side menggunakan AJAX -->
<script>
    $(document).ready(function() {
        // Pass PHP permissions to JavaScript
        var menuId = <?= $menuId->menu_id ?>;
        var permissions = <?= json_encode($permission) ?>;
        var karyawanPermissions = permissions.find(p => p.menu_id == menuId);
        $('#example').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'processing': true,
            'serverSide': false,
            'serverMethod': 'post',
            "ajax": "<?= site_url('ajax') ?>",
            "columns": [{
                "data": "nama"
            }, {
                "data": "telp"
            }, {
                "data": "alamat"
            }, {
                "data": "email"
            }, {
                "data": "group_name"
            }, {
                "data": null,
                "render": function(data, type, full, meta) {
                    var statusText = full.is_verified == 1 ? '<?= lang('app.button-status-de-active') ?>' : '<?= lang('app.button-status-active') ?>';
                    var buttons = '';
                    // Conditionally render Update button based on edit permission
                    if (karyawanPermissions.edit == 1) {
                        buttons += '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.user_id + ', \'' + full.nama + '\', \'' + full.telp + '\', \'' + full.alamat + '\', \'' + full.email + '\', \'' + full.password + '\', \'' + full.group_name + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= lang('app.button-update') ?></button>';
                    }

                    // Conditionally render Delete button based on delete permission
                    if (karyawanPermissions.delete == 1) {
                        buttons += '<button class="btn btn-danger action-btn" onclick="deleteRecord(' + full.user_id + ')"><?= lang('app.button-delete') ?></button>';
                    }

                    // Render status button always
                    buttons += '<button class="btn btn-info action-btn" onclick="statusRecord(' + full.user_id + ', ' + full.is_verified + ')">' + statusText + '</button>';

                    return buttons;
                },
                "defaultContent": ""
            }],
            'order': [0, 'asc'],
        });
    });
</script>
<!-- Jquery -->
<script>
    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                nama: {
                    required: true,
                },
                telp: {
                    required: true,
                    minlength: 10
                },
                alamat: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                groupName: {
                    required: true,
                }
            },
            messages: {
                nama: {
                    required: "<?= lang('app.text-required-name') ?>"
                },
                telp: {
                    required: "<?= lang('app.text-required-phone') ?>",
                    minlength: "<?= lang('app.text-required-phone-minlen') ?>"
                },
                alamat: {
                    required: "<?= lang('app.text-required-address') ?>",
                },

                email: {
                    required: "<?= lang('app.text-required-email') ?>",
                    email: "<?= lang('app.text-required-email-min') ?>"
                },

                password: {
                    required: "<?= lang('app.text-required-password') ?>",
                    minlength: "<?= lang('app.text-required-password-min') ?>",
                },
                groupName: {
                    required: "<?= lang('app.text-required-group-name') ?>",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#quickForm').trigger('reset');
            $('#quickForm :input').removeClass('is-invalid');
            $('#quickForm').removeClass('error invalid-feedback');
        });
        $('#btnAdd').click(function() {
            $('#mTitle').text('<?= lang('app.text-title-user-modal') ?>');
            $('#btnModal').text('<?= lang('app.button-add-modal') ?>');
            $('#id').val('0');
            $('#togglePassword').show();
            togglePassword();
        })
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
                console.log(formData);
            }
            $.ajax({
                method: 'POST',
                type: 'JSON',
                url: '<?= base_url("/karyawan/updateAdd") ?>',
                data: formData,
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data added successfuly',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        $('#example').DataTable().ajax.reload();
                        $('#exampleModal').modal('hide');
                    } else if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'User with this email already exists, Please insert a new Email',
                            text: response.message,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data added unsuccessfully',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                }
            });
        })
    })

    function UpdateRecord(id, nama, telp, alamat, email, password, group_name) {
        $('#mTitle').text('<?= lang('app.text-title-update-modal') ?>');
        $('#btnModal').text('<?= lang('app.button-update-modal') ?>');
        // Populate the modal fields with the existing data
        $("#id").val(id);
        console.log("Id yang didapat dari tombol update: ", id);
        $('#inputNama').val(nama);
        $('#inputTelp').val(telp);
        $('#inputAlamat').val(alamat);
        $('#inputEmail').val(email);
        $('#inputPassword').val(password);
        $('#inputPassword').attr('type', 'password'); // Reset password field type to 'password'
        $('#inputGroupname').val(group_name);
        $('#togglePassword').hide(); // Hide the toggle button when updating
    }

    function deleteRecord(id) {
        Swal.fire({
            title: "<?= lang('app.text-swal-title') ?>,",
            text: "<?= lang('app.text-swal-content') ?>,",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?= lang('app.text-swal-confirm') ?>,"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('karyawan/delete') ?>',
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        'userId': id
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: 'User has been successfully deleted',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Reload the DataTable or update the row accordingly
                            $('#example').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unexpected Error!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed!');
                        console.log('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request. Please try again later.',
                        });
                    }
                });
            }
        });
        console.log("Id yang didapat dari tombol update: ", id);
    }

    function statusRecord(id, isVerified) {
        Swal.fire({
            title: "Are you sure you want to update the 'Status' of this user?",
            icon: 'info',
            showDenyButton: true,
            confirmButtonText: "yes",
            denyButtonText: `No`,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('karyawan/status') ?>',
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        'userId': id
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Success',
                                text: 'User status updated',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Reload the DataTable or update the row accordingly
                            $('#example').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unexpected Error!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed!');
                        console.log('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request. Please try again later.',
                        });
                    }
                });
            }
        })
    }

    // Function Toggle password
    function togglePassword() {
        // Ensure the togglePassword click event is only attached once
        $('#togglePassword').off('click').on('click', function() {
            // Get the password input field
            var passwordField = $('#inputPassword');
            var passwordFieldType = passwordField.attr('type');

            // Toggle the password field type
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).html('<span class="fas fa-eye-slash"></span>'); // Change icon to eye-slash
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<span class="fas fa-eye"></span>'); // Change icon to eye
            }
        });
    }
</script>

<?= $this->endSection('scripts'); ?>