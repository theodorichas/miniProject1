<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Template</title>
    <script src="https://cdn.tiny.cloud/1/bjgz92ul6s7x2rivrravy9f40blvx8tr9t7mv35hb6iglejj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <?= $this->renderSection('links'); ?>
</head>

<body>
    <?= $this->renderSection('content'); ?>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>