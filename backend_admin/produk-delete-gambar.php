<?php
include 'conn.php';

// Atur header sebagai JSON
header('Content-Type: application/json');

// Pastikan id_gambar ada
if (!isset($_GET['id_gambar'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID Gambar tidak ada']);
    exit;
}

$id_gambar = $_GET['id_gambar'];

// Hapus file fisik juga
$q = mysqli_query($conn, "SELECT nama_file FROM produk_gambar WHERE id_gambar='$id_gambar'");
$data = mysqli_fetch_assoc($q);
if ($data && file_exists("../gambar_produk/".$data['nama_file'])) {
    unlink("../gambar_produk/".$data['nama_file']);
}

// Hapus dari DB
$delete = mysqli_query($conn, "DELETE FROM produk_gambar WHERE id_gambar='$id_gambar'");

// ======================================================
// (DIUBAH) Hapus redirect dan ganti dengan JSON
// ======================================================
if ($delete) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal hapus dari database']);
}
exit;
?>