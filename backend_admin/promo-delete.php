<?php
include "conn.php";

// ================== PENJAGA KEAMANAN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
// ======================================================

if (!isset($_POST['ids'])) {
    header("Location: ../promo-admin.php");
    exit;
}

$ids = json_decode($_POST['ids'], true);
$idCount = count($ids); // Hitung jumlah

if ($idCount == 0) {
    header("Location: ../promo-admin.php");
    exit;
}

$idList = "'" . implode("','", $ids) . "'";
$folder = "../gambar_promo/"; // Path server-side perlu ../

// Hapus semua gambar fisik
$q = mysqli_query($conn, "SELECT gambar FROM promo WHERE id_promo IN ($idList)");
while ($img = mysqli_fetch_assoc($q)) {
    if (!empty($img['gambar'])) {
        $filepath = $folder . $img['gambar'];
        if (file_exists($filepath)) unlink($filepath);
    }
}

// Hapus dari tabel promo
mysqli_query($conn, "DELETE FROM promo WHERE id_promo IN ($idList)");

// ================== LOGGING HISTORI ==================
$id_admin_log = $_SESSION['id_user'];
$nama_admin_log = $_SESSION['nama_user'];
$aksi_log = "Menghapus promo";
$detail_log_raw = "Total $idCount promo dihapus. (IDs: $idList)"; // <-- Teks asli

// === PERBAIKAN: Amankan string sebelum dimasukkan ke SQL ===
$detail_log_safe = mysqli_real_escape_string($conn, $detail_log_raw);

$log_sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) 
            VALUES ('$id_admin_log', '$nama_admin_log', '$aksi_log', '$detail_log_safe')"; // <-- Gunakan var aman
mysqli_query($conn, $log_sql);
// ================== AKHIR LOGGING ==================

header("Location: ../promo-admin.php?delete=success");
exit;
?>