<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>

<div class="heading-top d-md-none d-lg-none d-xl-none">
  <div class="item-heading d-flex justify-content-between align-items-center">
    <div class="bg-white" style="width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
      <a href="<?= base_url() ?>user" class="text-dark">
        <i class="ti ti-arrow-narrow-left" style="font-size: 28px;"></i>
      </a>
    </div>
      <span class="fw-semibold text-white fs-6">Profile</span>
      <ul class="navbar-nav flex-row align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= base_url('public/new/assets/images/profile/user-1.jpg') ?>" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up border-0 shadow" aria-labelledby="drop2">
            <div class="message-body">
              <a href="<?= base_url(); ?>profile" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3">Profil</p>
              </a>
              <a href="<?= base_url(); ?>hubungi-kami" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-address-book fs-6"></i>
                <p class="mb-0 fs-3">Hubungi Kami</p>
              </a>
              <a href="<?= base_url(); ?>auth/logout" class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
            </div>
          </div>
        </li>
      </ul>
  </div>
</div>

<div class="container-fluid">
  <div class="content-index mb-4">
    <div class="row">
        <div class="col-md-8">
            <form action="<?= base_url('profile/update-password') ?>" method="post">
              <?= csrf_field() ?>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="<?= $username ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No WhatsApp</label>
                            <input type="email" class="form-control" placeholder="<?= $no_wa ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bergabung</label>
                            <input type="text" class="form-control" placeholder="<?= $date_create ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Saldo</label>
                            <input type="number" class="form-control" placeholder="Rp <?php echo number_format($balance, 0, ',', '.'); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password lama</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Masukkan password lama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password baru</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Masukkan password baru" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi password baru</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi password baru" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            text: "<?php echo session()->getFlashdata('success') ?>",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            text: "<?php echo session()->getFlashdata('error') ?>",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>

<?php $this->endSection(); ?>