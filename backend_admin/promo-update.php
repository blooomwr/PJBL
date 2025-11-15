<?php
include 'conn.php';

// Atur header sebagai JSON
header('Content-Type: application/json');

$id = $_POST['id_promo'];
$nama = $_POST['nama'];
$gambar_lama = $_POST['gambar_lama'];

// 🔹 Logika Foto
$nama_file_db = $gambar_lama; 
$folder = "../gambar_promo/"; // Path server-side perlu ../
if (!is_dir($folder)) mkdir($folder, 0777, true);

if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    if (!empty($gambar_lama) && file_exists($folder . $gambar_lama)) {
        unlink($folder . $gambar_lama);
    }
    $nama_file_db = uniqid() . "_" . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $nama_file_db);
}

// 🔹 Update data promo
$query = "UPDATE promo SET nama='$nama', gambar='$nama_file_db' WHERE id_promo='$id'";
mysqli_query($conn, $query);

// Kirim status sukses sebagai JSON
echo json_encode(['status' => 'success']);
exit;
?>