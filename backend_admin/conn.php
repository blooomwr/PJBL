<?php
$host = "localhost";
$user = "root";     // sesuaikan kalau beda
$pass = "";         // sesuaikan kalau ada password
$db   = "PJBL";     // nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
