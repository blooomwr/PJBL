<?php
// Panggil Class Berita & Promo
require_once 'backend_admin/Berita.php'; 
require_once 'backend_admin/Promo.php'; // [BARU] Include Class Promo

$beritaObj = new Berita();
$promoObj = new Promo(); // [BARU] Inisialisasi Object Promo

// Cek login untuk header (Sama seperti sebelumnya)
if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
    include 'header.php'; 
} else {
    include 'header2.php'; 
}

// --- LOGIKA OOP UNTUK MENGAMBIL DATA ---

// 1. Ambil Berita Utama (Tetap pakai $beritaObj)
$q_main = $beritaObj->query("SELECT * FROM berita WHERE is_berita_utama = 'Yes' LIMIT 1");
$berita_utama = $q_main->fetch_assoc();

if (!$berita_utama) {
    $q_main = $beritaObj->query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT 1");
    $berita_utama = $q_main->fetch_assoc();
}

// 2. Ambil Promo (SEKARANG PAKAI $promoObj)
// Karena Class Promo belum punya method khusus 'getAll', kita pakai query manual lewat object-nya
// atau lebih bagus lagi, buat method getAll() di Class Promo.
$q_promo = $promoObj->query("SELECT * FROM promo ORDER BY terakhir_edit DESC");

// 3. Ambil Berita Lainnya (Tetap pakai $beritaObj)
$id_exclude = isset($berita_utama['id_berita']) ? $berita_utama['id_berita'] : '';
$q_news = $beritaObj->query("SELECT * FROM berita WHERE id_berita != '$id_exclude' ORDER BY tanggal DESC LIMIT 3");
function tgl_indo($tanggal){
	$bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berita - Rumah Que-Que</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css01/berita.css" rel="stylesheet">
  
  <style>
    /* === PERBAIKAN FONT (FORCE PLAYFAIR) === */
    header.header-container,
    header.header-container .nav-link,
    header.header-container .auth-links a {
        font-family: 'Playfair Display', serif !important;
    }

    h1, h2, h3, .title, .promo-card div {
        font-family: 'Playfair Display', serif !important;
    }

    /* === CSS LAINNYA === */
    .hero-right img {
        object-fit: cover;
        width: 100%;
        height: auto;
        max-height: 400px;
        border-radius: 12px;
    }

    .carousel {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        width: 100%;
        gap: 15px;
    }

    .promo-carousel-container {
        display: flex;
        gap: 30px; 
        overflow-x: auto; 
        scroll-behavior: smooth; 
        padding: 20px 10px;
        width: 100%;
        max-width: 1000px; 
        -ms-overflow-style: none;  
        scrollbar-width: none;  
    }
    
    .promo-carousel-container::-webkit-scrollbar { display: none; }

    .promo-card {
        min-width: 300px; 
        max-width: 300px;
        background-color: #fffaf3;
        border-radius: 100px; 
        padding: 30px 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        flex-shrink: 0; 
        transition: transform 0.3s;
    }

    .promo-card:hover { transform: translateY(-5px); }

    .promo-card img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .arrow {
        font-size: 2rem;
        color: #fff;
        cursor: pointer;
        z-index: 10;
        user-select: none;
        background-color: #8a4b1e;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .arrow:hover { background-color: #5c3a21; }
  </style>
</head>
<body>

  <main>
    <section class="hero">
      <?php if ($berita_utama): ?>
          <div class="hero-left">
            <h1><?php echo htmlspecialchars($berita_utama['judul']); ?></h1>
            <div class="meta"><?php echo tgl_indo($berita_utama['tanggal']); ?></div>
            <p><?php echo htmlspecialchars($berita_utama['deskripsi']); ?></p>
          </div>
          <div class="hero-right">
            <?php $imgHero = !empty($berita_utama['foto']) ? 'gambar_berita/'.$berita_utama['foto'] : 'img01/default-news.png'; ?>
            <img src="<?php echo $imgHero; ?>" alt="Hero Image">
          </div>
      <?php else: ?>
          <div class="hero-left"><h1>Belum ada berita.</h1></div>
      <?php endif; ?>
    </section>
 </main>

 <section class="promo">
  <div class="inner-wrapper">
    <div class="title">PROMO SAAT INI</div>

    <div class="carousel">
      <div class="arrow left" id="btnPrev"><i class="bi bi-arrow-left"></i></div>

      <div class="promo-carousel-container" id="promoContainer">
        <?php 
        if ($q_promo->num_rows > 0) {
            while($promo = $q_promo->fetch_assoc()) {
                $imgPromo = !empty($promo['gambar']) ? 'gambar_promo/'.$promo['gambar'] : 'img01/default-promo.png';
        ?>
            <div class="promo-card">
                <img src="<?php echo $imgPromo; ?>">
                <div style="color:#333;">
                    <?php echo htmlspecialchars($promo['nama']); ?>
                </div>
            </div>
        <?php 
            }
        } else {
            echo '<p style="color:white;">Tidak ada promo saat ini.</p>';
        }
        ?>
      </div>

      <div class="arrow right" id="btnNext"><i class="bi bi-arrow-right"></i></div>
    </div>
  </div>
</section>

<section class="activities">
  <h2>Kegiatan Que-Que</h2>
  <div class="activities-strip">
    <div class="item"><img src="https://images.unsplash.com/photo-1544025162-d76694265947" alt="1"></div>
    <div class="item"><img src="https://images.unsplash.com/photo-1556910103-1c02745a30bf" alt="2"></div>
    <div class="item"><img src="https://images.unsplash.com/photo-1503424886302-1f3d05f18f1f" alt="3"></div>
  </div>
</section>

<section class="news">
  <h2>Berita lainnya</h2>
  <div class="cards">
    <?php 
    if ($q_news->num_rows > 0) {
        while($news = $q_news->fetch_assoc()) {
    ?>
        <article class="card-news">
        <h3><?php echo htmlspecialchars($news['judul']); ?></h3>
        <p><?php echo htmlspecialchars($news['deskripsi']); ?></p>
        <small style="color:#888;"><?php echo tgl_indo($news['tanggal']); ?></small>
        <a href="detail-berita.php?id=<?php echo $news['id_berita']; ?>">Baca Selengkapnya →</a>
        </article>
    <?php 
        }
    }
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>

<script>
    const container = document.getElementById('promoContainer');
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const scrollAmount = 330; 

    btnNext.addEventListener('click', () => {
        container.scrollLeft += scrollAmount;
    });

    btnPrev.addEventListener('click', () => {
        container.scrollLeft -= scrollAmount;
    });
</script>

</body>
</html>