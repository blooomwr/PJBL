<?php
include "conn.php";

if (!isset($_POST['ids'])) {
    header("Location: ../produk-admin.php");
    exit;
}

$ids = json_decode($_POST['ids'], true);

if (count($ids) == 0) {
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

header("Location: ../produk-admin.php?delete=success");
exit;
