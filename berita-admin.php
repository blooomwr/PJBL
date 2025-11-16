<?php 
include 'backend_admin/conn.php'; 
session_start(); // Tambahkan ini

// Cek apakah admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita - Rumah Que Que</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="dash.css">

    <style>
        /* ===================================
           STYLE KHUSUS UNTUK TABEL BERITA
           (Meniru style #produkTable)
        ====================================== */
        #beritaTable thead {
            display: none;
        }
        #beritaTable tbody tr {
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
        #beritaTable tbody td { 
            background: transparent !important; 
            border: none !important; 
            padding: 0 10px !important; 
            align-items:center; 
        }
        #beritaTable tbody td:nth-child(2) { flex: 1; } /* Kolom info mengambil ruang */

        /* ===================================
           STYLE MODAL & TOMBOL SIMPAN
           (Sudah ada di dash.css, tapi dicopy untuk jaga-jaga)
        ====================================== */
        .btn-simpan-custom {
            background-color: #FDB93D !important; border: none !important;
            color: #5c3a21 !important; font-weight: bold !important;
            padding: 10px 25px; font-size: 16px; border-radius: 12px !important;
        }
        .btn-simpan-custom:hover { background-color: #EAA937 !important; color: #5c3a21 !important; }
        .modal-content { border: none !important; border-radius: 20px !important; overflow: hidden; }
        .modal-header.custom-header {
            background-color: #FFEFD2 !important; border-bottom: none !important;
            justify-content: center !important; padding-top: 20px; padding-bottom: 20px;
            position: relative !important;
        }
        .modal-header.custom-header .modal-title { font-size: 24px; font-weight: 600; color: #000000; }
        .modal-header.custom-header .btn-close { display: none !important; }
        .modal-footer { border-top: none !important; }
        .modal-header .modal-back-btn {
            position: absolute; left: 20px; top: 50%; transform: translateY(-50%);
            font-size: 28px; color: #8a4b1e; text-decoration: none; padding: 5px;
        }
        .modal-header .modal-back-btn:hover { color: #5c3a21; }
    </style>
</head>

<body>
<div class="container">

    <div class="page-title">
        <a href="admin-dashboard.php"><i class="bi bi-arrow-left"></i></a>
        <h3>Edit Berita</h3>
    </div>

    <div class="d-flex align-items-center gap-3 mb-3">
        <h3 class="m-0">Berita</h3>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">Tambah Berita +</button>
        <button type="button" class="btn btn-danger" id="btnDeleteBerita">Hapus Terpilih</button>
    </div>

    <div class="mb-3">
        <input type="checkbox" id="select-all"> Select All
    </div>

    <div class="top-controls">
        <div class="top-left"></div> <div class="top-right"></div> </div>

    <div class="modal fade" id="modalTambahBerita" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="backend_admin/berita-insert.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="modal-header custom-header">
                        <a href="#" class="modal-back-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <h5 class="modal-title">Tambah Berita Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label class="form-label">Foto Berita (Hanya 1)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat (untuk di list)</label>
                            <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teks Berita Lengkap</label>
                            <textarea name="teks_berita" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_berita_utama" value="Yes" id="checkBeritaUtama">
                            <label class="form-check-label" for="checkBeritaUtama">
                                Jadikan berita utama (Berita utama saat ini akan otomatis terganti)
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

    <div class="modal fade" id="modalEditBerita" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="editBeritaContent">
                <div class="p-5 text-center text-muted">
                    <div class="spinner-border"></div>
                    <p class="mt-3">Memuat data...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table id="beritaTable" class="table align-middle">
            <thead>
                <tr>
                    <th></th> <th></th> <th></th> </tr>
            </thead>
            <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY terakhir_edit DESC");
            while ($row = mysqli_fetch_assoc($query)) {
                $imgPath = $row['foto'] ? 'gambar_berita/'.$row['foto'] : 'no-image.png';
            ?>
            <tr>
                <td class="checkbox-cell">
                    <input type="checkbox" class="cb-product" value="<?= $row['id_berita']; ?>">
                </td>

                <td>
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= $imgPath; ?>" class="product-img" alt="gambar">
                        <div>
                            <div class="product-title"><?= htmlspecialchars($row['judul']); ?></div>
                            <div class="product-date">
                                <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
                                <?php if($row['is_berita_utama'] == 'Yes') echo '<span class="badge bg-success ms-2">Berita Utama</span>'; ?>
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
                            data-id="<?= $row['id_berita']; ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditBerita">EDIT</button>
                    </div>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div> <form id="deleteForm" action="backend_admin/berita-delete.php" method="POST">
    <input type="hidden" name="ids" id="delete_ids">
</form>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {

    let table = $('#beritaTable').DataTable({
        "lengthMenu": [5, 10, 25, 50],
        "ordering": false,
        "columnDefs": [
            { "orderable": false, "targets": "_all" }
        ],
        "language": {
            "search": "", // Menghapus label "Search:"
            "searchPlaceholder": "Cari" // Menetapkan placeholder di dalam kotak
        },
        initComplete: function () {
            // ... (Kode DataTables Anda sudah benar) ...
            setTimeout(function () {
                let wrapper = $('#beritaTable').parents('.dataTables_wrapper');
                let lengthBox = wrapper.find('.dataTables_length');
                let searchBox = wrapper.find('.dataTables_filter');
                if (lengthBox.length) $('.top-left').empty().append(lengthBox);
                if (searchBox.length) $('.top-right').empty().append(searchBox);
            }, 5);
        }
    });

    // SELECT ALL
    $("#select-all").click(function() {
        $(".cb-product").prop('checked', this.checked);
    });

    // LOAD EDIT MODAL (Kode Anda sudah benar)
    $('#modalEditBerita').on('show.bs.modal', function(event) {
        let id = $(event.relatedTarget).data('id');
        $('#editBeritaContent').html('<div class="p-5 text-center text-muted"><div class="spinner-border"></div><p class="mt-3">Memuat data...</p></div>');
        $.get('backend_admin/berita-edit.php', { id: id }, function(data) {
            $('#editBeritaContent').html(data);
        });
    });

    // DELETE MULTIPLE (Kode Anda sudah benar)
    $("#btnDeleteBerita").click(function() {
        let selected = [];
        $(".cb-product:checked").each(function() { selected.push($(this).val()); });
        if (selected.length === 0) { alert("Tidak ada berita yang dipilih."); return; }
        if (confirm("Yakin ingin menghapus " + selected.length + " berita?")) {
            $("#delete_ids").val(JSON.stringify(selected));
            $("#deleteForm").submit();
        }
    });

    // ======================================================
    // (TAMBAHAN) AJAX UNTUK SIMPAN EDIT BERITA
    // ======================================================
    $(document).on('submit', '#form-edit-berita', function(e) {
        e.preventDefault(); // Hentikan form submit biasa

        let formData = new FormData(this);
        let submitBtn = $(this).find('.btn-simpan-custom');
        submitBtn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: 'backend_admin/berita-update.php', // Path ke file update
            type: 'POST',
            data: formData,
            processData: false, // Wajib untuk FormData
            contentType: false, // Wajib untuk FormData
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Tutup modal
                    $('#modalEditBerita').modal('hide');
                    // Refresh halaman utama untuk melihat perubahan
                    alert('Berita berhasil diperbarui!');
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