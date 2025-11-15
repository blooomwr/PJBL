<?php
include "conn.php";

if (!isset($_POST['ids'])) {
    header("Location: ../promo-admin.php");
    exit;
}

$ids = json_decode($_POST['ids'], true);

if (count($ids) == 0) {
    header("Location: ../promo-admin.php");
    exit;
}

$idList = "'" . implode("','", $ids) . "'";
$folder = "../gambar_promo/"; // Path server-side perlu ../

// Hapus semua gambar fisik berdasarkan id_promo
$q = mysqli_query($conn, "SELECT gambar FROM promo WHERE id_promo IN ($idList)");
while ($img = mysqli_fetch_assoc($q)) {
    if (!empty($img['gambar'])) {
        $filepath = $folder . $img['gambar'];
        if (file_exists($filepath)) unlink($filepath);
    }
}

// Hapus dari tabel promo
mysqli_query($conn, "DELETE FROM promo WHERE id_promo IN ($idList)");

header("Location: ../promo-admin.php?delete=success");
exit;
?>