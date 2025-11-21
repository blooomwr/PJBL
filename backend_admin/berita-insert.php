<?php
require_once 'Berita.php';

if (isset($_POST['tambah'])) {
    $berita = new Berita();
    $berita->requireAdmin();
    if ($berita->create($_POST, $_FILES)) {
        header("Location: ../berita-admin.php?status=success");
    } else {
        header("Location: ../berita-admin.php?status=error");
    }
    exit;
}
?>