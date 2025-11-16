<?php
include 'conn.php';

// Atur header sebagai JSON
header('Content-Type: application/json');

// ================== PENJAGA KEAMANAN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak. Silakan login ulang.']);
    exit();
}
// ======================================================

// Pastikan id_gambar ada
if (!isset($_GET['id_gambar'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID Gambar tidak ada']);
    exit;
}

$id_gambar = $_GET['id_gambar'];

// Hapus file fisik juga
$q = mysqli_query($conn, "SELECT nama_file FROM produk_gambar WHERE id_gambar='$id_gambar'");
$data = mysqli_fetch_assoc($q);
$nama_file_log = "N/A";

if ($data) {
    $nama_file_log = $data['nama_file']; // Simpan nama file untuk log
    if (file_exists("../gambar_produk/".$data['nama_file'])) {
        unlink("../gambar_produk/".$data['nama_file']);
    }
}

// Hapus dari DB
$delete = mysqli_query($conn, "DELETE FROM produk_gambar WHERE id_gambar='$id_gambar'");

if ($delete) {
    // ================== LOGGING HISTORI ==================
    $id_admin_log = $_SESSION['id_user'];
    $nama_admin_log = $_SESSION['nama_user'];
    $aksi_log = "Menghapus 1 gambar produk";
    $detail_log = "File: $nama_file_log (ID Gambar: $id_gambar)";

    $log_sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) 
                VALUES ('$id_admin_log', '$nama_admin_log', '$aksi_log', '$detail_log')";
    mysqli_query($conn, $log_sql);
    // ================== AKHIR LOGGING ==================

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal hapus dari database']);
}
exit;
?>