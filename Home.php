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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

    <section class="hero-section container d-flex align-items-center">
        <div class="row align-items-center w-100 m-0">
            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 order-2 order-lg-1">
                <h1 class="hero-title">Rumah Que-Que</h1>
                <p class="hero-subtitle">Kue Paling Enak di Bogor!</p>

                <div class="btnhero mt-4">
                    <a href="wishlist.php" class="btnwistlist">
                        <img src="img01/logobelanja.png" alt="icon"> Lihat Wishlist
                    </a>
                    <a href="katalog.php" class="btnbelisekarang">Pesan Sekarang</a>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 text-center order-1 order-lg-2 mb-4 mb-lg-0">
                <img src="img01/Hero2.png" class="img-fluid" alt="Hero Image">
            </div>
        </div>
    </section>

    <div class="produk-terlaris-box-oren">

        <div class="container text-center py-4">
            <h2 class="judul-section">PRODUK TERLARIS</h2>

            <div class="row mt-4 mb-5 justify-content-center g-4">
                <?php if (mysqli_num_rows($resultBest) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($resultBest)): ?>
                        <?php 
                            $imgSrc = !empty($row['gambar_utama']) ? 'gambar_produk/'.$row['gambar_utama'] : 'assets/no-image.png';
                        ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <a href="detail-produk.php?id=<?= $row['id_produk']; ?>" style="text-decoration: none;">
                                <div class="card-produk">
                                    <img src="<?= $imgSrc; ?>" alt="<?= htmlspecialchars($row['nama']); ?>">
                                    <div class="mt-2">
                                        <p class="nama-produk"><?= htmlspecialchars($row['nama']); ?></p>
                                        <p class="harga-produk">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-white" style="font-size: 1.2rem;">Belum ada produk Best Seller.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="container py-4">
            <div class="row testimoni-row align-items-center">
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <h2 class="judul-testimoni">APA KATA<br>PELANGGAN<br>KAMI?</h2>
                </div>
                    
                <div class="col-lg-8 col-md-12 d-flex align-items-center testimonial-wrapper">
                    <div class="testimoni-scroll flex-grow-1 me-lg-3">
                        <div class="row g-3">
                            <div class="col-md-6 col-12"><div class="card-testi"><h5>Mustafidah Iana</h5><p>★★★★★</p><p>“Endess banget ketan srikaya-nya”</p></div></div>
                            <div class="col-md-6 col-12"><div class="card-testi"><h5>Budi Inayatno</h5><p>★★★★★</p><p>“Tempatnya bersih..”</p></div></div>
                            <div class="col-md-6 col-12"><div class="card-testi"><h5>dede sukmadjaja</h5><p>★★★★★</p><p>“kuenya fresh, enak, ramah dikantong”</p></div></div>
                            <div class="col-md-6 col-12"><div class="card-testi"><h5>Ani Dwi Saraswati</h5><p>★★★★★</p><p>“Kue ketan srikyaaaa enakkk.”</p></div></div>
                            <div class="col-md-6 col-12"><div class="card-testi"><h5>Farid Aulia Rahman</h5><p>★★★★★</p><p>“kue nya enak, toko nya juga nyaman.”</p></div></div>
                            <div class="col-md-6 col-12"><div class="card-testi"><h5>Joko</h5><p>★★★★★</p><p>“Harga kuwe nya ter jankau dan enak.”</p></div></div>
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-content-between nav-buttons">
                        <i class="bi bi-arrow-up-circle-fill arrow-btn mb-lg-3"></i>
                        <i class="bi bi-arrow-down-circle-fill arrow-btn mt-lg-3"></i>
                    </div>
                </div>
            </div>
        </div>

    </div> <section class="faq-section">
        <div class="container pt-5">
            <div class="faq-search">
                <h2 class="judul-section mb-4">FaQ</h2>
            </div>

            <div class="faq-accordion">
                <div class="faq-item">
                    <div class="faq-question">Bagaimana cara melakukan pemesanan?</div>
                    <div class="faq-answer"><p>Klik tombol pesan sekarang, pilih produk, dan Anda akan diarahkan ke WhatsApp kami.</p></div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Metode pembayaran apa saja?</div>
                    <div class="faq-answer"><p>Kami menerima Transfer Bank, E-Wallet (GoPay, OVO, Dana), dan QRIS.</p></div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Apakah harga sudah termasuk pajak?</div>
                    <div class="faq-answer"><p>Ya, harga yang tertera sudah termasuk pajak.</p></div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Bisakah mengubah pesanan setelah bayar?</div>
                    <div class="faq-answer"><p>Silakan hubungi admin via WhatsApp secepatnya sebelum pesanan diproses.</p></div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
    // === Logic Scroll Testimoni ===
    const scrollContainer = document.querySelector('.testimoni-scroll');
    const arrowUp = document.querySelector('.bi-arrow-up-circle-fill');
    const arrowDown = document.querySelector('.bi-arrow-down-circle-fill');

    function updateArrowState() {
        if (!scrollContainer) return;
        // Tombol Atas
        if (scrollContainer.scrollTop <= 0) {
            arrowUp.classList.add('disabled');
        } else {
            arrowUp.classList.remove('disabled');
        }
        // Tombol Bawah
        if (Math.ceil(scrollContainer.scrollTop + scrollContainer.clientHeight) >= scrollContainer.scrollHeight) {
            arrowDown.classList.add('disabled');
        } else {
            arrowDown.classList.remove('disabled');
        }
    }
    
    if (arrowUp && arrowDown && scrollContainer) {
        arrowUp.addEventListener('click', () => {
            scrollContainer.scrollBy({ top: -200, behavior: 'smooth' });
        });
        arrowDown.addEventListener('click', () => {
            scrollContainer.scrollBy({ top: 200, behavior: 'smooth' });
        });
        scrollContainer.addEventListener('scroll', updateArrowState);
        // Init state
        updateArrowState();
    }

    // === Logic FAQ Accordion ===
    const questions = document.querySelectorAll(".faq-question");

    questions.forEach((question) => {
        question.addEventListener("click", () => {
            // Tutup yang lain
            questions.forEach((q) => {
                if (q !== question) {
                    q.classList.remove("active");
                    q.nextElementSibling.style.maxHeight = null;
                }
            });

            // Toggle yang diklik
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