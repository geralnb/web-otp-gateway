<?= $this->extend('template_admin'); ?>
<?= $this->section('content'); ?>

<div class="mt-3">
    <div class="card border-0 shadow">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
            <h4 class="fw-semibold">Data Services</h4>
          </div>
          
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="servicesTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Aplikasi</th>
                            <th scope="col">Harga Provider</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Service Update</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="#" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="service_id" id="editServiceId">
                    <div class="mb-3">
                        <label for="editServiceName" class="form-label">Aplikasi</label>
                        <input type="text" class="form-control" id="editServiceName" name="service_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPriceProvider" class="form-label">Harga Provider</label>
                        <input type="text" class="form-control" id="editPriceProvider" name="price_provider" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" id="editPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProfit" class="form-label">Profit</label>
                        <input type="number" class="form-control" id="editProfit" name="profit" required>
                    </div>                  
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data layanan ini?</p>
            </div>
            <form id="deleteForm" action="#" method="post">
                <?= csrf_field() ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var dataTable = $('#servicesTable').DataTable({
        "serverSide": true,
        "processing": true,
        "paging": true,
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "ajax": {
            "url": "<?php echo base_url('admin/get-data-services'); ?>",
            "type": "GET",
            "data": function(d) {
                d['<?= csrf_token() ?>'] = '<?= csrf_hash() ?>';
                d['start'] = d['start'] || 0;
                d['length'] = d['length'] || 10;
                d['draw'] = d['draw'] || 1;
            },
            "error": function(xhr, error, thrown) {
                console.log("Error:", error);
                console.log("XHR:", xhr);
                console.log("Thrown:", thrown);
                alert("Error fetching data. Please check console for details.");
            }
        },
        "columns": [
            { "data": null, "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "service_id" },
            { "data": "service_name" },
            { "data": "price_provider" },
            { "data": "price" },
            { "data": "profit" },
            { "data": "service_update" },
            { 
                "data": null, 
                "render": function (data, type, row) {
                    return `
                        <div class="text-nowrap">
                            <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="${row.service_id}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="${row.service_id}">
                                Delete
                            </button>
                        </div>
                    `;
                } 
            }
        ],
    });

    // Tambahkan event listener untuk input pencarian
    $('#searchField').on('keyup', function() {
        dataTable.search(this.value).draw();
    });

    $('#servicesTable tbody').on('click', '.edit-btn', function() {
        var data = dataTable.row($(this).parents('tr')).data();
        $('#editServiceName').val(data.service_name);
        $('#editPriceProvider').val(data.price_provider);
        $('#editPrice').val(data.price);
        $('#editProfit').val(data.profit);

        $('#editForm').attr('action', '<?= base_url('admin/services/update/'); ?>' + data.id);
    });

    $('#servicesTable tbody').on('click', '.delete-btn', function() {
        var data = dataTable.row($(this).parents('tr')).data();
        $('#deleteForm').attr('action', '<?= base_url('admin/services/delete/'); ?>' + data.id);
    });
});
</script>

<?= $this->endSection(); ?>