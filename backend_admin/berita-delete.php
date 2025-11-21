<?php
require_once 'Berita.php';


if (isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);
    $berita = new Berita();
    $berita->requireAdmin();
    if ($berita->delete($ids)) {
        header("Location: ../berita-admin.php?delete=success");
    } else {
        header("Location: ../berita-admin.php?delete=error");
    }
    exit;
}

header("Location: ../berita-admin.php");
exit;
?>