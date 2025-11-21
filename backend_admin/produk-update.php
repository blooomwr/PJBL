<?php
// Mulai output buffering agar tidak ada teks liar yang keluar
ob_start();

require_once 'Produk.php';

// Bersihkan semua output liar sebelum header JSON
ob_clean(); 

// Set Header JSON
header('Content-Type: application/json');

$produk = new Produk();
$produk->checkAuth();
// Panggil method update dari Class Produk
if ($produk->update($_POST, $_FILES)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal update database']);
}
exit;
?>