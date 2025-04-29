<?php $this->extend('auth/template'); ?>
<?php $this->section('content'); ?>

<div class="card border-0 shadow">
  <div class="card-body">
    <a class="d-flex justify-content-center mb-4" href="<?= base_url(); ?>">
      <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" alt="<?= esc($web_title) ?>" width="170" height="50">
    </a>
    <h3 class="fw-semibold mb-1">Password Baru</h3>
    <small>Masukkan Password baru yang ingin anda gunakan.</small>
    <hr>
    <form action="<?= base_url('auth/valid-new-password') ?>" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="new_password" class="form-label">Password Baru</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Reset Password</button>
      </div>
    </form>
  </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            text: "<?= session()->getFlashdata('success') ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            text: "<?= session()->getFlashdata('error') ?>",
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

<?php $this->endSection(); ?>