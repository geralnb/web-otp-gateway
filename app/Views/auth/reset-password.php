<?php $this->extend('auth/template'); ?>
<?php $this->section('content'); ?>

<div class="card border-0 shadow">
  <div class="card-body">
    <a class="d-flex justify-content-center mb-4" href="<?= base_url(); ?>">
      <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" alt="<?= esc($web_title) ?>" width="170" height="50">
    </a>
    <h3 class="fw-semibold mb-1">Lupa Kata Sandi</h3>
    <small>Masukan nomor WhatsApp yang terdaftar pada akun anda dan kami akan mengirim kode OTP untuk verifikasi lupa kata sandi.</small>
    <hr>
    <form action="<?= base_url('auth/reset-password-valid') ?>" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="nomor_telepon" class="form-label">Nomor WhatsApp</label>
        <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="08XXXXXX" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Kirim OTP</button>
      </div>
    </form>
    <div class="mt-3">
      <p>
        <a href="<?= base_url(); ?>auth/login" class="text-decoration-none text-primary"><span class="text-dark">Ingat kata sandi?</span> Login</a>
      </p>
    </div>
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