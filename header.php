<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
  /* === STYLE DASAR (GLOBAL) === */
  .header-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin: 20px auto;
    position: relative;
    z-index: 1000;
    width: 100%;
    padding: 0 15px;
  }

  .logo-container img {
    height: 60px;
    width: auto;
  }

  /* === NAVBAR CUSTOM === */
  .navbar-custom {
    background-color: #AE4C02;
    border-radius: 50px;
    /* Padding default (mobile/tablet) */
    padding: 10px 20px !important; 
    min-height: 60px;
    width: 100%; /* Default full width di mobile */
  }

  /* Link Navigasi */
  .nav-link {
    color: #fffaf3 !important;
    font-size: 18px;
    font-weight: 500;
    font-family: 'Inria Serif', serif !important;
    transition: color 0.3s ease;
    /* Margin default kecil agar aman di tablet */
    margin: 0 5px; 
  }

  .nav-link:hover { color: #ffe6c7 !important; }

  /* User/Auth Section */
  .auth-links {
    display: flex;
    align-items: center;
    gap: 10px; /* Jarak default */
    color: #fffaf3;
    font-family: 'Inria Serif', serif !important;
  }

  .auth-links a {
    color: #fffaf3;
    text-decoration: none;
    font-size: 18px;
    transition: color 0.3s ease;
  }
  
  .auth-links a:hover { color: #ffe6c7; }
  .divider { color: #fffaf3; margin: 0 5px; }

  .navbar-toggler { border: none; padding: 0; }
  .navbar-toggler:focus { box-shadow: none; }
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 250, 243, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  /* === KHUSUS DESKTOP (Layar > 992px) === */
  @media (min-width: 992px) {
    .header-container {
      width: auto; /* Kembali ke auto agar di tengah */
      padding: 0;
    }

    .navbar-custom {
      width: auto; /* Tidak full width */
      min-width: 900px; /* Kembalikan lebar minimum agar terlihat gagah */
      padding: 0 50px !important; /* Padding dalam navbar lebih lega */
      flex-direction: row;
    }

    .navbar-nav {
      margin: auto;
      gap: 30px; /* JARAK ANTAR MENU (Beranda, Katalog, dll) */
    }

    .nav-link {
      margin: 0 15px !important; /* Tambahan margin kiri-kanan tiap menu */
      font-size: 19px; /* Opsional: Font sedikit lebih besar di desktop */
    }

    .auth-links {
      gap: 20px; /* Jarak antar elemen login/logout lebih lega */
      margin-left: 20px;
    }
  }

  /* === KHUSUS MOBILE (Layar < 992px) === */
  @media (max-width: 991px) {
    .header-container {
      flex-direction: column;
      gap: 10px;
    }
    
    .navbar-collapse {
      margin-top: 15px;
      text-align: center;
      border-top: 1px solid rgba(255,255,255,0.1);
      padding-top: 10px;
    }

    .nav-link {
      padding: 10px 0; /* Memberi jarak vertikal antar menu saat di-expand */
      margin: 0; /* Reset margin samping di mobile */
    }

    .auth-links {
      justify-content: center;
      margin-top: 15px;
      padding-bottom: 10px;
    }
  }
</style>

<header class="header-container">
  <div class="logo-container">
    <img src="assets/NEW LOGO RQQ.png" alt="Rumah Que Que">
  </div>

  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid p-0">
      
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link" href="home.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="berita.php">Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Kami</a></li>
        </ul>

        <div class="auth-links">
          <a href="#" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#profileModal">
            <i class="bi bi-person-circle user-icon me-2"></i>
            <?= isset($_SESSION['nama_user']) ? htmlspecialchars($_SESSION['nama_user']) : 'User'; ?>
          </a>
          
          <span class="divider">|</span>
          <a href="logout.php">Logout</a>
        </div>
      </div>
      
    </div>
  </nav>
</header>
<?php include 'backend_admin/modal-profil.php'; ?>