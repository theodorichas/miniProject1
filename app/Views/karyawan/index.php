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

<h1><?= $group_names ?></h1>
<!-- Main Content -->
<?= $this->section('content'); ?>


<!-- Data Table -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable Karyawan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Button trigger modal -->
                <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Karyawan
                </a>
                <a button type="button" id="btnImport" class="btn btn-info swalDefaultInfo" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Import Data
                </a>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Telp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Group Name</th>
                            <th scope="col">Action</th>
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
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="inputNama" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="telp" class="form-label">Telp</label>
                            <input type="number" name="telp" id="inputTelp" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" id="inputAlamat" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="inputEmail" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="inputPassword" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="groupName" class="form-label">Group</label>
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
        $('#example').DataTable({
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
                "data": "action",
                "render": function(data, type, full, meta) {
                    return '<button class="btn btn-primary" onclick="UpdateRecord(' + full.user_id + ', \'' + full.nama + '\', \'' + full.telp + '\', \'' + full.alamat + '\', \'' + full.email + '\', \'' + full.password + '\', \'' + full.group_name + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>' +
                        '<button class="btn btn-danger"onclick="deleteRecord(' + full.user_id + ')">Delete</button>';
                }
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
                    required: "'nama' cannot be empty"
                },
                telp: {
                    required: "'telp' cannot be empty",
                    minlength: "Please enter a correct Phone Number"
                },
                alamat: {
                    required: "'alamat' cannot be empty",
                },

                email: {
                    required: "'email' cannot be empty",
                    email: "Please enter a valid email address"
                },

                password: {
                    required: "'password' cannot be empty",
                    minlength: "password must contain at least 8 Characters!!",
                },
                groupName: {
                    required: "Please select one of the options !!",
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
            $('#mTitle').text('Add Karyawan');
            $('#btnModal').text('Add');
            $('#id').val('0');
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
        $('#mTitle').text('Edit Karyawan');
        $('#btnModal').text('Update');
        // Populate the modal fields with the existing data
        $("#id").val(id);
        console.log("Id yang didapat dari tombol update: ", id);
        $('#inputNama').val(nama);
        $('#inputTelp').val(telp);
        $('#inputAlamat').val(alamat);
        $('#inputEmail').val(email);
        $('#inputPassword').val(password);
        $('#inputGroupname').val(group_name);
    }

    function deleteRecord(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            // AJAX request to your delete endpoint
            console.log("Id yang didapat dari tombol update: ", id);
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
                        // Reload the DataTable or update the row accordingly
                        alert('Failed to delete data.');
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#example').DataTable().ajax.reload();
                    }
                }
            });
        }
    }
</script>


<?= $this->endSection('scripts'); ?>


<?= $this->endSection('content'); ?>