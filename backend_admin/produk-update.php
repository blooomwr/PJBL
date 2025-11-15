<?php
include 'conn.php';

// Atur header sebagai JSON
header('Content-Type: application/json');

// ======================================================
// (PERBAIKAN) Hapus 'if (isset($_POST['update']))' 
// karena 'name' dari tombol submit tidak terkirim via AJAX
// ======================================================

$id = $_POST['id_produk'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$kategori = $_POST['kategori'];
$varian = $_POST['varian'];
$is_bestseller = isset($_POST['is_bestseller']) ? 'Yes' : 'No';

// 🔹 Update data produk
$query = "UPDATE produk 
          SET nama='$nama', 
              deskripsi='$deskripsi', 
              harga='$harga', 
              varian='$varian', 
              stok='$stok', 
              kategori='$kategori',
              is_bestseller='$is_bestseller'
          WHERE id_produk='$id'";
mysqli_query($conn, $query);

// 🔹 Upload gambar tambahan (jika ada)
$folder = "../gambar_produk/";
if (!is_dir($folder)) mkdir($folder, 0777, true);

if (isset($_FILES['gambar'])) {
    foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp) {
        
        if ($_FILES['gambar']['error'][$key] == 0) {
            $nama_file = uniqid() . "_" . $_FILES['gambar']['name'][$key];
            move_uploaded_file($tmp, $folder . $nama_file);

            mysqli_query($conn, "INSERT INTO produk_gambar (id_produk, nama_file) VALUES ('$id', '$nama_file')");
        }
    }
}

echo json_encode(['status' => 'success']);
exit;

// ======================================================
// (PERBAIKAN) Hapus juga bagian 'else'
// ======================================================
?>