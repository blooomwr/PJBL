<?php 
// Menggunakan Class Promo (OOP)
require_once 'backend/models/Promo.php'; 
$promoObj = new Promo();
$promoObj->requireAdmin();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Promo - Rumah Que Que</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="dash.css">

    <style>
        /* Style tabel ini meniru #produkTable */
        #promoTable thead {
            display: none;
        }
        #promoTable tbody tr {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            background: #fae2b4 !important;
            border-radius: 18px !important;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
            margin-bottom: 18px !important;
            padding: 14px 18px !important;
            border: none !important;
        }
        #promoTable tbody td { 
            background: transparent !important; 
            border: none !important; 
            padding: 0 10px !important; 
            align-items:center; 
        }
        #promoTable tbody td:nth-child(2) { flex: 1; }
    </style>
</head>

<body>
<div class="container">

    <div class="page-title">
        <a href="admin-dashboard.php"><i class="bi bi-arrow-left"></i></a>
        <h3>Edit Promo</h3>
    </div>

    <div class="d-flex align-items-center gap-3 mb-3">
        <h3 class="m-0">Promo</h3>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTambahPromo">Tambah Promo +</button>
        <button type="button" class="btn btn-danger" id="btnDeletePromo">Hapus Terpilih</button>
    </div>

    <div class="mb-3">
        <input type="checkbox" id="select-all"> Select All
    </div>

    <div class="top-controls">
        <div class="top-left"></div> <div class="top-right"></div> </div>

    <div class="modal fade" id="modalTambahPromo" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="backend/controllers/promo-insert.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header custom-header">
                        <a href="#" class="modal-back-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <h5 class="modal-title">Tambah Promo Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Promo</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Promo (Maks. 10 Karakter)</label>
                            <input type="text" name="kode_promo" class="form-control" maxlength="10" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Promo (Hanya 1)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-simpan-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditPromo" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="editPromoContent">
                <div class="p-5 text-center text-muted">
                    <div class="spinner-border"></div>
                    <p class="mt-3">Memuat data...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table id="promoTable" class="table align-middle">
            <thead>
                <tr>
                    <th></th> <th></th> <th></th> </tr>
            </thead>
            <tbody>
            <?php
            // === QUERY DATABASE ===
            $sql = "SELECT * FROM promo ORDER BY terakhir_edit DESC";
            $result = $promoObj->query($sql); 

            while ($row = $result->fetch_assoc()) {
                $imgPath = $row['gambar'] ? 'gambar_promo/'.$row['gambar'] : 'no-image.png';
            ?>
            <tr>
                <td class="checkbox-cell">
                    <input type="checkbox" class="cb-product" value="<?= $row['id_promo']; ?>">
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= $imgPath; ?>" class="product-img" alt="gambar">
                        <div>
                            <div class="product-title"><?= htmlspecialchars($row['nama']); ?></div>
                            
                            <div class="small text-muted">
                                Kode: <span style="color:#ae4c02; font-weight:bold;"><?= htmlspecialchars($row['kode_promo']); ?></span>
                            </div>
                            
                        </div>
                    </div>
                </td>

                <td class="td-action">
                    <div class="edit-container">
                        <div class="last-edit">
                            <div>Terakhir edit :</div>
                            <div><?= htmlspecialchars($row['terakhir_edit']); ?></div>
                        </div>

                        <button class="edit-btn"
                            data-id="<?= $row['id_promo']; ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditPromo">EDIT</button>
                    </div>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div> <form id="deleteForm" action="backend/controllers/promo-delete.php" method="POST">
    <input type="hidden" name="ids" id="delete_ids">
</form>

<?php include 'footer.php'; ?>


// Skrip JS
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {

    let table = $('#promoTable').DataTable({
        "lengthMenu": [5, 10, 25, 50],
        "ordering": false,
        "columnDefs": [ { "orderable": false, "targets": "_all" } ],
        "language": { "search": "", "searchPlaceholder": "Cari" },
        initComplete: function () {
            setTimeout(function () {
                let wrapper = $('#promoTable').parents('.dataTables_wrapper');
                let lengthBox = wrapper.find('.dataTables_length');
                let searchBox = wrapper.find('.dataTables_filter');
                if (lengthBox.length) $('.top-left').empty().append(lengthBox);
                if (searchBox.length) $('.top-right').empty().append(searchBox);
            }, 5);
        }
    });

    $("#select-all").click(function() {
        $(".cb-product").prop('checked', this.checked);
    });

    $('#modalEditPromo').on('show.bs.modal', function(event) {
        let id = $(event.relatedTarget).data('id');
        $('#editPromoContent').html('<div class="p-5 text-center text-muted"><div class="spinner-border"></div><p class="mt-3">Memuat data...</p></div>');
        $.get('backend/views/promo-edit.php', { id: id }, function(data) {
            $('#editPromoContent').html(data);
        });
    });

    $("#btnDeletePromo").click(function() {
        let selected = [];
        $(".cb-product:checked").each(function() { selected.push($(this).val()); });
        if (selected.length === 0) { alert("Tidak ada promo yang dipilih."); return; }
        if (confirm("Yakin ingin menghapus " + selected.length + " promo?")) {
            $("#delete_ids").val(JSON.stringify(selected));
            $("#deleteForm").submit();
        }
    });

    // AJAX UNTUK SIMPAN EDIT PROMO
    $(document).on('submit', '#form-edit-promo', function(e) {
        e.preventDefault(); 
        let formData = new FormData(this);
        let submitBtn = $(this).find('.btn-simpan-custom');
        submitBtn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: 'backend/controllers/promo-update.php', 
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#modalEditPromo').modal('hide');
                    alert('Promo berhasil diperbarui!');
                    location.reload(); 
                } else {
                    alert('Gagal menyimpan perubahan.');
                    submitBtn.prop('disabled', false).text('Simpan Perubahan');
                }
            },
            error: function() {
                alert('Terjadi kesalahan. Gagal terhubung ke server.');
                submitBtn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });

});
</script>

</body>
</html>