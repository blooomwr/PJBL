<?php
require_once __DIR__ . '/../models/wishlist.php'; // Pake __DIR__ agar aman
header('Content-Type: application/json');

// 1. INSTANSIASI DULU (Agar Session Start di Database.php jalan)
$wishlistObj = new Wishlist();

// 2. BARU CEK LOGIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pembeli') {
    echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu untuk belanja.']);
    exit;
}

$action = $_POST['action'] ?? '';
$id_user = $_SESSION['id_user'];

if ($action == 'add') {
    $id_produk = $_POST['id_produk'];
    $qty = $_POST['qty'];
    $varian = $_POST['varian'];

    $res = $wishlistObj->addToWishlist($id_user, $id_produk, $qty, $varian);
    echo json_encode($res);
} 
elseif ($action == 'update') {
    $res = $wishlistObj->updateQuantity($_POST['id'], $_POST['change']);
    echo json_encode($res);
}
?>