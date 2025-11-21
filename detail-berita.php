<?php
require_once 'backend_admin/Berita.php';
$beritaObj = new Berita();

// Validasi ID
if (!isset($_GET['id'])) {
    header("Location: berita.php");
    exit();
}

$id_berita = $_GET['id'];

// 1. Ambil Detail Berita Ini
$q_detail = $beritaObj->query("SELECT * FROM berita WHERE id_berita = '$id_berita'");
$berita = $q_detail->fetch_assoc();

if (!$berita) {
    echo "<script>alert('Berita tidak ditemukan!'); window.location='berita.php';</script>";
    exit();
}

// 2. Ambil Berita Lainnya (Sidebar) - Kecuali berita yang sedang dibaca
$q_sidebar = $beritaObj->query("SELECT * FROM berita WHERE id_berita != '$id_berita' ORDER BY tanggal DESC LIMIT 10");

function tgl_indo($tanggal){
	$bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($berita['judul']); ?> - Rumah Que-Que</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="css01/detail-berita.css?v=<?= time(); ?>" rel="stylesheet">
</head>
<body>

    <?php 
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
        include 'header.php'; 
    } else {
        include 'header2.php'; 
    }
    ?>

    <main class="news-container">
        
        <article class="news-content">
            <span class="news-date"><?= tgl_indo($berita['tanggal']); ?></span>
            <h1 class="news-title"><?= htmlspecialchars($berita['judul']); ?></h1>
            
            <div class="news-image">
                <?php $img = !empty($berita['foto']) ? 'gambar_berita/'.$berita['foto'] : 'assets/no-image.png'; ?>
                <img src="<?= $img; ?>" alt="Foto Berita">
            </div>

            <div class="news-text">
                <?= nl2br(htmlspecialchars($berita['teks_berita'])); ?>
            </div>
            
            <a href="berita.php" class="back-link">← Kembali ke Berita</a>
        </article>

        <aside class="news-sidebar">
            <h3>Berita Lainnya</h3>
            <div class="sidebar-scroll">
                
                <?php while($row = $q_sidebar->fetch_assoc()): ?>
                    <?php $imgSide = !empty($row['foto']) ? 'gambar_berita/'.$row['foto'] : 'assets/no-image.png'; ?>
                    
                    <a href="detail-berita.php?id=<?= $row['id_berita']; ?>" class="side-card">
                        <div class="side-img">
                            <img src="<?= $imgSide; ?>">
                        </div>
                        <div class="side-info">
                            <h4><?= htmlspecialchars($row['judul']); ?></h4>
                            <small><?= tgl_indo($row['tanggal']); ?></small>
                        </div>
                    </a>
                <?php endwhile; ?>

            </div>
        </aside>

    </main>

    <?php include 'footer.php'; ?>

</body>
</html>