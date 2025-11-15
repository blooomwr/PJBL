<?php
include 'conn.php';

if (isset($_POST['tambah'])) {

    // Ambil semua data dari form
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];

    // Data baru
    $varian = $_POST['varian']; // Ambil Varian
    $is_bestseller = isset($_POST['is_bestseller']) ? 'Yes' : 'No'; // Cek jika checkbox ditandai

    // 🔹 Buat ID Produk baru (contoh: P05, P06, dst.)
    $q_id = mysqli_query($conn, "SELECT MAX(id_produk) AS max_id FROM produk");
    $d_id = mysqli_fetch_array($q_id);
    $no = (int) substr($d_id['max_id'], 1, 2);
    $no++;
    $char = "P";
    $id = $char . sprintf("%02s", $no);


    // 🔹 Insert produk ke tabel utama
    $insert_produk = "INSERT INTO produk (id_produk, nama, deskripsi, harga, varian, stok, kategori, is_bestseller)
                      VALUES ('$id', '$nama', '$deskripsi', '$harga', '$varian', '$stok', '$kategori', '$is_bestseller')";
    mysqli_query($conn, $insert_produk);

    // 🔹 Pastikan folder penyimpanan ada
    $folder = "../gambar_produk/";
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    // 🔹 Upload banyak gambar
    if (isset($_FILES['gambar']) && count($_FILES['gambar']['name']) > 0) {
        foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp) {
            if ($_FILES['gambar']['error'][$key] == 0) {
                $nama_file = uniqid() . "_" . $_FILES['gambar']['name'][$key];
                move_uploaded_file($tmp, $folder . $nama_file);

                // Simpan ke tabel produk_gambar
                $insert_gambar = "INSERT INTO produk_gambar (id_produk, nama_file) 
                                  VALUES ('$id', '$nama_file')";
                mysqli_query($conn, $insert_gambar);
            }
        }
    }

    // 🔹 Kembali ke halaman produk
    header("Location: ../produk-admin.php?status=success");
    exit;
}
?>