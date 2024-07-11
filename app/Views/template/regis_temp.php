<!-- File: app/Views/template/paycheck.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Verify Account</title>
</head>

<body>
    <h1>Your almost done</h1>
    <div class="Paragraph">
        <p>Click the link below to </p>
        <a href="<?= site_url('/verify/' . $token) ?>">Verify Email</a>
    </div>
    <ul>
        Something random
    </ul>
    <p>Thank you!</p>
</body>

</html>