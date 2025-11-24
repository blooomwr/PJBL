<?php 
// Pastikan file 'katalog-logic.php' ada di folder yang sama dengan file ini
require 'backend/controllers/katalog-logic.php'; 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Rumah Que-Que</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&display=swap" rel="stylesheet">
    
    <link href="css01/katalog.css" rel="stylesheet">
</head>

<body>

    <?php 
    // Logika Header Login/Belum Login
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
        include 'header.php'; 
    } else {
        include 'header2.php'; 
    }
    ?>

    <main>
        <form action="" method="GET" class="catalog-controls-form">
            
            <div class="filter-section">
                
                <select name="kategori" class="custom-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="makanan" <?= $kategoriFilter == 'makanan' ? 'selected' : '' ?>>Makanan</option>
                    <option value="kue" <?= $kategoriFilter == 'kue' ? 'selected' : '' ?>>Kue</option>
                    <option value="minuman" <?= $kategoriFilter == 'minuman' ? 'selected' : '' ?>>Minuman</option>
                    <option value="lainnya" <?= $kategoriFilter == 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>

                <select name="sort" class="custom-select" onchange="this.form.submit()">
                    <option value="terbaru" <?= $sortFilter == 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
                    <option value="terlama" <?= $sortFilter == 'terlama' ? 'selected' : '' ?>>Terlama</option>
                    <option value="harga_rendah" <?= $sortFilter == 'harga_rendah' ? 'selected' : '' ?>>Harga Terendah</option>
                    <option value="harga_tinggi" <?= $sortFilter == 'harga_tinggi' ? 'selected' : '' ?>>Harga Tertinggi</option>
                    <option value="nama_az" <?= $sortFilter == 'nama_az' ? 'selected' : '' ?>>Nama (A-Z)</option>
                </select>
            </div>

            <div class="right-section">
                <a href="wishlist.php" class="wishlist-btn">
                    <i class="bi bi-bag-heart"></i>
                    Lihat Wishlist
                </a>

                <div class="search-box">
                    <button type="submit"><i class="bi bi-search"></i></button>
                    <input type="text" name="cari" placeholder="Cari produk..." value="<?= htmlspecialchars($keyword) ?>">
                </div>
            </div>
        </form>

        <div class="catalog-header">
            <h1 class="catalog-title">Produk Kami</h1>
        </div>

        <div class="products-grid">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php 
                        // Tentukan gambar, jika tidak ada gunakan default
                        $imgSrc = !empty($row['gambar']) ? 'gambar_produk/' . $row['gambar'] : 'assets/no-image.png';
                        $isBestSeller = ($row['is_bestseller'] === 'Yes');
                    ?>
                    
                    <a href="detail-produk.php?id=<?= $row['id_produk']; ?>" style="text-decoration: none; color: inherit;">
                        <div class="product-card">
                            <div class="product-image-container">
                                
                                <?php if ($isBestSeller): ?>
                                    <div class="best-seller-badge">
                                        <img src="assets/bestseller.png" alt="Best Seller" class="best-seller-img">
                                    </div>
                                <?php endif; ?>

                                <img src="<?= $imgSrc; ?>" alt="<?= htmlspecialchars($row['nama']); ?>" class="product-image">
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-name"><?= htmlspecialchars($row['nama']); ?></h3>
                                <p class="product-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </a>

                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center" style="grid-column: 1 / -1; padding: 50px;">
                    <h3 class="text-muted">Produk tidak ditemukan.</h3>
                    <p>Coba ganti kata kunci pencarian atau filter kategori.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php 
                    // Mempertahankan filter saat pindah halaman
                    $params = $_GET;
                    $params['page'] = $i;
                    $link = '?' . http_build_query($params);
                ?>
                <a href="<?= $link; ?>" class="page-link <?= $i == $page ? 'active' : ''; ?>">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>

    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>