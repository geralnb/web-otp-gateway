<?= $this->extend('template_admin'); ?>
<?= $this->section('content'); ?>

<div class="mt-3">
    <div class="card border-0 shadow">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">Daftar Deposit</h4>
              <?php if (session()->getFlashdata('success')): ?>
                  <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('success') ?>
                  </div>
              <?php endif; ?>
              <?php if (session()->getFlashdata('error')): ?>
                  <div class="alert alert-danger" role="alert">
                      <?= session()->getFlashdata('error') ?>
                  </div>
              <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="depositTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>No Inv</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deposit as $key => $depo) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td class="text-nowrap"><?= $depo['username'] ?></td>
                                <td class="text-nowrap"><?= $depo['no_inv'] ?></td>
                                <td>Rp <?= number_format($depo['amount'], 0, ',', '.') ?></td>
                                <td><?= $depo['status'] ?></td>
                                <td class="text-nowrap"><?= $depo['transaction_date'] ?></td>
                                <td class="text-nowrap">
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $depo['id'] ?>">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach ($deposit as $depo) : ?>
    <div class="modal fade" id="hapusModal<?= $depo['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?= $depo['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel<?= $depo['id'] ?>">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data deposit ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('admin/deposit/hapus/' . $depo['id']) ?>" class="btn btn-danger btn- mx-1">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        $('#depositTable').DataTable();
    });
</script>

<?= $this->endSection(); ?>