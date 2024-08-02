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
                <h3 class="card-title"><?= getTranslation('card-title-template') ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Button trigger modal -->
                <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?= getTranslation('button-add-template') ?>
                </a>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= getTranslation('text-template-name') ?></th>
                            <th scope="col"><?= getTranslation('text-template-subject') ?></th>
                            <th scope="col"><?= getTranslation('text-template-body') ?></th>
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
                    <input type="hidden" name="template_id" id="template_id" value="">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="template_name" class="form-label"><?= getTranslation('text-template-name') ?></label>
                            <input type="text" name="template_name" id="template_name" class="form-control" placeholder="<?= getTranslation('text-lang-key-ph') ?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="template_subject" class="form-label"><?= getTranslation('text-template-subject') ?></label>
                            <input type="text" name="template_subject" id="template_subject" class="form-control" placeholder="<?= getTranslation('text-lang-key-en-ph') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="template_body" class="form-label"><?= getTranslation('text-template-body') ?></label>
                            <input type="text" name="template_body" id="template_body" class="form-control summernote" placeholder="<?= getTranslation('text-lang-key-indo-ph') ?>">
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
            "ajax": "<?= site_url('templatedtb') ?>",
            "columns": [{
                "data": "template_name",
            }, {
                "data": "template_subject",
            }, {
                "data": "template_body",
            }, {
                "data": null,
                "render": function(data, type, full, meta) {
                    return '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.template_id + ', \'' + full.template_name + '\', \'' + full.template_subject + '\', \'' + full.template_body + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= getTranslation('button-update') ?></button>' +
                        '<button class="btn btn-danger action-btn"onclick="deleteRecord(' + full.template_id + ')"><?= getTranslation('button-delete') ?></button>';
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
                template_name: {
                    required: true
                },
                template_subject: {
                    required: true
                },
                template_body: {
                    required: true
                }
            },
            messages: {
                template_name: {
                    required: "This field cannot be empty"
                },
                template_subject: {
                    required: "This field cannot be empty"
                },
                template_body: {
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
        // Initialize Summernote
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#quickForm').trigger('reset');
            $('#quickForm :input').removeClass('is-invalid');
            $('#quickForm').removeClass('error invalid-feedback');
        });
        $('#btnAdd').click(function() {
            $('#mTitle').text('<?= getTranslation('title-add-template-modal') ?>');
            $('#btnModal').text('<?= getTranslation('button-add-modal') ?>');
            $('#template_id').val('0');
        });
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
            }
            $.ajax({
                method: 'POST',
                type: 'JSON',
                url: '<?= base_url("/template/templateAdd") ?>',
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

    function UpdateRecord(template_id, template_name, template_subject, template_body) {
        $('#mTitle').text('<?= getTranslation('title-update-menu-modal') ?>');
        $('#btnModal').text('<?= getTranslation('button-update-modal') ?>');
        // Populate the modal fields with the existing data
        $("#template_id").val(template_id);
        console.log("Id yang didapat dari tombol update: ", template_id);
        $('#template_name').val(template_name);
        $('#template_subject').val(template_subject);
        // $('#template_body').val(template_body);
        $('#template_body').summernote('code', template_body)
    }

    function deleteRecord(template_id) {
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
                    url: '<?= site_url('template/delete') ?>',
                    method: 'POST',
                    type: 'JSON',
                    data: {
                        'template_id': template_id
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
        console.log("Id yang didapat dari tombol update: ", template_id);
    }
</script>
<script src="https://cdn.tiny.cloud/1/bjgz92ul6s7x2rivrravy9f40blvx8tr9t7mv35hb6iglejj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
<script>
    $('#template_body').tinymce({
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | help'
    });
</script>




<?= $this->endSection('scripts'); ?>


<?= $this->endSection('content'); ?>