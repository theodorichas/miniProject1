<!-- Login -->

<body class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Puka</b>System</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form name="login" id="quickForm">
                    <?= csrf_field(); ?>
                    <!-- Email -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
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
                    <!-- Google Recaptcha -->
                    <div class="recaptcha-container">
                        <div class="g-recaptcha" data-sitekey="6LeyX-IpAAAAAIbQtozzPDj7JmSMz3s6zRzopA_J"></div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="button" name="btnModal" id="btnModal" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a href="<?= base_url('/forgetPassword') ?>">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="<?= base_url('/register') ?>" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

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
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: "'email' cannot be empty",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "'password' cannot be empty",
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
                    url: '<?= base_url("/loginAuth") ?>',
                    data: formData,
                    success: function(response) {
                        console.log('AJAX request successful!');
                        console.log('Response:', response);

                        // Check if authentication was successful
                        if (response.success) {
                            // Redirect to dashboard or another page
                            window.location.href = '/';
                        } else {
                            // Display error message if authentication failed
                            Swal.fire({
                                icon: 'error',
                                title: 'Credential Invalid',
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

    <!-- Flashdata from the Auth Controller :: Verify function-->
    <script>
        // Check for session flashdata and display the Swal alert
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

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

<!--  -->
// Swal.fire({
// icon: 'info',
// title: 'Please Confirm',
// text: response.message,
// });
// $('#container').hide();
// $('#popup').show();
// $('#quickFormReg').hide();
// $('#signInPanel').hide();
// $('#successMessage').show();
// $('#signIn').hide();
// $('#overlay-left-header').text("Success!!");
// $('#overlay-left-p').hide();
// $('#signIn').hide();