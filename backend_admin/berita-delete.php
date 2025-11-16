<?php
include "conn.php";

// ================== PENJAGA KEAMANAN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
// ======================================================

if (!isset($_POST['ids'])) {
    header("Location: ../berita-admin.php");
    exit;
}

$ids = json_decode($_POST['ids'], true);
$idCount = count($ids); // Hitung jumlah

if ($idCount == 0) {
    header("Location: ../berita-admin.php");
    exit;
}

$idList = "'" . implode("','", $ids) . "'";
$folder = "../gambar_berita/";

// Hapus semua gambar fisik
$q = mysqli_query($conn, "SELECT foto FROM berita WHERE id_berita IN ($idList)");
while ($img = mysqli_fetch_assoc($q)) {
    if (!empty($img['foto'])) {
        $filepath = $folder . $img['foto'];
        if (file_exists($filepath)) unlink($filepath);
    }
}

// Hapus dari tabel berita
mysqli_query($conn, "DELETE FROM berita WHERE id_berita IN ($idList)");

// ================== LOGGING HISTORI ==================
$id_admin_log = $_SESSION['id_user'];
$nama_admin_log = $_SESSION['nama_user'];
$aksi_log = "Menghapus berita";
$detail_log_raw = "Total $idCount berita dihapus. (IDs: $idList)"; // <-- Teks asli

// === PERBAIKAN: Amankan string sebelum dimasukkan ke SQL ===
$detail_log_safe = mysqli_real_escape_string($conn, $detail_log_raw);

$log_sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) 
            VALUES ('$id_admin_log', '$nama_admin_log', '$aksi_log', '$detail_log_safe')"; // <-- Gunakan var aman
mysqli_query($conn, $log_sql);
// ================== AKHIR LOGGING ==================

header("Location: ../berita-admin.php?delete=success");
exit;
?>