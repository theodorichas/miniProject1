<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/bjgz92ul6s7x2rivrravy9f40blvx8tr9t7mv35hb6iglejj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
    <!-- DataTable -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')  ?>">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome-animation.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/summernote/summernote-bs4.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="sidebar-mini layout-fixed sidebar-collapse layout-footer-fixed" style="height: auto;">
    <div class=" wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="asset/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <?php $currentLanguage = session()->get('language') ?? 'en'; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-toggle="dropdown">
                        <i id="themeIcon" class="fas"></i>
                        <span id="themeText"></span>
                    </a>
                    <div class=" dropdown-menu" aria-labelledby="themeDropdown">
                        <a class="dropdown-item" href="#" id="lightMode">Light Mode</a>
                        <a class="dropdown-item" href="#" id="darkMode">Dark Mode</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-globe"></i>
                        <?= ($currentLanguage === 'en') ? 'EN' : 'ID' ?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url('/change-language/en') ?>">English/En</a>
                        <a class="dropdown-item" href="<?= base_url('/change-language/indo') ?>">Indonesian/Id</a>
                        <a class="dropdown-item" href="<?= base_url('/addLanguage') ?>"> +Add language</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <?php if (!empty($nama)) : ?>
                        <a class="nav-link welcome-text" data-toggle="dropdown" href="#" id="welcome-text">
                            <p>Welcome back, <?= $nama; ?></p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- <a href="<?= base_url('/myprofile') ?>" class="dropdown-item dropdown-footer">Edit Profile</a> -->
                            <a href="<?= base_url('/logout') ?>" class="dropdown-item dropdown-footer">Log-out</a>
                        </div>
                    <?php else : ?>
                        <a href="<?= base_url('/login') ?>" class="nav-link">
                            <p>Log-in</p>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('/') ?>" class="brand-link">
                <img src="asset/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" id='sidebar'>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if (session()->has('user_id')) : // Check if user is logged in 
                        ?>
                            <?php foreach ($menus as $menu) : ?>
                                <?php
                                // Determine if the menu item should be hidden based on 'visible' status
                                $visibilityClass = ($menu->visible == 0) ? 'd-none' : '';

                                // Debug: Print the visibility value
                                // echo 'Menu ID: ' . $menu->menu_id . ' - Visible: ' . $menu->visible . '<br>';

                                // Check if the user has permission to view this menu
                                $hasPermission = false;
                                foreach ($permission as $perm) {
                                    if ($perm->menu_id == $menu->menu_id && $perm->view == 1) {
                                        $hasPermission = true;
                                        break; // No need to continue checking once permission is found
                                    }
                                }
                                ?>
                                <?php if ($hasPermission) : ?>
                                    <li class="nav-item <?= $visibilityClass ?>">
                                        <!-- Debug: Print the applied visibility class -->
                                        <!-- <?php echo 'Visibility Class: ' . $visibilityClass . '<br>'; ?> -->
                                        <a href="<?= base_url($menu->file_name) ?>" class="nav-link">
                                            <i class="<?= $menu->icon ?>"></i>
                                            <p><?= $menu->menu_name ?></p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : // If user is not logged in 
                        ?>
                            <div class="brand-text font-weight-light">
                                <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p>
                            </div>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <?php if (session()->has('user_id')) : ?>
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="w3-container">
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
                                            <!-- Button home -->
                                            <a button type="button" id="btnAdd" class="btn btn-success swalDefaultSuccess" href="<?= base_url('/') ?>">
                                                <?= getTranslation('button-home') ?>
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
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        <?php else : ?>
            <div class="login-req">
                <h1>
                    <?= lang('app.login-require') ?>
                </h1>
            </div>
        <?php endif; ?>

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
                                <textarea id="template_body" name="template_body" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="button" id="btnModal" name="update" class="btn btn-primary"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        return '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.template_id + ', \'' +
                            escapeHtml(full.template_name) + '\', \'' +
                            escapeHtml(full.template_subject) + '\', `' +
                            escapeHtml(full.template_body) + '`)" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= getTranslation('button-update') ?></button>' +
                            '<button class="btn btn-danger action-btn" onclick="deleteRecord(' + full.template_id + ')"><?= getTranslation('button-delete') ?></button>';
                    },
                    "defaultContent": ""
                }],
            });
        });

        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;")
                .replace(/`/g, "&#x60;");
        }
    </script>
    <!-- TinyMCE Script -->
    <script>
        tinymce.init({
            selector: '#template_body',
            height: 500,
            menubar: false,
            plugins: [
                'save', 'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount', 'autosave'
            ],
            toolbar: 'undo redo spellcheckdialog | formatselect | blocks fontfamily fontsize | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat typography | code | help',
            autosave_ask_before_unload: true,
            autosave_interval: '30s', // Save every 30 seconds
            autosave_retention: '2m', // Retain saved data for 2 minutes
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>

    <script>
        // Insert here function here
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
                tinymce.triggerSave(); // This will save the TinyMCE content to the underlying textarea
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

        })

        function UpdateRecord(template_id, template_name, template_subject, template_body) {
            $('#mTitle').text('<?= getTranslation('title-update-menu-modal') ?>');
            $('#btnModal').text('<?= getTranslation('button-update-modal') ?>');
            // Populate the modal fields with the existing data
            $("#template_id").val(template_id);
            console.log("Id yang didapat dari tombol update: ", template_id);
            $('#template_name').val(template_name);
            $('#template_subject').val(template_subject);
            // Set the content in TinyMCE, decoding any special characters
            tinymce.get('template_body').setContent(decodeURIComponent(template_body));
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
                                    text: '<?= getTranslation('text-swal-template-deleted-text') ?>',
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


    <!-- jQuery -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('asset/AdminLTE/plugins/chart.js/Chart.min.js') ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('asset/AdminLTE/plugins/sparklines/sparkline.js') ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('asset/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('asset/AdminLTE/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('asset/AdminLTE/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url('asset/AdminLTE/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('asset/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('asset/AdminLTE/dist/js/adminlte.js') ?>"></script>
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
</body>

</html>