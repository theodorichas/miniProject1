<?= $this->extend('templateTest/index'); ?>

<?= $this->section('links'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
  body {
    font-family: Arial, sans-serif;
  }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<h2>Welcome to the Simple Template</h2>
<p>This is a test to see if sections are extending correctly.</p>
<textarea id="template_body"></textarea>
<textarea id="template_note"></textarea>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
      tinymce.init({
        selector: '#template_body, #template_note',
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
    }, 500); // Small delay to ensure page is fully loaded
  });
</script>
<?= $this->endSection(); ?>