<?php
$servername = "localhost";
$username = "root"; // <-- GANTI USERNAME
$password = "";      // <-- GANTI PASSWORD (dikosongkan jika default)
$dbname = "pjbl";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mulai session
session_start();
?>