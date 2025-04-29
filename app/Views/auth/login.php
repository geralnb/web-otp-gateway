<?php $this->extend('auth/template'); ?>
<?php $this->section('content'); ?>

<div class="card border-0 shadow">
  <div class="card-body">
    <a class="d-flex justify-content-center mb-4" href="<?= base_url(); ?>">
      <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" alt="<?= esc($web_title) ?>" width="170" height="50">
    </a>
    <h3 class="fw-semibold mb-1">Login</h3>
    <small>Masukkan username dan password untuk login</small>
    <hr>
    <form method="post" action="<?= base_url(); ?>/auth/valid-login">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
      </div>
      <div class="mt-3">
        <p>
          <a href="<?= base_url(); ?>auth/reset-password" class="text-decoration-none text-primary">Lupa Kata Sandi?</a>
        </p>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="mt-3">
      <p>
        <a href="<?= base_url(); ?>auth/register" class="text-decoration-none text-primary"><span class="text-dark">Belum punya akun?</span> Daftar</a>
      </p>
    </div>
  </div>
</div>

<?php
    $session = session();
    $login = $session->getFlashdata('login');
    $usernameError = $session->getFlashdata('username');
    $passwordError = $session->getFlashdata('password');
?>
<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            text: "<?= session()->getFlashdata('success') ?>",
            showConfirmButton: true
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
<?php if ($login): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            text: "<?= $login ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php elseif ($usernameError): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            text: "<?= $usernameError ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php elseif ($passwordError): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            text: "<?= $passwordError ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>

<?php $this->endSection(); ?>