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

    /* Container utama */
    .header-container {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      margin: 20px auto;
      position: relative;
    }

    /* Logo di kiri luar */
    .logo-container {
      position: flex;
      left: 40px;
    }

    .logo-container img {
      height: 60px;
      width: auto;
    }

    /* Navbar oval */
    .navbar-custom {
      background-color: #AE4C02;
      border-radius: 50px;
      padding: 10px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-width: 900px;
    }

    /* Menu di tengah */
    .navbar-nav {
      margin: auto;
    }

    .nav-link {
      color: #fffaf3 !important;
      font-size: 18px;
      font-weight: 500;
      margin: 0 20px;
      transition: color 0.3s ease;
    }

    .nav-link:hover {
      color: #ffe6c7 !important;
    }

    /* Ikon profil di kanan dalam navbar */
    .user-icon {
      color: #fffaf3;
      font-size: 26px;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .user-icon:hover {
      color: #ffe6c7;
    }

    @media (max-width: 992px) {
      .navbar-custom {
        flex-direction: column;
        padding: 15px 20px;
      }

      .navbar-nav {
        margin: 10px 0;
      }
    }
  </style>
</head>

<body>

  <header class="header-container">
    <!-- Logo di kiri luar -->
    <div class="logo-container">
      <img src="NEW LOGO RQQ.png" alt="Rumah Que Que">
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <ul class="navbar-nav d-flex flex-row justify-content-center flex-grow-1">
          <li class="nav-item"><a class="nav-link" href="HomeUtama.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="berita.php">Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="Tentang Kami.php">Tentang Kami</a></li>
        </ul>

        <div class="auth-links">
          <a href="#" class="nav-link" style="padding: 0; margin: 0;">
            <i class="bi bi-person-circle user-icon me-2"></i>
            <?= htmlspecialchars($_SESSION['nama_user']); ?>
          </a>
          <span class="divider">|</span>
          <a href="logout.php" class="nav-link">Logout</a>
        </div>
      </div>
    </nav>
  </header>

</body>

</html>