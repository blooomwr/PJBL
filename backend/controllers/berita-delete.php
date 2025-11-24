<?php
// Wajib: Mulai output buffering untuk mencegah error "Headers already sent"
ob_start(); 

require_once '../models/Berita.php';


if (isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);
    $berita = new Berita();
    $berita->requireAdmin();
    if ($berita->delete($ids)) {
        // FIX JALUR: Naik dua tingkat ke root
        header("Location: ../../berita-admin.php?delete=success");
    } else {
        // FIX JALUR: Naik dua tingkat ke root
        header("Location: ../../berita-admin.php?delete=error");
    }
    // ob_end_flush() akan dilakukan secara otomatis saat exit, tapi exit wajib
    exit;
}

// Redirect default
header("Location: ../../berita-admin.php");
exit;
?>