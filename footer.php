<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rumah Que-Que</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@300;400;700&display=swap" rel="stylesheet">

  <style>
    /* === GLOBAL STYLE === */
    body {
      background: linear-gradient(to bottom, #fef9ef, #fffaf3);
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      font-family: 'Inria Serif', serif; /* GANTI FONT GLOBAL */
    }

    main {
      flex: 1; /* Bagian konten mengisi ruang kosong */
    }

    /* === FOOTER STYLE === */
    footer {
      margin-top: auto; /* Footer otomatis nempel di bawah */
      width: 100%;
    }

    .footer {
      background-color: #fdeedc;
      position: relative;
      padding: 60px 20px 40px; /* Tambah padding kiri kanan */
      
      /* Lengkungan Footer */
      border-top-left-radius: 50% 30px;
      border-top-right-radius: 50% 30px;
      
      font-family: 'Inria Serif', serif;
      box-shadow: 0 -5px 15px rgba(0,0,0,0.02);
    }

    .footer-container {
      max-width: 1100px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      color: #555;
      text-align: left;
      gap: 30px; /* Jarak antar elemen jika menyempit */
    }

    /* Logo Section */
    .footer-logo {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      max-width: 300px;
    }

    .footer-logo img {
      width: 100px;
      margin-bottom: 15px;
    }

    .footer-logo h3 {
      color: #d97325;
      font-weight: 700;
      font-size: 1.4rem;
      margin: 0;
    }

    /* Links Section */
    .footer-links {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .footer-links a {
      text-decoration: none;
      color: #555;
      font-size: 1rem;
      transition: 0.3s;
      font-weight: 600;
    }

    .footer-links a:hover {
      color: #d97325;
      transform: translateX(5px); /* Efek geser sedikit saat hover */
    }

    /* Contact Section */
    .footer-contact h4 {
      color: #444;
      margin-bottom: 15px;
      font-weight: 700;
      font-size: 1.2rem;
    }

    .footer-contact p {
      margin: 8px 0;
      font-size: 1rem;
      display: flex;
      align-items: center;
    }

    .footer-contact i {
      margin-right: 10px;
      color: #d97325;
      font-size: 1.1rem;
    }

    /* === RESPONSIVE / ADAPTIVE (MOBILE) === */
    @media (max-width: 768px) {
      .footer {
        padding: 50px 20px 30px;
        border-top-left-radius: 30px 15px; /* Lengkungan lebih kecil di HP */
        border-top-right-radius: 30px 15px;
      }

      .footer-container {
        flex-direction: column; /* Susun ke bawah */
        align-items: center;    /* Rata tengah */
        text-align: center;
      }

      .footer-logo {
        align-items: center; /* Logo rata tengah */
        margin-bottom: 10px;
      }

      .footer-links {
        align-items: center; /* Link rata tengah */
        gap: 15px;
      }
      
      .footer-links a:hover {
        transform: none; /* Matikan efek geser di HP */
        color: #d97325;
      }

      .footer-contact {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      
      .footer-contact p {
        justify-content: center;
      }
    }
  </style>
</head>

<body>

 <footer class="footer">
  <div class="footer-container">
    <div class="footer-logo">
      <img src="assets/NEW LOGO RQQ.png" alt="Rumah Que Que">
      </div>

    <div class="footer-links">
      <a href="index.php">Beranda</a>
      <a href="katalog.php">Katalog Produk</a>
      <a href="tentang.php">Tentang Kami</a>
    </div>

    <div class="footer-contact">
      <h4>Hubungi kami</h4>
      <p><i class="bi bi-telephone-fill"></i> +62 82123131234</p>
      <p><i class="bi bi-envelope-fill"></i> quequeque@gmail.com</p>
      <p style="max-width:300px; white-space:normal; word-wrap:break-word;">
      <i class="bi bi-geo-alt-fill"></i> Samping Klinik LNA, Jl. Cemped Jl. Bangbarung Raya No.2A,
      Bantarjati, Bogor Utara, Bogor City, West Java 16153 </p>

    </div>
  </div>
</footer>

</body>
</html>
