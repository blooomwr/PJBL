<?php
// nanti kalau sudah ada login, nama admin bisa diambil dari session
$nama_admin = "Admin";
$id_admin = "J04032895829";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
  font-family: "Playfair Display", serif;
  background: linear-gradient(to bottom, #fff4db, #fffaf1);
}

/* Foto Profil */
.profile-img {
  width: 85px;
  height: 85px;
  border-radius: 50%;
  object-fit: cover;
}

/* Container Dashboard */
.dashboard-box {
  max-width: 1100px;
  margin: 40px auto;
}

/* Tombol Bulat */
.menu-circle {
  width: 160px;
  height: 160px;
  background-color: #e9a93a;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: 0.3s;
}
.menu-circle:hover {
  background-color: #cf8f24;
  transform: translateY(-4px);
}
.menu-circle i {
  font-size: 46px;
  color: #6b3600;
}

/* Box Histori */
.history-box {
  background-color: #f6c46b;
  border-radius: 25px;
  padding: 25px;
  margin-top: 50px;
  font-size: 18px;
}
</style>
</head>
<body>

<div class="dashboard-box text-center">
    
    <!-- Bagian Profil MASIH CONTOH -->
    <div class="d-flex align-items-center justify-content-center gap-4">
      <img src="NEW LOGO RQQ.png" class="profile-img">
      <div class="text-start">
        <h3 class="mb-0">Selamat Datang, <?= $nama_admin ?></h3>
        <small><?= $id_admin ?></small>
      </div>
    </div>

    <!-- Tombol Menu -->
    <div class="d-flex justify-content-center gap-5 mt-5">
      <a href="berita-admin.php" class="text-decoration-none">
        <div class="menu-circle"><i class="bi bi-pencil-square"></i></div>
      </a>

      <a href="promo-admin.php" class="text-decoration-none">
        <div class="menu-circle"><i class="bi bi-wallet2"></i></div>
      </a>

      <a href="produk-admin.php" class="text-decoration-none">
        <div class="menu-circle"><i class="bi bi-basket"></i></div>
      </a>
    </div>

    <!-- Riwayat MASIH CONTOH -->
    <div class="history-box text-start">
      <h4>Histori</h4>
      <p style="line-height:1.6;">
        Admin ID J040324768 mengubah stok "Ketan Serikaya" pada 13-07-2025 13:27
      </p>
    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
