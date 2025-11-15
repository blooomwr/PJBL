<?php
include "conn.php";

if (!isset($_POST['ids'])) {
    header("Location: ../berita-admin.php");
    exit;
}

$ids = json_decode($_POST['ids'], true);

if (count($ids) == 0) {
    header("Location: ../berita-admin.php");
    exit;
}

$idList = "'" . implode("','", $ids) . "'";
$folder = "../gambar_berita/";

// Hapus semua gambar fisik berdasarkan id_berita
$q = mysqli_query($conn, "SELECT foto FROM berita WHERE id_berita IN ($idList)");
while ($img = mysqli_fetch_assoc($q)) {
    if (!empty($img['foto'])) {
        $filepath = $folder . $img['foto'];
        if (file_exists($filepath)) unlink($filepath);
    }
}

// Hapus dari tabel berita
mysqli_query($conn, "DELETE FROM berita WHERE id_berita IN ($idList)");

header("Location: ../berita-admin.php?delete=success");
exit;
?>