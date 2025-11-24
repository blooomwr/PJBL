<?php
require_once '../models/Promo.php';

if (isset($_POST['tambah'])) {
    $promo = new Promo();
    $promo->requireAdmin();
    
    if ($promo->create($_POST, $_FILES)) {
        header("Location: ../../promo-admin.php?status=success");
    } else {
        header("Location: ../../promo-admin.php?status=error");
    }
    exit;
}
?>