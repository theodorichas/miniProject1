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
                <h3 class="card-title">DataTable Group Permission</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Group_id</th>
                            <th scope="col">View</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            <th scope="col">menu_name</th>
                            <th scope="col">file_name</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>




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
            'serverMethod': 'get',
            'ajax': "<?= site_url('gpermidtb') ?>",
            'columns': [{
                'data': 'group_id',
            }, {
                'data': 'view',
                'render': function(data, type, row, meta) {
                    return '<input type="checkbox" class="view-checkbox" value="' + row.group_id + '" ' + (data == 1 ? 'checked' : '') + '>';
                }
            }, {
                'data': 'edit',
                'render': function(data, type, row, meta) {
                    return '<input type="checkbox" class="view-checkbox" value="' + row.group_id + '" ' + (data == 1 ? 'checked' : '') + '>';
                }
            }, {
                'data': 'delete',
                'render': function(data, type, row, meta) {
                    return '<input type="checkbox" class="view-checkbox" value="' + row.group_id + '" ' + (data == 1 ? 'checked' : '') + '>';
                }
            }, {
                'data': 'menu_name'
            }, {
                'data': 'file_name'
            }]
        })
    })
</script>




<!-- Jquery -->
<!-- <script>
    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                permi_name: {
                    required: true,
                },
                permi_desc: {
                    required: true,
                },
            },
            messages: {
                permi_name: {
                    required: "'this field' cannot be empty",
                },
                permi_desc: {
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
            $('#mTitle').text('Add Permission');
            $('#btnModal').text('Add');
            $('#id').val('0');
        })
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
            }
            $.ajax({
                method: 'POST',
                type: 'JSON',
                url: '<?= base_url("permission/updateAdd") ?>',
                data: formData,
                success: function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data added unsuccessful',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data added successfuly',
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

    function UpdateRecord(permi_id, permi_name, permi_desc) {
        $('#mTitle').text('Edit Permission');
        $('#btnModal').text('Update');
        // Populate the modal fields with the existing data
        $("#permi_id").val(permi_id);
        // console.log("Id yang didapat dari tombol update: ", permi_id);
        $('#permi_name').val(permi_name);
        $('#permi_desc').val(permi_desc);
    }

    function deleteRecord(permi_id) {
        if (confirm('Are you sure you want to delete this record?')) {
            // AJAX request to your delete endpoint
            $.ajax({
                url: '<?= site_url('permission/delete') ?>',
                method: 'POST',
                type: 'JSON',
                data: {
                    'permi_id': permi_id
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
</script> -->

<?= $this->endSection('content'); ?>
<?= $this->endSection('scripts'); ?>