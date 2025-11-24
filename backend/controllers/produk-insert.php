<?php
require_once '../models/Produk.php';

if (isset($_POST['tambah'])) {
    $produk = new Produk();
    $produk->checkAuth();
    if ($produk->create($_POST, $_FILES)) {
        header("Location: ../../produk-admin.php?status=success");
    } else {
        header("Location: ../../produk-admin.php?status=error");
    }
    exit;
}
?>