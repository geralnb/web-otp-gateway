<?= $this->extend('template_admin'); ?>

<?= $this->section('content'); ?>

<div class="mt-3">
    <div class="card border-0 shadow">
        <div class="card-body">
            <h4 class="fw-semibold mb-4">Daftar Pengguna</h4>
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
                <table class="table table-bordered table-striped text-nowrap" id="userTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Saldo</th>
                            <th>No WhatsApp</th>
                            <th>Role</th>
                            <th>Date Created</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $user) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td class="text-nowrap"><?= $user['username'] ?></td>
                                <td class="text-nowrap"><?= $user['balance'] ?></td>
                                <td class="text-nowrap"><?= $user['no_wa'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td class="text-nowrap"><?= $user['date_create'] ?></td>
                                <td class="text-nowrap">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['id'] ?>">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $user['id'] ?>">
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

<?php foreach ($users as $user) : ?>
    <div class="modal fade" id="editModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $user['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $user['id'] ?>">Edit User #<?= $user['username'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/user/edit/' . $user['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="balance" class="form-label">Balance</label>
                            <input type="text" class="form-control" id="balance" name="balance" value="<?= $user['balance'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No WhatsApp</label>
                            <input type="number" class="form-control" id="no_wa" name="no_wa" value="<?= $user['no_wa'] ?>" required>
                        </div>
                        <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" name="role" id="role">
                            <option value="1" <?= ($user['role'] == '1') ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= ($user['role'] == '2') ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>
                        <hr>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password baru">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?= $user['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel<?= $user['id'] ?>">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pengguna ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('admin/user/hapus/' . $user['id']) ?>" class="btn btn-danger btn- mx-1">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
</script>

<?= $this->endSection(); ?>