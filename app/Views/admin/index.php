<?php $this->extend('template_admin'); ?>
<?php $this->section('content'); ?>

<div class="mt-3">
  <div class="row">
    <div class="col-12 col-lg-6 mb-4">
      <div class="row">
        <h4 class="text-center mb-3">Transaksi hari ini</h4>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Transaksi Sukses </h5>
                  <h4 class="fw-semibold mb-3">Rp <?php echo number_format($totalPriceDoneOrdersToday, 0, ',', '.'); ?></h4>
                  <div class="d-flex align-items-center pb-1">
                    <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                    <i class="ti ti-arrow-up-right text-success"></i>
                                </span>
                    <p class="text-dark me-1 fs-3 mb-0"><?php echo number_format($doneOrders, 0, ',', '.'); ?></p>
                    <p class="fs-3 mb-0">x</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-timeline fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Keuntungan </h5>
                  <h4 class="fw-semibold mb-3">Rp <?php echo number_format($totalProfitDoneOrdersToday, 0, ',', '.'); ?></h4>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-report-money fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Pengguna Baru </h5>
                  <h4 class="fw-semibold mb-3"><?php echo number_format($totalUsersToday, 0, ',', '.'); ?></h4>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-primary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-users fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6">
      <div class="row">
        <h4 class="text-center mb-3">Transaksi Keseluruhan</h4>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Total Transaksi Sukses </h5>
                  <h4 class="fw-semibold mb-3">Rp <?php echo number_format($totalPriceProfitDoneOrdersAll, 0, ',', '.'); ?></h4>
                  <div class="d-flex align-items-center pb-1">
                    <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                    <i class="ti ti-arrow-up-right text-success"></i>
                                </span>
                    <p class="text-dark me-1 fs-3 mb-0"><?php echo number_format($doneOrdersAll, 0, ',', '.'); ?></p>
                    <p class="fs-3 mb-0">x</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-timeline fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Total Keuntungan </h5>
                  <h4 class="fw-semibold mb-3">Rp <?php echo number_format($totalProfitDoneOrders, 0, ',', '.'); ?></h4>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-report-money fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Total Deposit </h5>
                  <h4 class="fw-semibold mb-3">Rp <?php echo number_format($totalDeposit, 0, ',', '.'); ?></h4>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-brand-cashapp fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Total Saldo User </h5>
                  <h4 class="fw-semibold mb-3">Rp <?php echo number_format($totalSaldo, 0, ',', '.'); ?></h4>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-dark rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-businessplan fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card border-0 shadow">
            <div class="card-body">
              <div class="row alig n-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold"> Total Pengguna </h5>
                  <h4 class="fw-semibold mb-3"><?php echo number_format($totalUsers, 0, ',', '.'); ?></h4>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div class="text-white bg-primary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-users fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection(); ?>