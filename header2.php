<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rumah Que-Que</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Playfair Display', serif;
      background-color: #fdf3e3;
    }

    .header-container {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      margin: 20px auto;
      position: relative;
    }

    /* Logo kiri */
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

    /* Menu tengah */
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
      color: #ffd9b3 !important;
    }

    /* Login & Sign Up kanan */
    .auth-links {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .auth-links a {
      color: #fffaf3;
      text-decoration: none;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .auth-links a:hover {
      color: #ffd9b3;
    }

    .divider {
      color: #fffaf3;
    }
  </style>
</head>
<body>

  <header class="header-container">
    <div class="logo-container">
      <img src="NEW LOGO RQQ.png" alt="Rumah Que Que">
    </div>

    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <ul class="navbar-nav d-flex flex-row justify-content-center flex-grow-1">
          <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="katalog.php">Katalog</a></li>
          <li class="nav-item"><a class="nav-link" href="berita.php">Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Kami</a></li>
        </ul>

        <div class="auth-links">
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'pembeli'): ?>
            <a href="profil.php" class="nav-link" style="padding: 0; margin: 0;">
                <i class="bi bi-person-circle user-icon me-2"></i>
                <?= htmlspecialchars($_SESSION['nama_user']); ?>
            </a>
            <span class="divider">|</span>
            <a href="logout.php">Logout</a>
          <?php else: ?>
            <a href="login.php">Login</a>
            <span class="divider">|</span>
            <a href="signup.php">Sign Up</a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </header>

</body>
</html>
