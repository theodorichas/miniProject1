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


<?= $this->endSection('links') ?>

<!-- Main Content -->
<?= $this->section('content'); ?>
<!-- Data Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= getTranslation('card-title-menu') ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Button trigger modal -->
                <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?= getTranslation('button-add-menu') ?>
                </a>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= getTranslation('text-menu') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-page') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-file') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-parent') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-icon') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-note') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-order') ?></th>
                            <th scope="col"><?= getTranslation('text-menu-visible') ?></th>
                            <th scope="col"><?= getTranslation('text-action') ?></th>
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
                <form name="formMenu" id="quickForm">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="menu_id" id="menu_id" value="">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="menu_name" class="form-label"><?= getTranslation('text-menu') ?></label>
                            <input type="text" name="menu_name" id="menu_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="page_name" class="form-label"><?= getTranslation('text-menu-page') ?></label>
                            <input type="text" name="page_name" id="page_name" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="file_name" class="form-label"><?= getTranslation('text-menu-file') ?></label>
                            <input type="text" name="file_name" id="file_name" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="parent_menu" class="form-label"><?= getTranslation('text-menu-parent') ?></label>
                            <input type="text" name="parent_menu" id="parent_menu" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="icon" class="form-label"><?= getTranslation('text-menu-icon') ?></label>
                            <select class="form-select" name="icon" id="icon">
                                <option value="">Select an Icon</option>
                                <?php foreach ($icons as $icon) : ?>
                                    <option value="<?= $icon ?>">
                                        <i class="<?= $icon ?>"></i> <?= $icon ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="selectedIconContainer"></div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="note" class="form-label"><?= getTranslation('text-menu-note') ?></label>
                            <input type="text" name="note" id="note" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="order_no" class="form-label"><?= getTranslation('text-menu-order') ?></label>
                            <input type="number" name="order_no" id="order_no" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="visible" class="form-label"><?= gettranslation('text-menu-visible') ?></label>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="visible"></label>
                                <input type="checkbox" class="form-check-input" name="visible" id="visible">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btnModal" name="update" class="btn btn-primary"></button>
                </form>
            </div>
        </div>
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
        // Pass PHP permissions to JavaScript
        var menuId = <?= $menuId ?>;
        var permissions = <?= json_encode($permission) ?>;
        var karyawanPermissions = permissions.find(p => p.menu_id == menuId); // Assuming menu_id for karyawan page is 1

        $('#example').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'processing': true,
            'serverSide': false,
            'serverMethod': 'post',
            "ajax": "<?= site_url('menudtb') ?>",
            "columns": [{
                    "data": "menu_name"
                },
                {
                    "data": "page_name"
                },
                {
                    "data": "file_name"
                },
                {
                    "data": "parent_menu"
                },
                {
                    "data": "icon"
                },
                {
                    "data": "note"
                },
                {
                    "data": "order_no"
                },
                {
                    "data": "visible"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        var buttons = '';

                        // Conditionally render Update button based on edit permission
                        if (karyawanPermissions.edit == 1) {
                            buttons += buttons += '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.menu_id + ', \'' + full.menu_name + '\', \'' + full.page_name + '\', \'' + full.file_name + '\', \'' + full.parent_menu + '\', \'' + full.icon + '\', \'' + full.note + '\', \'' + full.order_no + '\', \'' + full.visible + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= getTranslation('button-update') ?></button>';
                        }

                        // Conditionally render Delete button based on delete permission
                        if (karyawanPermissions.delete == 1) {
                            buttons += '<button class="btn btn-danger action-btn"onclick="deleteRecord(' + full.menu_id + ')"><?= getTranslation('button-delete') ?></button>';
                        }

                        return buttons;
                    },
                    "defaultContent": ""
                }
            ],
            'order': [6, 'asc'],
        });
    });
</script>

<!-- Jquery -->
<script>
    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                menu_name: {
                    required: true,
                },
                page_name: {
                    required: true,
                },
                file_name: {
                    required: true
                },
                parent_menu: {
                    required: true,
                },
                icon: {
                    required: true,
                },
                note: {
                    required: true,
                },
                order_no: {
                    required: true,
                }
            },
            messages: {
                menu_name: {
                    required: "<?= getTranslation('text-required-menu-name') ?>"
                },
                page_name: {
                    required: "<?= getTranslation('text-required-menu-page') ?>",
                },
                file_name: {
                    required: "<?= getTranslation('text-required-menu-file') ?>",
                },
                parent_menu: {
                    required: "<?= getTranslation('text-required-menu-parent') ?>",
                },
                icon: {
                    required: "<?= getTranslation('text-required-menu-icon') ?>",
                },
                note: {
                    required: "<?= getTranslation('text-required-menu-note') ?>",
                },
                order_no: {
                    required: "<?= getTranslation('text-required-menu-order') ?>",
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
            $('#mTitle').text('<?= getTranslation('button-add-menu') ?>');
            $('#btnModal').text('<?= getTranslation('button-add-modal') ?>');
            $('#id').val('0');
        })
        // Add Parent
        $('#btnAddParent').click(function() {
            $('#mTitle').text('<?= lang('app.button-add-parent-menu') ?>');
            $('#btnModal').text('<?= lang('app.button-add-modal') ?>');
            $('#id').val('0');
        })
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serializeArray();
                var visibilityState = $('#visible').is(':checked') ? '1' : '0';
                formData.push({
                    name: 'visible',
                    value: visibilityState
                });
                // console.log(formData);
            }
            $.ajax({
                method: 'POST',
                type: 'JSON',
                url: '<?= base_url("/menu/updateAdd") ?>',
                data: formData,
                success: function(response) {
                    console.log(response)
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'error',
                            title: '<?= getTranslation('text-swal-title-error') ?>',
                            showConfirmButton: false,
                            timer: 1500,
                        });

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: '<?= getTranslation('text-swal-title-success') ?>',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        $('#example').DataTable().ajax.reload();
                        $('#exampleModal').modal('hide');
                        $('#visible').prop('checked', false);
                        $('#visible').val('0');
                        location.reload();
                    }
                }
            });
        })
    })

    function UpdateRecord(menu_id, menu_name, page_name, file_name, parent_menu, icon, note, order_no, visible) {
        $('#mTitle').text('<?= getTranslation('title-update-menu-modal') ?>');
        $('#btnModal').text('<?= getTranslation('button-update-modal') ?>');
        // Populate the modal fields with the existing data
        $("#menu_id").val(menu_id);
        console.log("Id yang didapat dari tombol update: ", menu_id);
        $('#menu_name').val(menu_name);
        $('#page_name').val(page_name);
        $('#file_name').val(file_name);
        $('#parent_menu').val(parent_menu);
        $('#icon').val(icon);
        $('#note').val(note);
        $('#order_no').val(order_no);
        if (visible == '1') {
            $('#visible').prop('checked', true);
        } else {
            $('#visible').prop('checked', false);
        }
    }

    function deleteRecord(menu_id) {
        Swal.fire({
            title: "<?= getTranslation('text-swal-deleted-title') ?>",
            text: "<?= getTranslation('text-swal-warning-delete') ?>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "<?= getTranslation('text-swal-confirm-delete') ?>"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('menu/delete') ?>',
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        'menu_id': menu_id
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '<?= getTranslation('text-swal-deleted-title') ?>',
                                text: '<?= getTranslation('text-swal-menu-text-delete') ?>',
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
        // if (confirm('Are you sure you want to delete this record?')) {
        //     // AJAX request to your delete endpoint
        //     console.log("Id yang didapat dari tombol update: ", menu_id);
        //     $.ajax({
        //         url: '<?= site_url('menu/delete') ?>',
        //         method: 'POST',
        //         type: 'JSON',
        //         data: {
        //             'menu_id': menu_id
        //         },
        //         success: function(response) {
        //             console.log(response)
        //             if (response.success) {
        //                 // Reload the DataTable or update the row accordingly
        //                 alert('Failed to delete data.');
        //             } else {
        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: 'Data deleted successfully!',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //                 $('#example').DataTable().ajax.reload();
        //                 location.reload();
        //             }
        //         }
        //     });
        // }
    }
</script>

<?= $this->endSection('scripts'); ?>
<?= $this->endSection('content'); ?>