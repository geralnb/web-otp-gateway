<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>

<div class="heading-top d-md-none d-lg-none d-xl-none">
  <div class="item-heading d-flex justify-content-between align-items-center">
    <div class="bg-white" style="width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
      <a href="<?= base_url() ?>user" class="text-dark">
        <i class="ti ti-arrow-narrow-left" style="font-size: 28px;"></i>
      </a>
    </div>
      <span class="fw-semibold text-white fs-6">Mutasi</span>
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
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap" id="riwayatTable">
                            <thead>
                                <tr>
                                    <th scope="col">tanggal</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                foreach ($riwayat as $r) :
                                ?>
                                    <tr>
                                        <td><?= $r['tanggal'] ?></td>
                                        <td><?= $r['catatan'] ?>
                                            <br>
                                            Saldo Awal Rp <?= number_format($r['saldo_awal'], 0, ',', '.') ?> <br>
                                            Saldo Akhir Rp <?= number_format($r['saldo_akhir'], 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?php
                                            $formattedJumlah = ($r['tipe'] === 'Pengurangan' ? '- ' : '+ ') . 'Rp ' . number_format(abs($r['jumlah']), 0, ',', '.');
                                            $badgeClass = ($r['tipe'] === 'Pengurangan') ? 'btn-danger' : 'btn-success';
                                            ?>
                                            <span class="btn <?= $badgeClass ?>"><?= $formattedJumlah ?></span>
                                        </td>
                                    </tr>
                                <?php
                                    $counter++;
                                endforeach;
                                ?>
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
        $('#riwayatTable').DataTable({
            "order": [[0, 'desc']]
        });
    });
</script>

<?php $this->endSection(); ?>