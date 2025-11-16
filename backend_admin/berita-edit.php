<?php
include 'conn.php';

// ================== PENJAGA KEAMANAN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Karena ini file AJAX, kita bisa tampilkan pesan error
    // atau tendang ke login
    // Pilihan 1: Tampilkan error
    die("Akses ditolak. Silakan login sebagai admin.");
    // Pilihan 2: Tendang (Mungkin tidak berfungsi baik di modal)
    // header("Location: ../login.php");
    // exit();
}
// ======================================================

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id'");
$berita = mysqli_fetch_assoc($query);
?>

<div class="modal-header custom-header">
  <a href="#" class="modal-back-btn" data-bs-dismiss="modal" aria-label="Close">
      <i class="bi bi-arrow-left"></i>
  </a>
  <h5 class="modal-title">Edit Berita</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="backend_admin/berita-update.php" method="POST" enctype="multipart/form-data" id="form-edit-berita">
  <div class="modal-body">
    <input type="hidden" name="id_berita" value="<?php echo $berita['id_berita']; ?>">
    <input type="hidden" name="foto_lama" value="<?php echo $berita['foto']; ?>">

    <h6>Foto Berita Saat Ini</h6>
    <div class="mb-3">
        <?php 
        $imgPath = $berita['foto'] ? 'gambar_berita/'.$berita['foto'] : 'no-image.png'; 
        ?>
        <img src="<?php echo $imgPath; ?>" class="rounded" width="150" style="object-fit:cover;">
    </div>

    <div class="mb-3">
      <label class="form-label">Ganti Foto (Opsional)</label>
      <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
    <hr>

    <div class="mb-3">
      <label class="form-label">Judul</label>
      <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($berita['judul']); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi Singkat</label>
      <textarea name="deskripsi" class="form-control" rows="2"><?php echo htmlspecialchars($berita['deskripsi']); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Teks Berita Lengkap</label>
      <textarea name="teks_berita" class="form-control" rows="5"><?php echo htmlspecialchars($berita['teks_berita']); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d', strtotime($berita['tanggal'])); ?>" required>
    </div>

    <div class="form-check mb-3">
      <?php $isChecked = ($berita['is_berita_utama'] == 'Yes') ? 'checked' : ''; ?>
      <input class="form-check-input" type="checkbox" name="is_berita_utama" value="Yes" id="checkBeritaUtamaEdit" <?php echo $isChecked; ?>>
      <label class="form-check-label" for="checkBeritaUtamaEdit">
        Jadikan berita utama (Berita utama saat ini akan otomatis terganti)
      </label>
    </div>

  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" name="update" class="btn btn-simpan-custom">Simpan Perubahan</button>
  </div>
</form>