<?php
// Buffer output untuk mencegah teks "bocor"
ob_start();

require_once '../models/Berita.php';

// Bersihkan semua output sebelum mengirim JSON
ob_clean();

header('Content-Type: application/json');

$berita = new Berita();
$berita->requireAdmin();
if ($berita->update($_POST, $_FILES)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal update database']);
}
exit;
?>