<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>

<style>
.nav-item button {
    border: none;
    color: #000;
}
.nav-link.tab:not(.active) {
    background-color: #ffffff!important;
  }            
.nav-link.tab.active {
    background-color: #573EE0!important;
    color: #fff!important;
}
.tab-pane ol li {
  font-size: 14px;
}
</style>

<div class="heading-top d-md-none d-lg-none d-xl-none">
  <div class="item-heading d-flex justify-content-between align-items-center">
    <div>
      <h4 class="text-white fw-semibold">Hallo <img src="public/img/vector/hand.svg" width="20"></h4>
      <span class="text-white fs-2">
        <span class="greeting-text"></span>, <?php echo $username; ?>
      </span>
    </div>
    <ul class="navbar-nav flex-row align-items-center">
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?= base_url('public/new/assets/images/profile/user-1.jpg') ?>" alt="" width="35" height="35" class="rounded-circle">
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up border-0 shadow" aria-labelledby="drop2">
          <div class="message-body">
            <a href="<?= base_url(); ?>profile" class="d-flex align-items-center gap-2 dropdown-item">
              <i class="ti ti-user fs-6"></i>
              <p class="mb-0 fs-3">Profile</p>
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
      <h4 class="mt-4 mb-4 d-none d-md-block d-lg-block d-xl-block">Hallo <?php echo $username; ?> <img src="public/img/vector/hand.svg"></h4>
      <div class="col-12 col-lg-6">
        <div class="col-lg-12">
          <div class="card border-0 shadow">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title mb-2 fw-semibold"> Saldo </h5>
                  <h4 class="fw-semibold">Rp <?php echo number_format($balance, 0, ',', '.'); ?></h4>
                  <a href="<?= base_url(); ?>deposit" class="btn btn-primary w-100 mt-4">Top Up Saldo</a>
                </div>
                <div class="col-4 p-0">
                  <div class="mobile-gif">
                    <img class="bg-white" src="public/img/gif/Chat-pana.svg" style="width: 100%;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="row mt-3">
          <div class="col-6">
            <div class="card border-0 shadow">
              <div class="card-body p-3">
                <div class="row alig n-items-start">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-semibold">Transaksi</span>
                    <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center ms-auto">
                      <i class="ti ti-receipt fs-3"></i>
                    </div>
                  </div>
                    <h5 class="fw-semibold mb-3">Rp <?php echo number_format($totalPrice, 0, ',', '.'); ?></h5>
                    <div class="d-flex align-items-center pb-1">
                      <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-right text-success"></i>
                                  </span>
                      <p class="text-dark me-1 fs-3 mb-0"><?= $totalOrders ?></p>
                      <p class="fs-3 mb-0">x</p>
                    </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card border-0 shadow">
              <div class="card-body p-3">
                <div class="row alig n-items-start">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-semibold">Deposit</span>
                    <div class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center ms-auto">
                      <i class="ti ti-currency-dollar fs-3"></i>
                    </div>
                  </div>
                    <h5 class="fw-semibold mb-3">Rp <?php echo number_format($totalAmountDeposit, 0, ',', '.'); ?></h5>
                    <div class="d-flex align-items-center pb-1">
                      <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-right text-success"></i>
                                  </span>
                      <p class="text-dark me-1 fs-3 mb-0"><?= $totalDeposit ?></p>
                      <p class="fs-3 mb-0">x</p>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="card border-0 shadow">
          <div class="card-body p-4">
            <div class="mb-4">
              <h5 class="card-title fw-semibold">Panduan Transaksi</h5>
            </div>
            <ul class="timeline-widget mb-0 position-relative mb-n5">
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1">Pilih menu <b>Beli Nomor</b></div>
              </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-secondary flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Pilih <b>Layanan Aplikasi</b> yang ingin digunakan</div>
                  </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Selanjutnya pastikan bahwa <b>Saldo</b> saat ini cukup</div>
                  </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Apabila sudah merasa benar, silahkan klik tombol <b>Beli Nomor</b></div>
                  </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Tunggu beberapa saat dan nomor akan muncul</div>
                  </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Lakukan pengiriman <b>OTP SMS</b> ke nomor yang sudah di dapatkan</div>
                  </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Tunggu beberapa saat dan <b>OTP SMS</b> akan muncul secara otomatis</div>
                  </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1">Transaksi Selesai</div>
                  </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection(); ?>