<?php
require_once 'Promo.php';

if (isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);
    $promo = new Promo();
    $promo->requireAdmin();
    if ($promo->delete($ids)) {
        header("Location: ../promo-admin.php?delete=success");
    } else {
        header("Location: ../promo-admin.php?delete=error");
    }
    exit;
}

header("Location: ../promo-admin.php");
exit;
?>