<?php
include 'conn.php';

// Atur header sebagai JSON
header('Content-Type: application/json');

// ================== PENJAGA KEAMANAN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak. Silakan login ulang.']);
    exit();
}
// ======================================================

$id = $_POST['id_berita'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$teks_berita = $_POST['teks_berita'];
$tanggal = $_POST['tanggal'];
$is_berita_utama = isset($_POST['is_berita_utama']) ? 'Yes' : 'No';
$foto_lama = $_POST['foto_lama'];

// 🔹 Logika Berita Utama
if ($is_berita_utama == 'Yes') {
    mysqli_query($conn, "UPDATE berita SET is_berita_utama = 'No' WHERE is_berita_utama = 'Yes'");
}

// 🔹 Logika Foto
$nama_file_db = $foto_lama; 
$folder = "../gambar_berita/";
if (!is_dir($folder)) mkdir($folder, 0777, true);

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    if (!empty($foto_lama) && file_exists($folder . $foto_lama)) {
        unlink($folder . $foto_lama);
    }
    $nama_file_db = uniqid() . "_" . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $nama_file_db);
}

// 🔹 Update data berita
$query = "UPDATE berita 
          SET judul='$judul', 
              deskripsi='$deskripsi', 
              teks_berita='$teks_berita', 
              foto='$nama_file_db', 
              tanggal='$tanggal',
              is_berita_utama='$is_berita_utama'
          WHERE id_berita='$id'";
mysqli_query($conn, $query);

// ================== LOGGING HISTORI ==================
$id_admin_log = $_SESSION['id_user'];
$nama_admin_log = $_SESSION['nama_user'];
$aksi_log = "Mengubah berita";
$detail_log = "$judul (ID: $id)";

$log_sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) 
            VALUES ('$id_admin_log', '$nama_admin_log', '$aksi_log', '$detail_log')";
mysqli_query($conn, $log_sql);
// ================== AKHIR LOGGING ==================

// (DIUBAH) Kirim status sukses sebagai JSON
echo json_encode(['status' => 'success']);
exit;
?>