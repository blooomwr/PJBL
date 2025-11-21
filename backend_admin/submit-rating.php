<?php
require_once 'Produk.php'; 

$produkObj = new Produk(); // Start Session

header('Content-Type: application/json');

// Cek Login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pembeli') {
    echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = $_POST['id_produk'];
    $rating = $_POST['rating'];
    $kode = $_POST['kode_review'];
    
    // Ambil ID Pembeli dari Session
    $id_pembeli = $_SESSION['id_user'];

    // Kirim ke method addRating
    $result = $produkObj->addRating($id_produk, $rating, $kode, $id_pembeli);
    
    echo json_encode($result);
    exit;
}
?>