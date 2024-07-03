<!-- File: app/Views/template/paycheck.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>
    <h1>Reset Password</h1>
    <div class="Paragraph">
        <p>Here is the link to reset your password</p>
        <a href="<?= site_url('/resetPassForm/' . $token) ?>">Password Reset</a>
    </div>
    <ul>
        Something random
    </ul>
    <p>Thank you!</p>
</body>

</html>