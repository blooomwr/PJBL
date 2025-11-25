<?php
require_once __DIR__ . '/../models/Produk.php';

// Inisialisasi Object
$produkObj = new Produk();
$produkObj->checkAuth();
$id = $_GET['id'];

// Ambil Data Produk & Gambar
$produk = $produkObj->getById($id);
$gambarList = $produkObj->getImages($id);
$varianArray = $produkObj->getVarians($id);
$varianString = implode(', ', $varianArray);
?>
<div class="modal-header custom-header">
  <a href="#" class="modal-back-btn" data-bs-dismiss="modal" aria-label="Close">
      <i class="bi bi-arrow-left"></i>
  </a>
  <h5 class="modal-title">Edit Produk</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<form action="backend/controllers/produk-update.php" method="POST" enctype="multipart/form-data" id="form-edit-produk">
  <div class="modal-body">
    <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">

    <h6>Gambar Produk Saat Ini</h6>
    <div class="d-flex flex-wrap gap-3 mt-2 mb-3">
      <?php
      if (!empty($gambarList)) {
        foreach ($gambarList as $g) {
          echo '
          <div class="position-relative img-container">
            <img src="gambar_produk/'.$g['nama_file'].'" class="rounded" width="100" height="100" style="object-fit:cover;">
            
            <button type="button" 
               class="btn btn-sm btn-danger position-absolute top-0 end-0 btn-hapus-gambar" 
               data-id="'.$g['id_gambar'].'"
               style="border-radius:50%; padding:3px 7px;" title="Hapus Gambar">
               <i class="bi bi-x"></i>
            </button>
          </div>';
        }
      } else {
        echo '<p class="text-muted">Belum ada gambar.</p>';
      }
      ?>
    </div>

    <div class="mb-3">
      <label class="form-label">Tambah Gambar Baru (opsional)</label>
      <input type="file" name="gambar[]" class="form-control" accept="image/*" multiple>
    </div>
    <hr>
    
    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($produk['nama']); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Kode Review</label>
      <input type="text" name="kode_review" class="form-control" 
             value="<?php echo htmlspecialchars($produk['kode_review']); ?>" 
             maxlength="8" style="text-transform: uppercase; font-weight: bold; color: #AE4C02;" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Harga (Rp)</label>
      <input type="number" name="harga" class="form-control" value="<?php echo $produk['harga']; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Varian</label>
      <input type="text" name="varian" class="form-control" 
             value="<?php echo htmlspecialchars($varianString); ?>" 
             placeholder="Contoh: Pedas, Original, 500gr (Pisahkan dengan koma)">
    </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select">
        <option value="makanan" <?php if($produk['kategori']=='makanan') echo 'selected'; ?>>Makanan</option>
        <option value="kue" <?php if($produk['kategori']=='kue') echo 'selected'; ?>>Kue</option>
        <option value="minuman" <?php if($produk['kategori']=='minuman') echo 'selected'; ?>>Minuman</option>
        <option value="lainnya" <?php if($produk['kategori']=='lainnya') echo 'selected'; ?>>Lainnya</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="3"><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Stok</label>
      <input type="number" name="stok" class="form-control" value="<?php echo $produk['stok']; ?>" required>
    </div>

    <div class="form-check mb-3">
      <?php $isChecked = ($produk['is_bestseller'] == 'Yes') ? 'checked' : ''; ?>
      <input class="form-check-input" type="checkbox" name="is_bestseller" value="Yes" id="checkBestsellerEdit" <?php echo $isChecked; ?>>
      <label class="form-check-label" for="checkBestsellerEdit">
        Tandai Best Seller
      </label>
    </div>

  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" name="update" class="btn btn-simpan-custom">Simpan Perubahan</button>
  </div>
</form>