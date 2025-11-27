<?php
// === 1. LOGIKA DETEKSI HALAMAN (DIPERBAIKI) ===
// Menggunakan SCRIPT_NAME agar lebih akurat mendeteksi file fisik
$currentPage = basename($_SERVER['SCRIPT_NAME']);

// Daftar halaman yang punya Banner Besar (Header menempel/transparan)
$pagesWithBanner = ['index.php', 'tentang.php', 'login.php', 'signup.php'];

// Tentukan Padding Top body
$bodyPadding = in_array($currentPage, $pagesWithBanner) ? '0' : '140px'; 
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
  /* === LOGIKA PADDING DINAMIS === */
  body {
    padding-top: <?= $bodyPadding; ?> !important;
  }

  /* === HEADER CONTAINER === */
  .header-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    position: fixed; 
    top: 0; left: 0; width: 100%;
    z-index: 1030;
    background-color: transparent !important; 
    box-shadow: none !important;
    padding: 15px 20px; 
    margin: 0;
    transition: all 0.3s ease;
  }

  .logo-container img {
    height: 60px;
    width: auto;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); 
  }

  /* === NAVBAR CUSTOM === */
  .navbar-custom {
    background-color: #AE4C02;
    border-radius: 50px;
    padding: 10px 20px !important; 
    min-height: 60px;
    width: 100%; 
    box-shadow: 0 4px 15px rgba(174, 76, 2, 0.3);
  }

  /* Link Navigasi Default */
  .navbar-custom .nav-link {
    color: #fffaf3 !important; /* Warna Putih Cream */
    font-size: 18px;
    font-weight: 500;
    font-family: 'Inria Serif', serif !important;
    transition: all 0.3s ease;
    margin: 0 5px; 
    opacity: 0.9;
  }

  /* Efek Hover (Saat kursor diarahkan) */
  .navbar-custom .nav-link:hover { 
      color: #ffe6c7 !important; /* Warna Kuning/Oren Terang */
      opacity: 1;
      transform: translateY(-1px);
  }

  /* === LINK AKTIF (Saat berada di halaman tersebut) === */
  .navbar-custom .nav-link.active {
      color: #ffe6c7 !important; /* SAMA DENGAN HOVER (Oren Terang) */
      font-weight: 700 !important; /* Tebal */

      opacity: 1;
  }

  /* User/Auth Section */
  .auth-links {
    display: flex;
    align-items: center;
    gap: 10px; 
    color: #fffaf3;
    font-family: 'Inria Serif', serif !important;
  }

  .auth-links a {
    color: #fffaf3;
    text-decoration: none;
    font-size: 18px;
    transition: color 0.3s ease;
    cursor: pointer;
  }
  
  .auth-links a:hover { color: #ffe6c7; }
  .divider { color: #fffaf3; margin: 0 5px; }

  .navbar-toggler { border: none; padding: 0; }
  .navbar-toggler:focus { box-shadow: none; }
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 250, 243, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  /* RESPONSIVE */
  @media (min-width: 992px) {
    .header-container { flex-direction: row; justify-content: center; padding-top: 25px; }
    .navbar-custom { width: auto; min-width: 900px; padding: 0 50px !important; flex-direction: row; }
    .navbar-nav { margin: auto; gap: 30px; }
    .nav-link { margin: 0 15px !important; font-size: 19px; }
    .auth-links { gap: 20px; margin-left: 20px; }
  }

  @media (max-width: 991px) {
    .header-container { flex-direction: column; gap: 10px; padding: 10px 15px; }
    .navbar-custom { width: 100%; border-radius: 20px; }
    .navbar-collapse { margin-top: 15px; text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px; }
    .nav-link { padding: 10px 0; margin: 0; }
    .auth-links { justify-content: center; margin-top: 15px; padding-bottom: 10px; }
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
          
          <li class="nav-item">
              <a class="nav-link <?= ($currentPage == 'index.php' || $currentPage == '') ? 'active' : ''; ?>" href="index.php">Beranda</a>
          </li>
          
          <li class="nav-item">
              <a class="nav-link <?= ($currentPage == 'katalog.php' || $currentPage == 'detail-produk.php' || $currentPage == 'wishlist.php') ? 'active' : ''; ?>" href="katalog.php">Katalog</a>
          </li>
          
          <li class="nav-item">
              <a class="nav-link <?= ($currentPage == 'Berita.php' || $currentPage == 'detail-berita.php') ? 'active' : ''; ?>" href="Berita.php">Berita</a>
          </li>
          
          <li class="nav-item">
              <a class="nav-link <?= ($currentPage == 'tentang.php') ? 'active' : ''; ?>" href="tentang.php">Tentang Kami</a>
          </li>

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
<?php include 'backend/views/modal-profil.php'; ?>