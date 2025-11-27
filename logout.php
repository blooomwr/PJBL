<?php
// Panggil koneksi (agar session start)
include 'connlog.php'; 
// Panggil model yang berisi logic logout
require_once 'backend/models/Pembeli.php'; 

$pembeliObj = new Pembeli();

// PANGGIL METHOD LOGOUT DARI CLASS
$pembeliObj->logout();

// Arahkan kembali ke halaman utama
header("Location: index.php");
exit();
?>