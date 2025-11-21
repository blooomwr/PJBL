<?php
// Panggil Class Dashboard
require_once 'backend_admin/Dashboard.php'; 

// Inisialisasi Object (Otomatis cek login & start session)
$dashboard = new Dashboard();

// Ambil Data Admin dari Session
$nama_admin = $_SESSION['nama_user'];
$id_admin = $_SESSION['id_user'];

// Ambil Data Histori via Method Class
$logs = $dashboard->getRecentLogs();
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
    
    <div class="d-flex align-items-center justify-content-center gap-4">
      <img src="assets/NEW LOGO RQQ.png" class="profile-img">
      <div class="text-start">
        <h3 class="mb-0">Selamat Datang, <?= htmlspecialchars($nama_admin) ?></h3>
        <small><?= htmlspecialchars($id_admin) ?></small>
      </div>
    </div>

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

    <div class="history-box text-start">
      <h4>Histori Aktivitas Terakhir</h4>

      <?php if (!empty($logs)): ?>
          <?php foreach ($logs as $log): ?>
              <?php $tanggal = date('d-m-Y H:i', strtotime($log['timestamp'])); ?>
              
              <div style="border-bottom: 1px solid #dca950; padding-bottom: 10px; margin-bottom: 10px; line-height: 1.6;">
                <p class="mb-0">
                  <strong><?= htmlspecialchars($log['nama_admin']); ?></strong> (<?= htmlspecialchars($log['id_admin']); ?>) 
                  melakukan aksi: <strong><?= htmlspecialchars($log['aksi']); ?></strong>
                  (<?= htmlspecialchars($log['detail']); ?>)
                </p>
                <small class="text-muted">Pada: <?= $tanggal; ?></small>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <p>Belum ada histori aktivitas.</p>
      <?php endif; ?>
      
    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>