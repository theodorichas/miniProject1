<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable Inside Form</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body>

    <form id="myForm" action="submit.php" method="post">
        <!-- DataTable -->
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>30</td>
                    <td>john@example.com</td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td>25</td>
                    <td>jane@example.com</td>
                </tr>
                <!-- More rows... -->
            </tbody>
        </table>

        <!-- Submit Button -->
        <button type="submit">Submit</button>
    </form>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</body>

</html>


<!-- buttons += '<button class="btn btn-primary action-btn" onclick="UpdateRecord(' + full.menu_id + ', \'' + full.menu_name + '\', \'' + full.page_name + '\', \'' + full.file_name + '\', \'' + full.parent_menu + '\', \'' + full.icon + '\', \'' + full.note + '\', \'' + full.order_no + '\', \'' + full.visible + '\')" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</button>';
buttons += '<button class="btn btn-danger action-btn"onclick="deleteRecord(' + full.menu_id + ')">Delete</button>'; -->