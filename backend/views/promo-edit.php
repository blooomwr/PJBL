<?php
require_once __DIR__ . '/../models/Promo.php';

// Inisialisasi Object
$promoObj = new Promo();
$promoObj->requireAdmin();
$id = $_GET['id'];

// Ambil Data Promo via Class
$promo = $promoObj->getById($id);
?>

<div class="modal-header custom-header">
  <a href="#" class="modal-back-btn" data-bs-dismiss="modal" aria-label="Close">
      <i class="bi bi-arrow-left"></i>
  </a>
  <h5 class="modal-title">Edit Promo</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="backend_admin/promo-update.php" method="POST" enctype="multipart/form-data" id="form-edit-promo">
  <div class="modal-body">
    <input type="hidden" name="id_promo" value="<?php echo $promo['id_promo']; ?>">
    <input type="hidden" name="gambar_lama" value="<?php echo $promo['gambar']; ?>">

    <h6>Gambar Promo Saat Ini</h6>
    <div class="mb-3">
        <?php 
        $imgPath = $promo['gambar'] ? 'gambar_promo/'.$promo['gambar'] : 'no-image.png'; 
        ?>
        <img src="<?php echo $imgPath; ?>" class="rounded" width="150" style="object-fit:cover;">
    </div>

    <div class="mb-3">
      <label class="form-label">Ganti Gambar (Opsional)</label>
      <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>
    <hr>

    <div class="mb-3">
      <label class="form-label">Nama Promo</label>
      <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($promo['nama']); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Kode Promo</label>
      <input type="text" name="kode_promo" class="form-control" maxlength="10" value="<?php echo htmlspecialchars($promo['kode_promo']); ?>" required>
    </div>

  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" name="update" class="btn btn-simpan-custom">Simpan Perubahan</button>
  </div>
</form>