<?php
// Buffer output untuk mencegah teks "bocor"
ob_start();

require_once '../models/Promo.php';

// Bersihkan semua output sebelum mengirim JSON
ob_clean();

header('Content-Type: application/json');

$promo = new Promo();
$promo->requireAdmin();
if ($promo->update($_POST, $_FILES)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal update database']);
}
exit;
?>