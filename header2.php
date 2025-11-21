<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">

<style>
  /* === STYLE HEADER === */
  .header-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin: 20px auto;
    position: relative;
    z-index: 1000;
  }

  .logo-container {
    position: flex;
    left: 40px;
  }

  .logo-container img {
    height: 60px;
    width: auto;
  }

  .navbar-custom {
    background-color: #AE4C02;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 900px;
    
    /* FIX UKURAN */
    height: 60px !important;
    padding: 0 40px !important;
    box-sizing: border-box !important; 
  }

  .navbar-nav { margin: auto; }

  .nav-link {
    color: #fffaf3 !important;
    font-size: 18px;
    font-weight: 500;
    margin: 0 20px;
    transition: color 0.3s ease;
    
    /* FIX FONT & POSISI */
    font-family: 'Playfair Display', serif !important;
    line-height: 60px !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
  }

  .nav-link:hover { color: #ffd9b3 !important; }

  .auth-links {
    display: flex;
    align-items: center;
    gap: 10px;
    height: 100%;
  }

  .auth-links a {
    color: #fffaf3;
    text-decoration: none;
    font-size: 18px;
    transition: color 0.3s ease;
    font-family: 'Playfair Display', serif !important;
    line-height: 60px !important; 
  }

  .auth-links a:hover { color: #ffd9b3; }

  .divider { color: #fffaf3; }

  @media (max-width: 992px) {
    .navbar-custom {
      min-width: auto;
      width: 90%;
      height: auto !important;
      padding: 10px 20px !important;
      flex-direction: column;
    }
    .nav-link { line-height: normal !important; padding: 10px 0 !important; }
  }
</style>

<header class="header-container">
  <div class="logo-container">
    <img src="assets/NEW LOGO RQQ.png" alt="Rumah Que Que">
  </div>

  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid p-0">
      <ul class="navbar-nav d-flex flex-row justify-content-center flex-grow-1">
        <li class="nav-item"><a class="nav-link" href="home.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="katalog.php">Katalog</a></li>
        <li class="nav-item"><a class="nav-link" href="berita.php">Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Kami</a></li>
      </ul>

      <div class="auth-links">
        <a href="login.php">Login</a>
        <span class="divider">|</span>
        <a href="signup.php">Sign Up</a>
      </div>
    </div>
  </nav>
</header>