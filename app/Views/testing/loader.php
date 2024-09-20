<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->renderSection('links'); ?>


    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome-animation.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/font-awesome.min.css') ?>">

    <!-- CSS W3S -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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

<body>
    <div class="preloader flex-column justify-content-center align-items-center" id="pre-loader">
        <div class="loader"></div>
        <div class="success-icon"></div>
        <div class="error-icon"></div>
        <div class="loader-content">
            <h1 class="loader-message">Loading, Please Wait...</h1>
        </div>
        <div>
            <button class="button-testing">Switch</button>
        </div>
    </div>
</body>
<!-- jQuery -->
<script src="<?= base_url('asset/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<script>
    $('.button-testing').click(function() {
        if ($('.loader-message').text() === "Success!") {
            $('.loader-message').fadeOut(300, function() {
                $(this).text('Error!').fadeIn(300);
            });
            $('.loader').css('animation', 'puff 1s forwards');
            setTimeout(() => {
                $('.error-icon').fadeIn();
                $('.success-icon').hide();
            }, 400); // Delay to show success icon after puff
        } else {
            $('.loader-message').fadeOut(300, function() {
                $(this).text('Success!').fadeIn(300);
            });
            $('.loader').css('animation', 'puff 1s forwards');
            setTimeout(() => {
                $('.success-icon').fadeIn();
                $('.error-icon').hide();
            }, 400); // Delay to show success icon after puff
        }
    });
</script>

</html>