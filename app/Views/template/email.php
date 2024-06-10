<!DOCTYPE html>
<html>

<head>
    <title>Paycheck/Invoice</title>
</head>

<body>
    <h1>Hello, <?= esc($name) ?></h1>
    <p>Here is your salary information:</p>
    <ul>
        <li>Name: <?= esc($name) ?></li>
        <li>Salary: <?= esc($salary) ?></li>
    </ul>
    <p>Thank you!</p>
</body>

</html>