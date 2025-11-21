<?php
require_once 'backend_admin/Produk.php'; 

// Validasi ID
if (!isset($_GET['id'])) {
    header("Location: katalog.php");
    exit();
}

$produkObj = new Produk();
$id_produk = $_GET['id'];

// 1. Ambil Data Produk
$produk = $produkObj->getById($id_produk);

if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='katalog.php';</script>";
    exit();
}

// 2. Hitung Rating
$total_score = $produk['total_score'];
$total_reviewers = $produk['total_reviewers'];
$avg_rating = ($total_reviewers > 0) ? round($total_score / $total_reviewers, 1) : 0;

// 3. Ambil Gambar
$rawImages = $produkObj->getImages($id_produk);
$gambarProduk = [];
if (!empty($rawImages)) {
    foreach ($rawImages as $img) {
        $gambarProduk[] = $img['nama_file'];
    }
}
if (empty($gambarProduk)) { 
    $gambarProduk[] = 'no-image.png'; 
}

// 4. Ambil Produk Lainnya
$resultLainnya = $produkObj->getRelated($id_produk);

$varianList = !empty($produk['varian']) ? explode(',', $produk['varian']) : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama']); ?> - Detail Produk</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css01/detail-produk.css?v=<?= time(); ?>" rel="stylesheet">
</head>

<body>

    <?php 
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
        include 'header.php'; 
    } else {
        include 'header2.php'; 
    }
    ?>

    <div class="detail-container">
        
        <div class="product-layout">
            
            <div class="gallery-area">
                <div class="main-img-frame">
                    <img src="gambar_produk/<?= $gambarProduk[0]; ?>" id="mainImage" alt="Produk">
                </div>
                <?php if (count($gambarProduk) > 1): ?>
                <div class="thumb-row">
                    <?php foreach ($gambarProduk as $img): ?>
                        <img src="gambar_produk/<?= $img; ?>" class="thumb-item" onclick="changeImage(this)">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="info-area">
                <a href="wishlist.php" class="wishlist-top-btn">
                    <i class="bi bi-bag-heart"></i> Lihat Wishlist
                </a>

                <h1 class="prod-title"><?= htmlspecialchars($produk['nama']); ?></h1>
                
                <div class="meta-info">
                    <span class="stock-badge">Stok <?= $produk['stok']; ?>+</span>
                    
                    <?php 
                    // Cek status user
                    $is_logged_in = isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli';
                    $user_has_rated = false;
                    if ($is_logged_in) {
                        $user_id = $_SESSION['id_user'];
                        $user_has_rated = $produkObj->hasRated($id_produk, $user_id);
                    }
                    ?>

                    <?php if (!$is_logged_in): ?>
                        <span class="rating-text" onclick="alert('Silakan login sebagai Pembeli untuk memberi ulasan!'); window.location.href='login.php';" title="Login untuk review">
                            <i class="bi bi-star-fill text-warning" style="color:#ffc107;"></i> 
                            <strong><?= $avg_rating; ?></strong> (<?= $total_reviewers; ?> ulasan) 
                            <small style="text-decoration: underline; font-size: 0.8rem; color: #999;">Login untuk Review</small>
                        </span>
                    <?php elseif ($user_has_rated): ?>
                        <span class="rating-text" style="cursor: default; opacity: 1;" title="Anda sudah menilai">
                            <i class="bi bi-star-fill text-warning" style="color:#ffc107;"></i> 
                            <strong><?= $avg_rating; ?></strong> (<?= $total_reviewers; ?> ulasan) 
                            <small style="font-size: 0.8rem; color: #28a745; font-weight:bold;">✓ Anda sudah menilai</small>
                        </span>
                    <?php else: ?>
                        <span class="rating-text" onclick="openRatingModal()" title="Klik untuk beri ulasan">
                            <i class="bi bi-star-fill text-warning" style="color:#ffc107;"></i> 
                            <strong><?= $avg_rating; ?></strong> (<?= $total_reviewers; ?> ulasan) 
                            <small style="text-decoration: underline; font-size: 0.8rem; color: #AE4C02;">Beri Ulasan</small>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="prod-price">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></div>

                <div class="divider-line"></div>

                <div class="info-split-layout">
                    
                    <div class="info-left-col">
                        <?php if (!empty($varianList) && $varianList[0] != ''): ?>
                            <div style="margin-bottom: 20px;">
                                <p style="font-weight:600; margin-bottom:8px;">Pilih Varian:</p>
                                <div style="display:flex; gap:10px;">
                                    <?php foreach ($varianList as $v): ?>
                                        <button class="variant-btn" onclick="selectVariant(this)"><?= trim($v); ?></button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="desc-box">
                            <h4>Deskripsi Produk</h4>
                            <p><?= nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>
                        </div>
                    </div>

                    <div class="info-right-col">
                        
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;">
                            <span style="font-weight:600;">Jumlah:</span>
                            <div style="display:flex; align-items:center; border:1px solid #ccc; border-radius:50px; padding:5px; background:white;">
                                <button onclick="updateQty(-1)" style="background:none; border:none; font-size:1.2rem; cursor:pointer; color:#555; padding:0 10px;">-</button>
                                <input type="text" id="qtyValue" value="1" readonly style="width:30px; text-align:center; border:none; font-weight:bold; font-size:1rem; outline:none;">
                                <button onclick="updateQty(1)" style="background:none; border:none; font-size:1.2rem; cursor:pointer; color:#AE4C02; padding:0 10px;">+</button>
                            </div>
                        </div>
                        <a href="#" target="_blank" class="btn-wa-order" id="btnWa">
                            <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                        </a>
                        
                        <button class="btn-add-wishlist">
                            <i class="bi bi-bag-heart-fill"></i> Masukan Wishlist
                        </button>
                    </div>

                </div> 
            </div>
        </div>

        <div class="related-section">
            <h3 class="related-title">Produk Lainnya</h3>
            <div class="related-grid-wrapper">
                <button class="scroll-btn left" onclick="scrollRelated(-1)"><i class="bi bi-chevron-left"></i></button>
                
                <div class="related-grid" id="relatedGrid">
                    <?php while ($lain = $resultLainnya->fetch_assoc()): ?>
                        <?php $imgLain = !empty($lain['gambar']) ? 'gambar_produk/' . $lain['gambar'] : 'assets/no-image.png'; ?>
                        <a href="detail-produk.php?id=<?= $lain['id_produk']; ?>" class="related-card">
                            <img src="<?= $imgLain; ?>" alt="<?= htmlspecialchars($lain['nama']); ?>">
                            <h5 class="mt-2 mb-1" style="font-family:'Playfair Display', serif; font-weight:700;"><?= htmlspecialchars($lain['nama']); ?></h5>
                            <div class="text-danger fw-bold">Rp <?= number_format($lain['harga'], 0, ',', '.'); ?></div>
                        </a>
                    <?php endwhile; ?>
                </div>
                <button class="scroll-btn right" onclick="scrollRelated(1)"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

    </div>

    <div id="ratingModal" class="modal-overlay">
        <div class="modal-rating-box">
            <span class="close-modal" onclick="closeRatingModal()">&times;</span>
            <h3>Beri Penilaian</h3>
            <form id="formRating">
                <input type="hidden" name="id_produk" value="<?= $id_produk; ?>">
                <div class="star-input">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"><i class="bi bi-star-fill"></i></label>
                </div>
                <input type="text" name="kode_review" class="input-kode" placeholder="Kode: KUE123" required>
                <button type="submit" class="btn-submit-rating">Kirim Ulasan</button>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function changeImage(element) {
            document.getElementById('mainImage').src = element.src;
            document.querySelectorAll('.thumb-item').forEach(img => img.style.borderColor = '#ddd');
            element.style.borderColor = '#AE4C02';
        }
        function selectVariant(btn) {
            document.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        function scrollRelated(dir) {
            document.getElementById('relatedGrid').scrollBy({ left: dir * 240, behavior: 'smooth' });
        }
        function openRatingModal() { document.getElementById('ratingModal').style.display = 'flex'; }
        function closeRatingModal() { document.getElementById('ratingModal').style.display = 'none'; }

        // [BARU] LOGIKA COUNTER & WHATSAPP
        let currentQty = 1;
        const qtyInput = document.getElementById('qtyValue');
        const btnWa = document.getElementById('btnWa');
        const productName = "<?= urlencode($produk['nama']); ?>";
        const phoneNumber = "628123456789"; // Ganti nomor WA Anda disini

        function updateQty(amount) {
            let newQty = currentQty + amount;
            if (newQty < 1) newQty = 1;
            currentQty = newQty;
            qtyInput.value = currentQty;
            updateWaLink();
        }

        function updateWaLink() {
            const text = `Halo saya mau pesan ${productName} sebanyak ${currentQty} pcs.`;
            btnWa.href = `https://wa.me/${phoneNumber}?text=${text}`;
        }
        
        // Jalankan sekali saat load
        updateWaLink();

        document.getElementById('formRating').addEventListener('submit', function(e) {
            e.preventDefault();
            const rating = document.querySelector('input[name="rating"]:checked');
            if (!rating) { alert("Silakan pilih jumlah bintang!"); return; }
            const formData = new FormData(this);
            fetch('backend_admin/submit-rating.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') { closeRatingModal(); location.reload(); }
            })
            .catch(error => { console.error('Error:', error); alert("Terjadi kesalahan koneksi."); });
        });
        let selectedVariant = ""; 

    // Fungsi saat tombol varian diklik
    function selectVariant(btn) {
        // Reset semua tombol
        document.querySelectorAll('.variant-btn').forEach(b => b.classList.remove('active'));
        // Aktifkan tombol yang diklik
        btn.classList.add('active');
        // Simpan nilai text tombol ke variabel
        selectedVariant = btn.innerText;
    }

    // --- LOGIKA TAMBAH KE WISHLIST ---
    const btnWishlist = document.querySelector('.btn-add-wishlist');
    
    // Cek apakah produk ini punya varian? (Dari PHP)
    const hasVariants = <?= (!empty($varianList) && $varianList[0] != '') ? 'true' : 'false'; ?>;

    btnWishlist.addEventListener('click', function() {
        // 1. Validasi Varian
        if (hasVariants && selectedVariant === "") {
            alert("Harap pilih varian rasa terlebih dahulu!");
            return;
        }

        // 2. Siapkan Data
        const formData = new FormData();
        formData.append('action', 'add');
        formData.append('id_produk', '<?= $id_produk; ?>');
        formData.append('qty', currentQty); // Dari variabel global counter
        formData.append('varian', selectedVariant);

        // 3. Kirim AJAX
        // Ubah teks tombol biar user tau lagi loading
        const originalText = btnWishlist.innerHTML;
        btnWishlist.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
        btnWishlist.disabled = true;

        fetch('backend_admin/wishlist-action.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message); // "Berhasil masuk wishlist"
                // Opsional: Arahkan ke halaman wishlist
                // window.location.href = 'wishlist.php'; 
            } else {
                alert(data.message); // Pesan error (misal: belum login)
                if(data.message.includes('login')) {
                    window.location.href = 'login.php';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan koneksi.");
        })
        .finally(() => {
            // Balikin tombol ke semula
            btnWishlist.innerHTML = originalText;
            btnWishlist.disabled = false;
        });
    });
    </script>

</body>
</html>