
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
      background: linear-gradient(to bottom, #fef9ef, #fffaf3);;
    }

        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
        flex: 1; /* bagian konten mengisi ruang kosong */
        }

        footer {
        margin-top: auto; /* footer otomatis nempel di bawah */
        }

        /* ... CSS lainnya di bagian <style> ... */

/* Footer */
.footer {
    background-color: #fdeedc;
    position: relative;
    padding: 60px 0 40px;
    /* Sudut Bulat hanya di sisi atas */
    border-top-left-radius: 50% 100%;
    border-top-right-radius: 50% 100%;
    font-family: 'Playfair Display', serif; /* Gunakan font yang sama dengan body */
    margin-top: auto; /* Penting agar footer selalu di bawah */
}

.footer-container {
    max-width: 900px; /* Batasi lebar agar konten tidak terlalu menyebar */
    margin: 0 auto;
    display: flex;
    /* Gunakan ruang yang tersedia */
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
    /* Beri ruang lebih di kiri */
    flex: 0 0 150px; 
}

.footer-logo img {
    width: 100px;
    margin-bottom: 10px;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 8px;
    /* Kolom di tengah */
    flex: 0 0 200px; 
    padding-top: 10px; /* Jarak agar sejajar dengan kolom kontak */
}

.footer-links a {
    text-decoration: none;
    color: #555;
    font-size: 1.1rem; /* Perbesar sedikit agar mudah dibaca */
}

.footer-links a:hover {
    color: #d97325;
}

.footer-contact {
    /* Kolom Kanan */
    flex: 0 0 350px; 
    /* Sesuaikan agar tidak terlalu lebar di layout ini */
    /* Pastikan ikon memiliki warna */
}

.footer-contact h4 {
    color: #444;
    font-size: 1.5rem; 
    margin-bottom: 10px;
}

.footer-contact p {
    margin: 4px 0;
    /* Pastikan font size sesuai dengan kolom lain */
    font-size: 1.1rem; 
}

.footer-contact i {
    margin-right: 6px;
    color: #ae4c02; /* Ubah ke warna coklat tua agar terlihat jelas */
    font-size: 1.1rem;
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
    <p><i class="bi bi-phone"></i> +62 82123131234</p>
    <p><i class="bi bi-envelope"></i> quequeque@gmail.com</p>
    <p><i class="bi bi-geo-alt"></i> Jl. Aur Auran</p>
    </div>
  </div>
</footer>

</body>
</html>
