<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome-animation.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/dist/css/adminlte.min.css') ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form name="register" id="quickForm">
                    <?= csrf_field(); ?>
                    <!-- Username -->
                    <input type="hidden" name="userId" id="userId" value="">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Full name">
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                    <span class="fas fa-eye"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LeyX-IpAAAAAIbQtozzPDj7JmSMz3s6zRzopA_J"></div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="button" name="btnModal" id="btnModal" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="<?= base_url('/login') ?>" class="text-center">I already have a membership</a>
                <div id="successMessage" style="display:none;">
                    <p>Thank you! Your verification link will come shortly, please check your inbox.</p>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('asset/AdminLTE/dist/js/adminlte.js') ?>"></script>
    <!-- jquery-validation -->
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('asset/AdminLTE/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('asset/AdminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <!-- Google Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Jquery logics -->
    <script>
        $(document).ready(function() {
            $('#quickForm').validate({
                rules: {
                    nama: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    }
                },
                messages: {
                    nama: {
                        required: "'Name' cannot be empty",
                    },
                    email: {
                        required: "'email' cannot be empty",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "'password' cannot be empty",
                        minlength: "password must contain at least 8 Characters!!",
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
            })
        })
        $('#btnModal').click(function() {
            if ($('#quickForm').valid()) {
                var formData = $('#quickForm').serialize();
                console.log(formData);
                // Show the loading screen inside a Swal
                Swal.fire({
                    title: 'Processing...',
                    html: '<div class="loading-spinner"></div>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                // AJAX request
                $.ajax({
                    method: 'POST',
                    dataType: 'json', // Use dataType instead of type
                    url: '<?= base_url("/registerAuth") ?>',
                    data: formData,
                    success: function(response) {
                        console.log('AJAX request successful!');
                        console.log('Response:', response);

                        // Check if authentication was successful
                        if (response.success) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Please Confirm',
                                text: response.message,
                            });
                            $('#quickForm').hide();
                            $('.text-center').hide();
                            $('#successMessage').show();
                            $('.login-box-msg').text('Your Almost there')
                        } else if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'There has been an error/mistake',
                                text: response.message,
                            })
                        } else {
                            // Display error message if authentication failed
                            Swal.fire({
                                icon: 'error',
                                title: 'Your Credintials are Invalid, Please try again!!!',
                                text: response.message,
                            });
                            grecaptcha.reset();
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
                        grecaptcha.reset();
                    }
                });
            } else {
                console.log('Data is empty or has not been filled');
                // Optionally, you can show the required message for empty fields here
            }
        });

        // Password see through toggle
        $('#togglePassword').on('click', function() {
            // Get the password input field
            var passwordField = $('#password');
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
    </script>

    <!-- Flash Data Alert -->
    <script>
        // Check for session flashdata and display the Swal alert

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
</body>

</html>