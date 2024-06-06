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
                <h3 class="card-title">DataTable Group</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Button trigger modal -->
                <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?= lang('app.button-add-group') ?>
                </a>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= lang('app.text-group-code') ?></th>
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

<!-- Modal add dan edit Group (Modal dari Bootstrap)-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-addK">
                <form name="formGroup" id="quickForm">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="groupId" id="id" value="">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="groupcode" class="form-label"><?= lang('app.text-group-code') ?></label>
                            <input type="number" name="groupCode" id="inputGroupcode" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="groupname" class="form-label"><?= lang('app.text-group-name') ?></label>
                            <input type="text" name="groupName" id="inputGroupname" class="form-control">

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
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'processing': true,
            'serverSide': false,
            'serverMethod': 'post',
            "ajax": "<?= site_url('groupdtb') ?>",
            "columns": [{
                "data": "group_code"
            }, {
                "data": "group_name"
            }, {
                "data": null,
                "render": function(data, type, full, meta) {
                    return '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.group_id + ', \'' + full.group_code + '\', \'' + full.group_name + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= lang('app.button-update') ?></button>' +
                        '<button class="btn btn-danger action-btn"onclick="deleteRecord(' + full.group_id + ')"><?= lang('app.button-delete') ?></button>' +
                        '<button class="btn btn-info action-btn"onclick="gPermission(' + full.group_id + ')">Permissions</button>';

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
                groupCode: {
                    required: true,
                    min: 1,
                },
                groupName: {
                    required: true,
                },
            },
            messages: {
                groupCode: {
                    required: "'this field' cannot be empty",
                    min: "Please enter a value greater than zero."
                },
                groupName: {
                    required: "'this field' cannot be empty",
                },
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
            $('#mTitle').text('<?= lang('app.button-add-group') ?>');
            $('#btnModal').text('<?= lang('app.button-add-modal') ?>');
            $('#id').val('0');
        })
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
            }
            $.ajax({
                method: 'POST',
                type: 'JSON',
                url: '<?= base_url("group/updateAdd") ?>',
                data: formData,
                success: function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: '<?= lang('app.text-swal-title-error') ?>',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: '<?= lang('app.text-swal-title-success') ?>',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        $('#example').DataTable().ajax.reload();
                        $('#exampleModal').modal('hide');
                    }
                }
            });
        })
    })

    function UpdateRecord(id, group_code, group_name) {
        $('#mTitle').text('<?= lang('app.text-title-modal-group-update') ?>');
        $('#btnModal').text('<?= lang('app.button-update') ?>');
        // Populate the modal fields with the existing data
        $("#id").val(id);
        console.log("Id yang didapat dari tombol update: ", id);
        $('#inputGroupcode').val(group_code);
        $('#inputGroupname').val(group_name);
    }

    function deleteRecord(id) {
        Swal.fire({
            title: "<?= lang('app.text-swal-title-delete') ?>,",
            text: "<?= lang('app.text-swal-warning-delete') ?>,",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "<?= lang('app.button-no') ?>",
            confirmButtonText: "<?= lang('app.text-swal-confirm-delete') ?>",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('group/delete') ?>',
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        'groupId': id
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '<?= lang('app.text-swal-deleted-title') ?>',
                                text: '<?= lang('app.text-swal-deleted-text-group') ?>',
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
    }

    function gPermission(group_id) {
        console.log('Group ID:', group_id); // Log the group_id value
        window.location.href = '<?= base_url('/gPermission') ?>?id=' + group_id;
    }
</script>


<?= $this->endSection('scripts'); ?>


<?= $this->endSection('content'); ?>