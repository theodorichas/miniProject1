<?= $this->extend('template/index'); ?>

<?= $this->section('links'); ?>
<title><?= $title ?></title>
<!-- DataTable -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('asset/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">

<?= $this->endSection('links'); ?>

<!-- Main Content -->
<?= $this->section('content'); ?>

<?= 'Group Id untuk page ini: ', $group_id; ?>
<!-- Data Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable Group Permission</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <button type="button" id="btnSave" class="btn btn-info swalDefaultSuccess">
                    Save
                </button>
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><?= getTranslation('text-group-id') ?></th>
                            <th scope="col"><?= lang('app.text-view') ?></th>
                            <th scope="col"><?= lang('app.text-edit') ?></th>
                            <th scope="col"><?= lang('app.text-delete') ?></th>
                            <th scope="col"><?= lang('app.text-menu') ?></th>
                            <th scope="col"><?= lang('app.text-menu-file') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('scripts'); ?>

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
<!-- Script untuk menampilkan DataTable Server Side menggunakan AJAX -->
<script>
    $(document).ready(function() {
        var group_id = '<?= $group_id ?>';
        $('#example').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'get',
            'ajax': {
                'url': "<?= site_url('gpermidtb') ?>",
                'data': {
                    'group_id': group_id,
                }
            },
            'columns': [{
                'data': 'group_id',
            }, {
                'data': 'view',
                'render': function(data, type, row, meta) {
                    return renderCheckbox(data, 'view', row.group_id, row.menu_id);
                }
            }, {
                'data': 'edit',
                'render': function(data, type, row, meta) {
                    return renderCheckbox(data, 'edit', row.group_id, row.menu_id);
                }
            }, {
                'data': 'delete',
                'render': function(data, type, row, meta) {
                    return renderCheckbox(data, 'delete', row.group_id, row.menu_id);
                }
            }, {
                'data': 'menu_name'
            }, {
                'data': 'file_name'
            }]

        })

        function renderCheckbox(data, type, group_id, menu_id) {
            // Add classes based on the type of checkbox
            var checkboxClass = '';
            if (type === 'view') {
                checkboxClass = 'view-checkbox';
            } else if (type === 'edit') {
                checkboxClass = 'edit-checkbox';
            } else if (type === 'delete') {
                checkboxClass = 'delete-checkbox';
            }

            return '<input type="checkbox" class="' + checkboxClass + '" data-type="' + type + '" data-group_id="' + group_id + '" data-menu_id="' + menu_id + '" value="' + group_id + '" ' + (data == 1 ? 'checked' : '') + ' data-menu_id="' + menu_id + '">';
        }

        // Event listener for checkbox changes
        $(document).on('change', '.view-checkbox, .edit-checkbox, .delete-checkbox', function() {
            var isChecked = $(this).prop('checked') ? 1 : 0; // Convert to 1 or 0
            var type = $(this).data('type');
            var group_id = $(this).data('group_id');
            var menu_id = $(this).data('menu_id'); // Get menu_id from the closest <tr>
            console.log('Checkbox changed for group ID: ' + group_id);
            console.log('Type: ' + type);
            console.log('Checked: ' + isChecked);
            console.log('Menu ID: ' + menu_id);
        });
    })
</script>

<script>
    $('#btnSave').click(function() {
        var group_id = '<?= $group_id ?>'; // Retrieve group_id from a PHP variable
        console.log('Group ID for Save:', group_id);
        if (group_id === null || group_id === '') {
            group_id = 0;
        }
        var formData = [];
        $('#example').find('input[type="checkbox"]').each(function() {
            var checkbox = $(this);
            var type = checkbox.data('type');
            var menu_id = checkbox.data('menu_id');
            var isChecked = checkbox.prop('checked') ? 1 : 0;

            // Push the checkbox data into formData array
            formData.push({
                type: type, // Include the type property
                checked: isChecked,
                menu_id: menu_id
            });
        });
        $.ajax({
            method: 'POST',
            url: '<?= base_url('gpermi/updateAdd') ?>',
            type: 'JSON',
            data: {
                'data': formData,
                'group_id': group_id,
            },
            beforeSend: function() {
                console.log('Form data before sending:', formData);
            },
            success: function(response) {
                console.log('AJAX request successful!');
                console.log('Response:', response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '<?= lang('app.text-swal-title') ?>',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    $('#example').DataTable().ajax.reload();
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '<?= lang('app.text-swal-title-error') ?>',
                        showConfirmButton: false,
                        timer: 1500,
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
    })
</script>

<?= $this->endSection('scripts'); ?>