<?php $this->extend('auth/template'); ?>
<?php $this->section('content'); ?>


<div class="card border-0 shadow">
  <div class="card-body">
    <a class="d-flex justify-content-center mb-4" href="<?= base_url(); ?>">
      <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" alt="<?= esc($web_title) ?>" width="170" height="50">
    </a>
    <h3 class="fw-semibold mb-1">Daftar</h3>
    <small>Lengkapi form di bawah ini untuk melakukan pendaftaran</small>
    <hr>
    <form method="post" action="<?= base_url(); ?>auth/valid-register">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
      </div>
      <div class="mb-3">
        <label for="no_wa" class="form-label">No WhatsApp</label>
        <input type="number" class="form-control" id="no_wa" name="no_wa" placeholder="Masukkan nomor WhatsApp" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
      </div>
      <div class="mb-3">
        <label for="confirm" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Masukkan konfirmasi password" required>
      </div>
      <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
    </form>
    <div class="mt-3">
      <p>
        <a href="<?= base_url(); ?>auth/login" class="text-decoration-none"><span class="text-dark">Sudah punya akun?</span> Login</a>
      </p>
    </div>
  </div>
</div>

<?php
    $session = session();
    $error = $session->getFlashdata('error');
?>
<?php if(session()->getFlashdata('error')): ?>
    <script>
        <?php foreach(session()->getFlashdata('error') as $error): ?>
            Swal.fire({
                position: "center",
                icon: "warning",
                text: "<?php echo $error ?>",
                showConfirmButton: false,
                timer: 1500
            });
        <?php endforeach; ?>
    </script>
<?php endif; ?>

<?php $this->endSection(); ?>