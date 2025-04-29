<?php $this->extend('auth/template'); ?>
<?php $this->section('content'); ?>

<div class="card border-0 shadow">
  <div class="card-body">
    <a class="d-flex justify-content-center mb-4" href="<?= base_url(); ?>">
      <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" alt="<?= esc($web_title) ?>" width="170" height="50">
    </a>
    <h3 class="fw-semibold mb-1">Verifikasi OTP</h3>
    <small>Masukkan kode OTP yang sudah kami kirim ke nomor WhatsApp anda.</small>
    <hr>
    <form action="<?= base_url('auth/valid-verify-otp') ?>" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="otp" class="form-label">Masukkan kode OTP</label>
        <input type="number" class="form-control" id="otp" name="otp" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Verifikasi OTP</button>
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
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>

<?php $this->endSection(); ?>