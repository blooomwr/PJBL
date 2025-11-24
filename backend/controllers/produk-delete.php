<?php
require_once '../models/Produk.php';

if (isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);
    $produk = new Produk();
    $produk->checkAuth();
    if ($produk->delete($ids)) {
        header("Location: ../../produk-admin.php?delete=success");
    } else {
        header("Location: ../../produk-admin.php?delete=error");
    }
    exit;
}

header("Location: ../produk-admin.php");
exit;
?>