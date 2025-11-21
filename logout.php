<?php
session_start();
session_unset();
session_destroy();

// Arahkan kembali ke halaman utama
header("Location: Home.php");
exit();
?>