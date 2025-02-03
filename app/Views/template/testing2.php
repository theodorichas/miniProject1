<?= $this->extend('template/index'); ?>
<?= $this->section('links'); ?>

<title><?= $title ?></title>
<?= $this->endSection('links'); ?>
<?= $this->section('content'); ?>

<h1>hello wrold</h1>

<?= $this->endSection('content'); ?>
<!-- Merupakan extensi dari scripts yang ada pada view template -->
<?= $this->section('scripts'); ?>
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/bjgz92ul6s7x2rivrravy9f40blvx8tr9t7mv35hb6iglejj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
<!-- TinyMCE Script -->
<script>
    tinymce.init({
        selector: '#template_body',
        height: 500,
        menubar: false,
        plugins: [
            'save', 'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount', 'autosave'
        ],
        toolbar: 'undo redo spellcheckdialog | formatselect | blocks fontfamily fontsize | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat typography | code | help',
        autosave_ask_before_unload: true,
        autosave_interval: '30s', // Save every 30 seconds
        autosave_retention: '2m', // Retain saved data for 2 minutes
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    tinymce.init({
        selector: '#template_note',
        height: 500,
        menubar: false,
        plugins: [
            'save', 'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount', 'autosave'
        ],
        toolbar: 'undo redo spellcheckdialog | formatselect | blocks fontfamily fontsize | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat typography | code | help',
        autosave_ask_before_unload: true,
        autosave_interval: '30s', // Save every 30 seconds
        autosave_retention: '2m', // Retain saved data for 2 minutes
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
</script>
<?= $this->endSection('scripts'); ?>