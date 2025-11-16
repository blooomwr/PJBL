<?php
include "conn.php";

// ================== PENJAGA KEAMANAN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
// ======================================================

if (!isset($_POST['ids'])) {
    header("Location: ../produk-admin.php");
    exit;
}

$ids = json_decode($_POST['ids'], true);
$idCount = count($ids); // Hitung jumlah ID

if ($idCount == 0) {
    header("Location: ../produk-admin.php");
    exit;
}

// Hapus semua gambar fisik berdasarkan id_produk
foreach ($ids as $id) {
    $q = mysqli_query($conn, "SELECT nama_file FROM produk_gambar WHERE id_produk='$id'");
    while ($img = mysqli_fetch_assoc($q)) {
        $filepath = "../gambar_produk/" . $img['nama_file'];
        if (file_exists($filepath)) unlink($filepath);
    }
}

// Hapus dari tabel produk_gambar
$idList = "'" . implode("','", $ids) . "'";
mysqli_query($conn, "DELETE FROM produk_gambar WHERE id_produk IN ($idList)");

// Hapus dari tabel produk
mysqli_query($conn, "DELETE FROM produk WHERE id_produk IN ($idList)");

// ================== LOGGING HISTORI ==================
$id_admin_log = $_SESSION['id_user'];
$nama_admin_log = $_SESSION['nama_user'];
$aksi_log = "Menghapus produk";
$detail_log_raw = "Total $idCount produk dihapus. (IDs: $idList)"; // <-- Teks asli

// === PERBAIKAN SQL: Amankan string sebelum dimasukkan ke SQL ===
$detail_log_safe = mysqli_real_escape_string($conn, $detail_log_raw);

$log_sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) 
            VALUES ('$id_admin_log', '$nama_admin_log', '$aksi_log', '$detail_log_safe')"; // <-- Gunakan var aman
mysqli_query($conn, $log_sql);
// ================== AKHIR LOGGING ==================

header("Location: ../produk-admin.php?delete=success");
exit;
?>