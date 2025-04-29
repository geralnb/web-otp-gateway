<?php $this->extend('template_admin'); ?>
<?php $this->section('content'); ?>

<div class="mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h4 class="fw-semibold mb-4">Contact</h4>

                    <?php if (session()->has('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/contact/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <div id="editor" style="height: 200px;"></div>
                            <input type="hidden" name="content" id="content" value="<?= htmlspecialchars($content['content']); ?>">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    quill.clipboard.dangerouslyPasteHTML(0, '<?= $content['content']; ?>');

    quill.on('text-change', function() {
        var deskripsiInput = document.getElementById('content');
        deskripsiInput.value = quill.root.innerHTML;
    });
</script>

<?php $this->endSection(); ?>