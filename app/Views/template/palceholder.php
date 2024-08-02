<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/bjgz92ul6s7x2rivrravy9f40blvx8tr9t7mv35hb6iglejj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
</head>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-addK">
                    <form name="formGroup" id="quickForm">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="template_id" id="template_id" value="">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="template_name" class="form-label"><?= getTranslation('text-template-name') ?></label>
                                <input type="text" name="template_name" id="template_name" class="form-control" placeholder="<?= getTranslation('text-lang-key-ph') ?>">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="template_subject" class="form-label"><?= getTranslation('text-template-subject') ?></label>
                                <input type="text" name="template_subject" id="template_subject" class="form-control" placeholder="<?= getTranslation('text-lang-key-en-ph') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="template_body" class="form-label"><?= getTranslation('text-template-body') ?></label>
                                <input type="text" name="template_body" id="template_body" class="form-control summernote" placeholder="<?= getTranslation('text-lang-key-indo-ph') ?>">
                            </div>
                        </div>
                        <button type="button" id="btnModal" name="update" class="btn btn-primary"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#template_body').tinymce({
            height: 500,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help'
        });
    </script>
</body>

</html>