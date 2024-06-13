<!-- File: app/Views/template/paycheck.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Paycheck/Invoice</title>
</head>

<body>
    <h1>Hello, <?= esc($employee['name']) ?></h1>
    <p>Here is your salary information:</p>
    <ul>
        <li>Name: <?= esc($employee['name']) ?></li>
        <li>Salary: <?= esc($employee['formatted_salary']) ?></li>
    </ul>
    <p>Thank you!</p>
</body>

</html>