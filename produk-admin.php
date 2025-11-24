<?php 
require_once 'backend/models/Produk.php';

// Inisialisasi Object (Otomatis cek login di constructor)
$produkObj = new Produk();
$produkObj->checkAuth();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Rumah Que Que</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css01/dash.css">
</head>

<body>
<div class="container">

    <div class="page-title">
        <a href="admin-dashboard.php"><i class="bi bi-arrow-left"></i></a>
        <h3>Edit Produk</h3>
    </div>

    <div class="d-flex align-items-center gap-3 mb-3">
        <h3 class="m-0">Produk</h3>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Konten +</button>
        <button type="button" class="btn btn-danger" id="btnDelete">Hapus Terpilih</button>
    </div>

    <div class="mb-3">
        <input type="checkbox" id="select-all"> Select All
    </div>

    <div class="top-controls">
        <div class="top-left"></div>
        <div class="top-center">
            <select id="filterKategori" class="form-select">
                <option value="">Semua Kategori</option>
                <option value="makanan">Makanan</option>
                <option value="kue">Kue</option>
                <option value="minuman">Minuman</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
        <div class="top-right"></div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="backend/controllers/produk-insert.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header custom-header">
                        <a href="#" class="modal-back-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <h5 class="modal-title">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Foto Produk (bisa lebih dari 1)</label>
                            <input type="file" name="gambar[]" class="form-control" accept="image/*" multiple required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Review (Opsional)</label>
                            <input type="text" name="kode_review" class="form-control" 
                                   placeholder="Isi manual (8 karakter) atau biarkan kosong untuk auto-generate" 
                                   maxlength="8">
                            <small class="text-muted">Contoh: PROMO001. Jika kosong, sistem akan membuatnya otomatis.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Varian</label>
                            <input type="text" name="varian" class="form-control" placeholder="Contoh: Pedas, Original, 500gr, dll.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="makanan">Makanan</option>
                                <option value="kue">Kue</option>
                                <option value="minuman">Minuman</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_bestseller" value="Yes" id="checkBestseller">
                            <label class="form-check-label" for="checkBestseller">
                                Tandai Best Seller
                            </label>
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

    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="editContent">
                <div class="p-5 text-center text-muted">
                    <div class="spinner-border"></div>
                    <p class="mt-3">Memuat data...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table id="produkTable" class="table align-middle">
            <thead>
                <tr>
                    <th></th> <th></th> <th class="d-none"></th> <th></th> </tr>
            </thead>
            <tbody>
            <?php
            // Ambil data menggunakan Method Class Produk
            $query = "SELECT * FROM produk ORDER BY id_produk DESC";
            $result = $produkObj->query($query);

            while ($row = $result->fetch_assoc()) {
                $id = $row['id_produk'];
                // Ambil 1 gambar
                $gbrQuery = "SELECT nama_file FROM produk_gambar WHERE id_produk='$id' LIMIT 1";
                $gbrResult = $produkObj->query($gbrQuery);
                $gambar = $gbrResult->fetch_assoc();
                
                $imgPath = $gambar ? 'gambar_produk/'.$gambar['nama_file'] : 'no-image.png';
            ?>
            <tr>
                <td class="checkbox-cell">
                    <input type="checkbox" class="cb-product" value="<?= $row['id_produk']; ?>">
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= $imgPath; ?>" class="product-img" alt="gambar">
                        <div>
                            <div class="product-title"><?= htmlspecialchars($row['nama']); ?></div>
                            <div class="product-date">
                                ID: <?= $row['id_produk']; ?> | 
                                <span style="color:#ae4c02; font-weight:bold;">Kode: <?= htmlspecialchars($row['kode_review']); ?></span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="d-none kategori"><?= strtolower($row['kategori']); ?></td>
                <td class="td-action">
                    <div class="edit-container">
                        <div class="last-edit">
                            <div>Terakhir edit :</div>
                            <div><?= htmlspecialchars($row['terakhir_edit']); ?></div>
                        </div>
                        <button class="edit-btn"
                            data-id="<?= $row['id_produk']; ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit">EDIT</button>
                    </div>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div> 

// Form untuk mengirim data produk yang akan dihapus
<form id="deleteForm" action="backend/controllers/produk-delete.php" method="POST">
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
    let table = $('#produkTable').DataTable({
        "lengthMenu": [5, 10, 25, 50],
        "ordering": false,
        "columnDefs": [ { "orderable": false, "targets": "_all" } ],
        "language": { "search": "", "searchPlaceholder": "Cari" },
        initComplete: function () {
            setTimeout(function () {
                let wrapper = $('#produkTable').parents('.dataTables_wrapper');
                let lengthBox = wrapper.find('.dataTables_length');
                let searchBox = wrapper.find('.dataTables_filter');
                if (lengthBox.length) $('.top-left').empty().append(lengthBox);
                if (searchBox.length) $('.top-right').empty().append(searchBox);

                lengthBox.css({"display": "flex", "align-items": "center", "margin": "0"});
                searchBox.css({"display": "flex", "align-items": "center", "margin": "0"});
            }, 5);
        }
    });

    $('#filterKategori').on('change', function () { table.draw(); });

    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        let selected = $('#filterKategori').val().toLowerCase();
        let kategori = (data[2] || "").toLowerCase();
        if (selected === "") return true;
        return kategori === selected;
    });

    $("#select-all").click(function() { $(".cb-product").prop('checked', this.checked); });

    $('#modalEdit').on('show.bs.modal', function(event) {
        let id = $(event.relatedTarget).data('id');
        $('#editContent').html('<div class="p-5 text-center text-muted"><div class="spinner-border"></div><p class="mt-3">Memuat data...</p></div>');
        $.get('backend/views/produk-edit.php', { id: id }, function(data) {
            $('#editContent').html(data);
        });
    });

    $("#btnDelete").click(function() {
        let selected = [];
        $(".cb-product:checked").each(function() { selected.push($(this).val()); });
        if (selected.length === 0) { alert("Tidak ada produk yang dipilih."); return; }
        if (confirm("Yakin ingin menghapus " + selected.length + " produk?")) {
            $("#delete_ids").val(JSON.stringify(selected));
            $("#deleteForm").submit();
        }
    });
    
    $(document).on('click', '.btn-hapus-gambar', function() {
        if (!confirm('Yakin ingin menghapus gambar ini?')) return;
        let btn = $(this);
        let id_gambar = btn.data('id');
        let container = btn.closest('.img-container'); 

        $.get('backend/controllers/produk-delete-gambar.php', { id_gambar: id_gambar }, function(response) {
            if (response.status === 'success') {
                container.fadeOut(300, function() { $(this).remove(); });
            } else {
                alert('Gagal menghapus gambar: ' + (response.message || 'Error tidak diketahui'));
            }
        }, 'json');
    });

    $(document).on('submit', '#form-edit-produk', function(e) {
        e.preventDefault(); 
        let formData = new FormData(this);
        let submitBtn = $(this).find('.btn-simpan-custom');
        submitBtn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: 'backend/controllers/produk-update.php', 
            type: 'POST',
            data: formData,
            processData: false, 
            contentType: false, 
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#modalEdit').modal('hide');
                    alert('Produk berhasil diperbarui!');
                    location.reload(); 
                } else {
                    alert('Gagal menyimpan perubahan.');
                    submitBtn.prop('disabled', false).text('Simpan Perubahan');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Terjadi kesalahan: ' + textStatus);
                submitBtn.prop('disabled', false).text('Simpan Perubahan');
            }
        });
    });
});
</script>
</body>
</html>