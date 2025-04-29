<?= $this->extend('template_admin') ?>
<?= $this->section('content') ?>

<div class="mt-3">
      <div class="card border-0 shadow">
          <div class="card-body">
            <h4 class="fw-semibold mb-4">Data Orders</h4>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
              <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="orderotpwebTable">
                      <thead>
                          <tr class="text-nowrap">
                              <th>#</th>
                              <th>Order ID</th>
                              <th>User ID</th>
                              <th>Service Name</th>
                              <th>Number</th>
                              <th>Price</th>
                              <th>Profit</th>
                              <th>Status</th>
                              <th>SMS</th>
                              <th>Created At</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($orders as $index => $order) : ?>
                              <tr>
                                  <td><?= $index + 1 ?></td>
                                  <td><?= $order['order_id'] ?></td>
                                  <td><?= $order['user_id'] ?></td>
                                  <td><?= $order['service_name'] ?></td>
                                  <td><?= $order['number'] ?></td>
                                  <td><?= $order['price'] ?></td>
                                  <td><?= $order['profit'] ?></td>
                                  <td><?= $order['status'] ?></td>
                                  <td><?= $order['sms'] ?></td>
                                  <td class="text-nowrap"><?= $order['created_at'] ?></td>
                                  <td class="text-nowrap">
                                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $order['id'] ?>">
                                          Delete
                                      </button>
                                  </td>
                              </tr>
  
                              <!-- Delete Modal -->
                      <div class="modal fade" id="deleteModal<?= $order['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <p>Apakah Anda yakin ingin menghapus data Pesanan ini?</p>
                                      <form action="<?= base_url('admin/orders/delete/' . $order['id']) ?>" method="post">
                                          <?= csrf_field() ?>
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-danger">Delete</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
</div>

<script>
    $(document).ready(function() {
        $('#orderotpwebTable').DataTable();
    });
</script>

<?= $this->endSection() ?>