<?php
include 'conn.php';

// Atur header sebagai JSON
header('Content-Type: application/json');

// (DIHAPUS) Pengecekan if (isset($_POST['update'])) dihapus 
// karena tidak terkirim oleh AJAX

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

// (DIUBAH) Kirim status sukses sebagai JSON
echo json_encode(['status' => 'success']);
exit;
?>