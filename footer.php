
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rumah Que-Que</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Playfair Display', serif;
      background: linear-gradient(to bottom, #fef9ef, #fffaf3);
    }
                html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        }

        main {
        flex: 1; /* bagian konten mengisi ruang kosong */
        }

        footer {
        margin-top: auto; /* footer otomatis nempel di bawah */
        }

        .footer {
        background-color: #fdeedc;
        position: relative;
        padding: 60px 0 40px;
        border-top-left-radius: 100% 20%;
        border-top-right-radius: 100% 20%;
        font-family: 'Poppins', sans-serif;
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
        }

        .footer-logo {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        }

        .footer-logo img {
        width: 100px;
        margin-bottom: 10px;
        }

        .footer-logo h3 {
        color: #d97325;
        font-weight: 700;
        font-size: 1.2rem;
        }

        .footer-logo h3 span {
        color: #a84a00;
        }

        .footer-links {
        display: flex;
        flex-direction: column;
        gap: 8px;
        }

        .footer-links a {
        text-decoration: none;
        color: #555;
        font-size: 0.9rem;
        }

        .footer-links a:hover {
        color: #d97325;
        }

        .footer-contact h4 {
        color: #444;
        margin-bottom: 10px;
        }

        .footer-contact p {
        margin: 4px 0;
        font-size: 0.9rem;
        }

        .footer-contact i {
        margin-right: 6px;
        color: #d97325;
        }

  </style>
</head>

<body>

 <footer class="footer">
  <div class="footer-container">
    <div class="footer-logo">
      <img src="NEW LOGO RQQ.png" alt="Rumah Que Que">
    </div>

    <div class="footer-links">
      <a href="#">Beranda</a>
      <a href="#">Katalog Produk</a>
      <a href="#">Tentang Kami</a>
    </div>

    <div class="footer-contact">
      <h4>Hubungi kami</h4>
      <p><i class="fa fa-phone"></i> +62 82123131234</p>
      <p><i class="fa fa-envelope"></i> quequeque@gmail.com</p>
      <p><i class="fa fa-map-marker"></i> Jl. Aur Auran</p>
    </div>
  </div>
</footer>

</body>
</html>
