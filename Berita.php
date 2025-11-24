<?php
// Panggil Class Berita & Promo
require_once 'backend/models/Berita.php'; 
require_once 'backend/models/Promo.php'; 

// Inisialisasi Object
$beritaObj = new Berita();
$promoObj = new Promo(); 

// Cek login untuk header
if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
    include 'header.php'; 
} else {
    include 'header2.php'; 
}

// --- LOGIKA OOP ---

// 1. Ambil Berita Utama
$q_main = $beritaObj->query("SELECT * FROM berita WHERE is_berita_utama = 'Yes' LIMIT 1");
$berita_utama = $q_main->fetch_assoc();

// Jika tidak ada berita utama, ambil berita terbaru
if (!$berita_utama) {
    $q_main = $beritaObj->query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT 1");
    $berita_utama = $q_main->fetch_assoc();
}

// 2. Ambil Promo
$q_promo = $promoObj->query("SELECT * FROM promo ORDER BY terakhir_edit DESC");

// 3. Ambil Berita Lainnya
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
  <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css01/berita.css?v=<?= time(); ?>" rel="stylesheet">
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
                $namaPromo = htmlspecialchars($promo['nama'], ENT_QUOTES);
                $kodePromo = htmlspecialchars($promo['kode_promo'], ENT_QUOTES);
        ?>
            <div class="promo-card" onclick="showPromoDetail('<?= $namaPromo; ?>', '<?= $imgPromo; ?>', '<?= $kodePromo; ?>')">
                <img src="<?php echo $imgPromo; ?>">
                <div>
                    <?php echo $namaPromo; ?>
                </div>
                <div style="font-size: 0.8rem; color: #ae4c02; margin-top:5px;">Klik untuk detail</div>
            </div>
        <?php 
            }
        } else {
            echo '<p style="color:white; font-family:\'Inria Serif\', serif;">Tidak ada promo saat ini.</p>';
        }
        ?>
      </div>

      <div class="arrow right" id="btnNext"><i class="bi bi-arrow-right"></i></div>
    </div>
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
        <small style="color:#ae4c02; font-weight:bold;"><?php echo tgl_indo($news['tanggal']); ?></small>
        <a href="detail-berita.php?id=<?php echo $news['id_berita']; ?>">Baca Selengkapnya →</a>
        </article>
    <?php 
        }
    }
    ?>
  </div>
</section>

<div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content promo-modal-content">
      <div class="modal-body text-center p-4 position-relative">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        
        <div class="mb-4">
             <img id="modalPromoImg" src="" alt="Promo" class="img-fluid rounded" style="max-height: 250px; object-fit: cover;">
        </div>

        <h3 id="modalPromoName" class="mb-3" style="font-family: 'Playfair Display', serif; color: #5b2a02; font-weight: bold;">
            Nama Promo
        </h3>

        <p class="text-uppercase fw-bold mb-2" style="letter-spacing: 2px; font-size: 0.9rem;">KODE</p>

        <div class="code-box-wrapper mb-3">
            <span id="modalPromoCode" class="promo-code-box">KODE123</span>
        </div>

        <p class="text-muted small">
            Berikan kode ini saat proses pemesanan<br>besar/kecil huruf berlaku.
        </p>

      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Slider Logic
    const container = document.getElementById('promoContainer');
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const scrollAmount = 320; 

    if(btnNext && btnPrev && container) {
        btnNext.addEventListener('click', () => {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        btnPrev.addEventListener('click', () => {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
    }

    // Modal Logic
    function showPromoDetail(nama, gambar, kode) {
        // Set data ke dalam modal
        document.getElementById('modalPromoName').innerText = nama;
        document.getElementById('modalPromoImg').src = gambar;
        document.getElementById('modalPromoCode').innerText = kode;

        // Tampilkan Modal Bootstrap
        var myModal = new bootstrap.Modal(document.getElementById('promoModal'));
        myModal.show();
    }
</script>

</body>
</html>