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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@300;400;700&display=swap" rel="stylesheet">

<style>
body {
  font-family: "Inria Serif", serif;
  background: linear-gradient(to bottom, #fff4db, #fffaf1);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* Container Dashboard */
.dashboard-box {
  max-width: 1100px;
  margin: 40px auto;
  padding: 0 20px;
  flex: 1; /* Agar footer terdorong ke bawah */
}

/* Profil Section */
.profile-section {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  text-align: left;
}

.profile-img {
  width: 85px;
  height: 85px;
  object-fit: cover;
  
}

/* Tombol Menu Bulat */
.menu-container {
  display: flex;
  justify-content: center;
  gap: 40px; /* Jarak default desktop */
  margin-top: 3rem;
  flex-wrap: wrap; /* Agar turun ke bawah di HP */
}

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
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.menu-circle:hover {
  background-color: #cf8f24;
  transform: translateY(-4px);
}

.menu-circle i {
  font-size: 46px;
  color: #6b3600;
}

/* Label Menu (Opsional, agar user tau icon apa) */
.menu-label {
  margin-top: 10px;
  font-weight: bold;
  color: #6b3600;
  display: block;
  text-align: center;
}

/* Box Histori */
.history-box {
  background-color: #f6c46b;
  border-radius: 25px;
  padding: 30px;
  margin-top: 50px;
  margin-bottom: 40px;
  font-size: 18px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* === RESPONSIVE (MOBILE) === */
@media (max-width: 768px) {
  .dashboard-box {
    margin: 20px auto;
  }

  .profile-section {
    flex-direction: column; /* Foto di atas, nama di bawah */
    text-align: center;
    gap: 10px;
  }
  
  .text-start {
    text-align: center !important;
  }

  .menu-container {
    gap: 20px; /* Jarak diperkecil */
  }

  .menu-circle {
    width: 110px;  /* Ukuran tombol diperkecil */
    height: 110px;
  }

  .menu-circle i {
    font-size: 32px; /* Icon diperkecil */
  }
  
  .history-box {
    padding: 20px;
    font-size: 16px;
  }
  
  h3 { font-size: 1.5rem; }
  h4 { font-size: 1.3rem; }
}
</style>
</head>
<body>

<div class="dashboard-box text-center">
    
    <div class="profile-section">
      <img src="assets/PP.png" class="profile-img" alt="Profile">
      <div class="text-start">
        <h3 class="mb-0 fw-bold">Selamat Datang, <?= htmlspecialchars($nama_admin) ?></h3>
        <small class="text-muted fs-6">ID: <?= htmlspecialchars($id_admin) ?></small>
      </div>
    </div>

    <div class="menu-container">
      <a href="berita-admin.php" class="text-decoration-none">
        <div class="menu-circle" title="Kelola Berita">
            <i class="bi bi-pencil-square"></i>
        </div>
        <span class="menu-label">Berita</span>
      </a>

      <a href="promo-admin.php" class="text-decoration-none">
        <div class="menu-circle" title="Kelola Promo">
            <i class="bi bi-wallet2"></i>
        </div>
        <span class="menu-label">Promo</span>
      </a>

      <a href="produk-admin.php" class="text-decoration-none">
        <div class="menu-circle" title="Kelola Produk">
            <i class="bi bi-basket"></i>
        </div>
        <span class="menu-label">Produk</span>
      </a>
    </div>

    <div class="history-box text-start">
      <h4 class="fw-bold mb-4"><i class="bi bi-clock-history me-2"></i> Histori Aktivitas Terakhir</h4>

      <?php if (!empty($logs)): ?>
          <?php foreach ($logs as $log): ?>
              <?php $tanggal = date('d/m/Y H:i', strtotime($log['timestamp'])); ?>
              
              <div style="border-bottom: 1px solid rgba(107, 54, 0, 0.2); padding-bottom: 12px; margin-bottom: 12px; line-height: 1.5;">
                <p class="mb-1">
                  <strong style="color: #6b3600;"><?= htmlspecialchars($log['nama_admin']); ?></strong> 
                  <span class="badge bg-warning text-dark" style="font-size: 0.75rem;"><?= htmlspecialchars($log['aksi']); ?></span>
                  <span><?= htmlspecialchars($log['detail']); ?></span>
                </p>
                <small style="color: #5a5a5a; font-size: 0.85rem;"><i class="bi bi-calendar3"></i> <?= $tanggal; ?></small>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <p class="text-center">Belum ada histori aktivitas.</p>
      <?php endif; ?>
      
    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>