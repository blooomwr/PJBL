<?php
require_once 'Produk.php';
header('Content-Type: application/json');

if (isset($_GET['id_gambar'])) {
    $produk = new Produk();
    $produk->checkAuth();
    if ($produk->deleteImage($_GET['id_gambar'])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal hapus gambar']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
exit;
?>