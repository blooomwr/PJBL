<?php
// File: Home.php
include 'connlog.php'; 

// Cek Login
if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
    include 'header.php'; 
} else {
    include 'header2.php'; 
}

// --- LOGIKA PHP: AMBIL 3 BEST SELLER RANDOM ---
$queryBest = "SELECT p.*, 
              (SELECT nama_file FROM produk_gambar pg WHERE pg.id_produk = p.id_produk LIMIT 1) as gambar_utama 
              FROM produk p 
              WHERE is_bestseller = 'Yes' 
              ORDER BY RAND() 
              LIMIT 3";
$resultBest = mysqli_query($conn, $queryBest);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Rumah Que-Que</title>
    <link href="css01/home.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
     
     <style>
         .card-produk {
             transition: transform 0.3s;
             cursor: pointer;
             height: 100%; /* Agar tinggi kartu seragam */
             display: flex;
             flex-direction: column;
             justify-content: space-between;
         }
         .card-produk:hover {
             transform: translateY(-10px);
         }
         .card-produk img {
             width: 100%;
             height: 250px; /* Tinggi gambar tetap */
             object-fit: cover; /* Agar gambar tidak gepeng */
             border-radius: 12px;
             margin-bottom: 15px;
         }
         .nama-produk {
             font-family: 'Playfair Display', serif;
             font-size: 1.2rem;
             font-weight: bold;
             color: #4b2b00;
             margin-bottom: 5px;
             text-transform: uppercase;
         }
         .harga-produk {
             color: #ae4c02;
             font-weight: 600;
             font-size: 1.1rem;
         }
     </style>
</head>
<body>
    <section class="hero-section container d-flex align-items-center py-0" style="margin-top:0;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Rumah Que-Que</h1>
                <p class="hero-subtitle">Kue Paling Enak di Bogor!</p>

                <div class="btnhero mt-4">
                    <a href="wishlist.php" class="btnwistlist"><img src="img01/logobelanja.png" class=".icon"></img>Lihat Wishlist</a>
                    <a href="katalog.php" class="btnbelisekarang">Pesan Sekarang</a>
                </div>
            </div>

            <div class="col-md-6">
                <img src="img01/Hero.png" class="img-fluid">
            </div>
        </div>
    </section>


<div class="produk-terlaris-box-oren">

    <div class="container text-center py-5">
        <h2 class="judul-section">PRODUK TERLARIS</h2>

        <div class="row mt-4 mb-5 justify-content-center gx-xxl-5 gy-4">
            
            <?php if (mysqli_num_rows($resultBest) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($resultBest)): ?>
                    <?php 
                        // Cek gambar
                        $imgSrc = !empty($row['gambar_utama']) ? 'gambar_produk/'.$row['gambar_utama'] : 'assets/no-image.png';
                    ?>
                    <div class="col-md-3">
                        <a href="detail-produk.php?id=<?= $row['id_produk']; ?>" style="text-decoration: none;">
                            <div class="card-produk">
                                <img src="<?= $imgSrc; ?>" alt="<?= htmlspecialchars($row['nama']); ?>">
                                <div>
                                    <p class="nama-produk"><?= htmlspecialchars($row['nama']); ?></p>
                                    <p class="harga-produk">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-white">Belum ada produk Best Seller.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="container py-5">
    <div class="row testimoni-row">
        <div class="col-md-4">
            <h2 class="judul-testimoni">APA KATA<br>PELANGGAN<br>KAMI?</h2>
        </div>

        <div class="col-md-8 d-flex align-items-center">
            <div class="testimoni-scroll flex-grow-1 me-2">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Budi Setiawan</h5>
                            <p>★★★★★</p>
                            <p>“Enak banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Tenxii</h5>
                            <p>★★★★★</p>
                            <p>“Awalnya coba, eh ketagihan.”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Carlos Jessifer</h5>
                            <p>★★★★★</p>
                            <p>“So good and tasty!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>BoBoiboy</h5>
                            <p>★★★★★</p>
                            <p>“Ketan top banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Siti Aminah</h5>
                            <p>★★★★★</p>
                            <p>“Lembut banget kuenya.”</p>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Joko</h5>
                            <p>★★★★☆</p>
                            <p>“Pengiriman cepat.”</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column justify-content-between">
                <i class="bi bi-arrow-up-circle-fill arrow-btn fs-1 mb-3"></i>
                <i class="bi bi-arrow-down-circle-fill arrow-btn fs-1 mt-3"></i>
            </div>
        </div>
    </div>
</div>



</div> <section class="faq-section py-5">
  <div class="container">
    <div class="faq-box p-4">

      <div class="faq-search">
        <h2 class="judul-section">FaQ</h2>
      </div>

      <div class="faq-accordion">

        <div class="faq-item">
          <div class="faq-question">Bagaimana cara melakukan pemesanan?</div>
          <div class="faq-answer">
            <p>Klik tombol pesan sekarang, pilih produk, dan Anda akan diarahkan ke WhatsApp kami.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Metode pembayaran apa saja yang tersedia?</div>
          <div class="faq-answer">
            <p>Kami menerima Transfer Bank, E-Wallet (GoPay, OVO, Dana), dan QRIS.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Apakah harga sudah termasuk pajak?</div>
          <div class="faq-answer">
            <p>Ya, harga yang tertera sudah termasuk pajak.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Bisakah mengubah pesanan setelah bayar?</div>
          <div class="faq-answer">
            <p>Silakan hubungi admin via WhatsApp secepatnya sebelum pesanan diproses.</p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>


<?php include 'footer.php'; ?>

<script>
const scrollContainer = document.querySelector('.testimoni-scroll');
const arrowUp = document.querySelector('.arrow-btn.bi-arrow-up-circle-fill');
const arrowDown = document.querySelector('.arrow-btn.bi-arrow-down-circle-fill');

// Update state
function updateArrowState() {
    // Top
    if (scrollContainer.scrollTop <= 0) {
        arrowUp.classList.add('disabled');
    } else {
        arrowUp.classList.remove('disabled');
    }

    // Bottom
    if (scrollContainer.scrollTop + scrollContainer.clientHeight >= scrollContainer.scrollHeight) {
        arrowDown.classList.add('disabled');
    } else {
        arrowDown.classList.remove('disabled');
    }
}

// Scroll Up
arrowUp.addEventListener('click', () => {
    scrollContainer.scrollBy({ top: -300, behavior: 'smooth' }); // Ubah value agar scroll lebih smooth
});

// Scroll Down
arrowDown.addEventListener('click', () => {
    scrollContainer.scrollBy({ top: 300, behavior: 'smooth' });
});

// Trigger 1x
scrollContainer.addEventListener('scroll', updateArrowState);
updateArrowState();

  const questions = document.querySelectorAll(".faq-question");

  questions.forEach((question) => {
    question.addEventListener("click", () => {

      // close other answers
      questions.forEach((q) => {
        if (q !== question) {
          q.classList.remove("active");
          q.nextElementSibling.style.maxHeight = null;
        }
      });

      // toggle clicked one
      question.classList.toggle("active");
      const answer = question.nextElementSibling;
      if (question.classList.contains("active")) {
        answer.style.maxHeight = answer.scrollHeight + "px";
      } else {
        answer.style.maxHeight = null;
      }
    });
  });
</script>

</body>
</html>