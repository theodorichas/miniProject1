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
                <h3 class="card-title"><?= getTranslation('card-title-language') ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Button trigger modal -->
                <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?= getTranslation('button-add-lang') ?>
                </a>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= getTranslation('text-lang-key') ?></th>
                            <th scope="col"><?= getTranslation('text-lang-en') ?></th>
                            <th scope="col"><?= getTranslation('text-lang-indo') ?></th>
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
                <form name="formGroup" id="quickForm">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="langId" id="langId" value="">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="langKey" class="form-label"><?= getTranslation('text-lang-key') ?></label>
                            <input type="text" name="langKey" id="langKey" class="form-control" placeholder="<?= getTranslation('text-lang-key-ph') ?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="langValueEn" class="form-label"><?= getTranslation('text-lang-key-en') ?></label>
                            <input type="text" name="langValueEn" id="langValueEn" class="form-control" placeholder="<?= getTranslation('text-lang-key-en-ph') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="langValueIndo" class="form-label"><?= getTranslation('text-lang-key-indo') ?></label>
                            <input type="text" name="langValueIndo" id="langValueIndo" class="form-control" placeholder="<?= getTranslation('text-lang-key-indo-ph') ?>">
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
            "ajax": "<?= site_url('langdtb') ?>",
            "columns": [{
                "data": "langKey",
            }, {
                "data": "langEn",
            }, {
                "data": "langIndo",
            }, {
                "data": null,
                "render": function(data, type, full, meta) {
                    return '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.langId + ', \'' + full.langKey + '\', \'' + full.langEn + '\', \'' + full.langIndo + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= getTranslation('button-update') ?></button>' +
                        '<button class="btn btn-danger action-btn"onclick="deleteRecord(' + full.langId + ')"><?= getTranslation('button-delete') ?></button>';
                },
                "defaultContent": ""
            }],
        });
    });
</script>
<!-- Jquery -->
<script>
    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                langKey: {
                    required: true
                },
                langValueEn: {
                    required: true
                },
                langValueIndo: {
                    required: true
                }
            },
            messages: {
                langKey: {
                    required: "This field cannot be empty"
                },
                langValueEn: {
                    required: "This field cannot be empty"
                },
                langValueIndo: {
                    required: "This field cannot be empty!!"
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
            $('#mTitle').text('Add Language');
            $('#btnModal').text('Add language');
            $('#langId').val('0');
        });
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
            }
            $.ajax({
                method: 'POST',
                type: 'JSON',
                url: '<?= base_url("lang/langAdd") ?>',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        title: "Data has been added/updated",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#example').DataTable().ajax.reload();
                            $('#exampleModal').modal('hide');
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log('AJAX request failed!');
                    console.log('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while processing your request. Please try again later.',
                        icon: 'error'
                    });
                }
            });
        });
    });

    function UpdateRecord(langId, langKey, langValueEn, langValueIndo) {
        $('#mTitle').text('<?= getTranslation('title-update-menu-modal') ?>');
        $('#btnModal').text('<?= getTranslation('button-update-modal') ?>');
        // Populate the modal fields with the existing data
        $("#langId").val(langId);
        console.log("Id yang didapat dari tombol update: ", langId);
        $('#langKey').val(langKey);
        $('#langValueEn').val(langValueEn);
        $('#langValueIndo').val(langValueIndo);
    }

    function deleteRecord(langId) {
        Swal.fire({
            title: "<?= getTranslation('text-swal-menu-title-delete') ?>",
            text: "<?= getTranslation('text-swal-warning-delete') ?>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "<?= getTranslation('button-no') ?>",
            confirmButtonText: "<?= getTranslation('text-swal-confirm-delete') ?>",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url('language/delete') ?>',
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        'langId': langId
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '<?= getTranslation('text-swal-deleted-title') ?>',
                                text: '<?= getTranslation('text-swal-user-deleted-text') ?>',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // Reload the DataTable or update the row accordingly
                            $('#example').DataTable().ajax.reload();
                            location.reload();
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
        console.log("Id yang didapat dari tombol update: ", langId);
    }
</script>





<?= $this->endSection('scripts'); ?>


<?= $this->endSection('content'); ?>