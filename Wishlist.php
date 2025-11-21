<?php
// 1. Mulai Sesi Manual
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Cek Login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pembeli') {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit();
}

// 3. Panggil Backend
require_once 'backend_admin/Wishlist.php'; 
require_once 'backend_admin/Produk.php'; 
require_once 'backend_admin/Promo.php'; 

$wishlistObj = new Wishlist();
$produkObj = new Produk();
$promoObj = new Promo();

$id_user = $_SESSION['id_user'];

if (isset($_GET['remove'])) {
    $wishlistObj->removeItem($_GET['remove']);
    header("Location: wishlist.php");
    exit();
}

// Filter Logic
$kategori = $_GET['kategori'] ?? '';
$sort = $_GET['sort'] ?? '';
$keyword = $_GET['cari'] ?? '';

$items = $wishlistObj->getUserWishlist($id_user, $keyword, $kategori, $sort);

// Checkout Logic
$totalHargaSemua = 0;
$waMessage = "Halo Admin Rumah Que-Que, saya ingin memesan:%0A%0A";
$hasItems = false;
$listItems = []; 

if ($items && $items->num_rows > 0) {
    while ($row = $items->fetch_assoc()) {
        $listItems[] = $row;
        $subtotal = $row['harga'] * $row['jumlah'];
        $totalHargaSemua += $subtotal;
        $varianText = !empty($row['varian']) ? " (" . $row['varian'] . ")" : "";
        $waMessage .= "- " . $row['nama'] . $varianText . " x " . $row['jumlah'] . " = Rp " . number_format($subtotal, 0, ',', '.') . "%0A";
        $hasItems = true;
    }
}
$waMessage .= "%0A*Total Pembayaran: Rp " . number_format($totalHargaSemua, 0, ',', '.') . "*";
$waMessage .= "%0A%0AMohon info nomor rekening untuk pembayaran. Terima kasih!";

// Data Tambahan
$randomProducts = $produkObj->query("SELECT p.*, (SELECT nama_file FROM produk_gambar pg WHERE pg.id_produk = p.id_produk LIMIT 1) as gambar FROM produk p ORDER BY id_produk DESC LIMIT 4");
$listPromo = $promoObj->query("SELECT * FROM promo ORDER BY terakhir_edit DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya - Rumah Que Que</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&family=Inria+Serif:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="css01/wishlist.css?v=<?= time(); ?>" rel="stylesheet">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="wishlist-container">
        <h1 class="page-title">Wishlist-mu</h1>

        <form action="" method="GET" class="catalog-controls-form">
            <div class="filter-section">
                <select name="kategori" class="custom-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="makanan" <?= $kategori == 'makanan' ? 'selected' : '' ?>>Makanan</option>
                    <option value="kue" <?= $kategori == 'kue' ? 'selected' : '' ?>>Kue</option>
                    <option value="minuman" <?= $kategori == 'minuman' ? 'selected' : '' ?>>Minuman</option>
                </select>

                <select name="sort" class="custom-select" onchange="this.form.submit()">
                    <option value="">Urut Berdasarkan</option>
                    <option value="terbaru" <?= $sort == 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
                    <option value="harga_rendah" <?= $sort == 'harga_rendah' ? 'selected' : '' ?>>Harga Terendah</option>
                    <option value="harga_tinggi" <?= $sort == 'harga_tinggi' ? 'selected' : '' ?>>Harga Tertinggi</option>
                </select>
            </div>

            <div class="search-box">
                <button type="submit"><i class="bi bi-search"></i></button>
                <input type="text" name="cari" placeholder="Cari di wishlist..." value="<?= htmlspecialchars($keyword); ?>">
            </div>
        </form>

        <div class="products-grid">
            <?php if ($hasItems): ?>
                <?php foreach ($listItems as $item): ?>
                    <?php $img = !empty($item['gambar']) ? 'gambar_produk/'.$item['gambar'] : 'assets/no-image.png'; ?>
                    
                    <div class="product-card">
                        <a href="detail-produk.php?id=<?= $item['id_produk']; ?>" class="product-link">
                            <div class="product-image-container">
                                <img src="<?= $img; ?>" alt="<?= htmlspecialchars($item['nama']); ?>" class="product-image">
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-name"><?= htmlspecialchars($item['nama']); ?></h3>
                                <?php if (!empty($item['varian'])): ?>
                                    <p class="product-variant">Varian: <?= htmlspecialchars($item['varian']); ?></p>
                                <?php else: ?>
                                    <p class="product-variant" style="visibility:hidden;">-</p>
                                <?php endif; ?>
                                <p class="product-price">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </a>

                        <div class="wishlist-actions">
                            <div class="qty-control">
                                <button onclick="updateQty(<?= $item['id_detail']; ?>, -1)">-</button>
                                <span id="qty-<?= $item['id_detail']; ?>"><?= $item['jumlah']; ?></span>
                                <button onclick="updateQty(<?= $item['id_detail']; ?>, 1)">+</button>
                            </div>

                            <a href="wishlist.php?remove=<?= $item['id_detail']; ?>" class="btn-delete" onclick="return confirm('Hapus dari wishlist?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align:center; padding:50px; color:#888;">
                    <h3>Wishlist tidak ditemukan.</h3>
                    <a href="katalog.php" style="color:#AE4C02; font-weight:bold; text-decoration:none; font-size:1.2rem;">Jelajahi Katalog &rarr;</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($hasItems): ?>
        <div class="wishlist-footer">
            <div class="total-price">Total: Rp <?= number_format($totalHargaSemua, 0, ',', '.'); ?></div>
            <a href="https://wa.me/6282115314179?text=<?= $waMessage; ?>" class="btn-checkout" target="_blank">
                <i class="bi bi-whatsapp"></i> Checkout via WhatsApp
            </a>
        </div>
        <?php endif; ?>

        <div style="max-width:1200px; margin:80px auto 20px; display:flex; justify-content:space-between; align-items:center;">
            <h2 style="font-family: 'Playfair Display', serif; color: #5c3317; margin:0;">Lihat Produk lain dari Que Que</h2>
            <a href="katalog.php" style="text-decoration:none; color:#AE4C02; font-weight:600;">Lihat Semua &rarr;</a>
        </div>

        <div class="products-grid">
            <?php while($rand = $randomProducts->fetch_assoc()): ?>
                <?php $imgRand = !empty($rand['gambar']) ? 'gambar_produk/'.$rand['gambar'] : 'assets/no-image.png'; ?>
                <div class="product-card">
                    <a href="detail-produk.php?id=<?= $rand['id_produk']; ?>" class="product-link">
                        <div class="product-image-container">
                            <img src="<?= $imgRand; ?>" class="product-image">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name"><?= htmlspecialchars($rand['nama']); ?></h3>
                            <p class="product-price">Rp <?= number_format($rand['harga'], 0, ',', '.'); ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <section class="promo">
          <div class="inner-wrapper">
            <div class="title">PROMO SAAT INI</div>
            <div class="carousel">
              <div class="arrow left" id="btnPrev"><i class="bi bi-arrow-left"></i></div>

              <div class="promo-carousel-container" id="promoContainer">
                <?php 
                if ($listPromo->num_rows > 0) {
                    while($promo = $listPromo->fetch_assoc()) {
                        $imgPromo = !empty($promo['gambar']) ? 'gambar_promo/'.$promo['gambar'] : 'assets/no-image.png';
                ?>
                    <div class="promo-card">
                        <img src="<?= $imgPromo; ?>">
                        <div><?= htmlspecialchars($promo['nama']); ?></div>
                    </div>
                <?php 
                    }
                } else {
                    echo '<p>Tidak ada promo saat ini.</p>';
                }
                ?>
              </div>

              <div class="arrow right" id="btnNext"><i class="bi bi-arrow-right"></i></div>
            </div>
          </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <script>
        function updateQty(id_detail, change) {
            fetch('backend_admin/wishlist-action.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=update&id=${id_detail}&change=${change}`
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    document.getElementById('qty-' + id_detail).innerText = data.newQty;
                    location.reload(); 
                }
            });
        }

        // Promo Scroll
        const container = document.getElementById('promoContainer');
        const btnPrev = document.getElementById('btnPrev');
        const btnNext = document.getElementById('btnNext');
        const scrollAmount = 320;

        if(btnNext && container) {
            btnNext.addEventListener('click', () => {
                container.scrollLeft += scrollAmount;
            });
            btnPrev.addEventListener('click', () => {
                container.scrollLeft -= scrollAmount;
            });
        }
    </script>

</body>
</html>