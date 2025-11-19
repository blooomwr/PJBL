<?php
// PASTIKAN BARIS INI ADA DI AWAL SEMUA FILE HALAMAN
// Ini akan memulai sesi dan koneksi database.
include 'connlog.php'; 

// Cek apakah user sudah login sebagai pembeli
if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
    // Jika sudah login, muat header yang menampilkan ikon profil/logout
    include 'header.php'; 
} else {
    // Jika belum login, muat header yang menampilkan tombol Login/Sign Up
    include 'header2.php'; 
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Berita - Rumah Que-Que</title>

  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css01/berita.css" rel="stylesheet">
</head>
<body>

  <main>
    <!-- HERO -->
    <section class="hero">
      <div class="hero-left">
        <h1>Apresiasi untuk<br>Rumah Que-Que</h1>
        <div class="meta">Kamis, 21 Maret 2022</div>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Pellentesque gravida arcu ut ultricies bibendum. Integer vitae pharetra
          velit. Nam porttitor mauris nunc, in molestie nulla placerat non.
        </p>
        <a class="btn-primary" href="#">Baca Selengkapnya</a>
      </div>

      <div class="hero-right">
        <img src="img01/sertifikat3.png" alt="Sertifikat apresiasi Rumah Que-Que">
      </div>
    </section>
 </main>
    <!-- PROMO -->
 <section class="promo">

  <div class="inner-wrapper">
    <div class="title">PROMO SAAT INI</div>

    <div class="carousel">
      <div class="bi bi-arrow-left-circle-fill arrow left"></div>

      <div class="card">
        <div class="inner">
          <img src="img01/promo-tacookies.png" style="width:150px;margin-bottom:10px;">
          <div style="font-size:14px;letter-spacing:1px">Beli 3 varian Tacookies sekaligus</div>
          <div style="font-family:'Playfair Display';font-size:26px;margin-top:6px">Disc 2%</div>
        </div>
      </div>

      <div class="bi bi-arrow-right-circle-fill arrow right"></div>
    </div>
  </div>

</section>


    <!-- KEGIATAN -->
 <section class="activities">
  <h2>Kegiatan Que-Que</h2>

  <div class="activities-strip">
    <div class="item">
      <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1200&q=60" alt="kegiatan1">
    </div>
    <div class="item">
      <img src="" alt="kegiatan2">
    </div>
    <div class="item">
      <img src="https://images.unsplash.com/photo-1503424886302-1f3d05f18f1f?auto=format&fit=crop&w=1200&q=60" alt="kegiatan3">
    </div>
  </div>
</section>



    <!-- BERITA LAINNYA -->
    <section class="news">
      <h2>Berita lainnya</h2>
      <div class="cards">
        <article class="card-news">
          <h3>Kue Pisang Coklat Viral dan Jadi Buruan!</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
            gravida arcu ut ultricies bibendum. Integer vitae pharetra velit.
          </p>
          <a href="#">Baca Selengkapnya →</a>
        </article>

        <article class="card-news">
          <h3>Kue Pisang Coklat Viral dan Jadi Buruan!</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
            gravida arcu ut ultricies bibendum. Integer vitae pharetra velit.
          </p>
          <a href="#">Baca Selengkapnya →</a>
        </article>
      </div>
    </section>

  <?php include 'footer.php'; ?>

  <script>
    // animasi kecil saat panah diklik
    document.querySelectorAll('.arrow').forEach(a => {
      a.addEventListener('click', () => {
        const c = document.querySelector('.promo .card');
        c.animate(
          [{ transform: 'scale(1)' }, { transform: 'scale(0.96)' }, { transform: 'scale(1)' }],
          { duration: 420 }
        );
      });
    });

    <script>
  // animasi kecil di promo
  document.querySelectorAll('.arrow').forEach(a => {
    a.addEventListener('click', () => {
      const c = document.querySelector('.promo .card');
      if (!c) return;
      c.animate(
        [{ transform: 'scale(1)' }, { transform: 'scale(0.96)' }, { transform: 'scale(1)' }],
        { duration: 420 }
      );
    });
  });

  // === CAROUSEL KEGIATAN QUE-QUE ===
  const activityCards = document.querySelectorAll('.activities .card');
  const btnPrev = document.querySelector('.activities .act-btn.left');
  const btnNext = document.querySelector('.activities .act-btn.right');

  if (activityCards.length) {
    let currentIndex = 0;

    function updateActivityClasses() {
      const total = activityCards.length;
      activityCards.forEach((card, idx) => {
        card.classList.remove('active');
        // kartu aktif = index sekarang
        if (idx === currentIndex) {
          card.classList.add('active');
        }
      });
    }

    // inisialisasi awal
    updateActivityClasses();

    btnNext.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % activityCards.length; // muter ke kanan
      updateActivityClasses();
    });

    btnPrev.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + activityCards.length) % activityCards.length; // muter ke kiri
      updateActivityClasses();
    });
  }
</script>

  </script>
</body>
</html>
