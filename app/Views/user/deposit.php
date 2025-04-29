<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>

<div class="heading-top d-md-none d-lg-none d-xl-none">
  <div class="item-heading d-flex justify-content-between align-items-center">
    <div class="bg-white" style="width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
      <a href="<?= base_url() ?>user" class="text-dark">
        <i class="ti ti-arrow-narrow-left" style="font-size: 28px;"></i>
      </a>
    </div>
      <span class="fw-semibold text-white fs-6">Deposit</span>
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
          <div class="col-12 col-lg-4">
              <?php if (session()->has('error')) : ?>
                  <div class="alert alert-dismissible alert-danger">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <?= session('error') ?>
                  </div>
              <?php endif; ?>
              <div class="card border-0 shadow">
                  <div class="card-body">
                      <form action="<?= base_url('process-deposits') ?>" method="post">
                        <?= csrf_field() ?>
                          <div class="mb-3">
                              <label for="amount" class="form-label">Jumlah Deposit</label>
                              <input type="number" class="form-control" id="amount" name="amount" placeholder="10.000" required>
                          </div>
  
                          <div class="mb-3 text-center">
                              <button type="submit" class="btn btn-primary w-100">Deposit Sekarang</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      
        <div class="col-12 col-lg-8">
         <div class="card border-0 shadow">
            <div class="card-body">
             <h5 class="fw-semibold mb-4">Riwayat Deposit</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap" id="depositTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-nowrap">No Inv</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datadeposit as $index => $deposit) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $deposit['no_inv'] ?></td>
                                    <td>Rp <?= number_format($deposit['amount'], 0, ',', '.') ?></td>
                                    <td><?= $deposit['status'] ?></td>
                                    <td class="text-nowrap"><?= $deposit['transaction_date'] ?></td>
                                    <td>
                                      <?php if ($deposit['status'] === 'UNPAID') : ?>
                                      <a href="<?= $deposit['payment_code'] ?>" class="btn btn-sm btn-primary">Bayar</a>
                                      <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
   </div>
</div>

<script>
    $(document).ready(function() {
        $('#depositTable').DataTable();
    });
</script>

<?php $this->endSection(); ?>