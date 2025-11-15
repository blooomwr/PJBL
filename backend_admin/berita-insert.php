<?php
include 'conn.php';

if (isset($_POST['tambah'])) {

    // Ambil semua data dari form
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $teks_berita = $_POST['teks_berita'];
    $tanggal = $_POST['tanggal'];
    $is_berita_utama = isset($_POST['is_berita_utama']) ? 'Yes' : 'No';

    // 🔹 Buat ID Berita baru (contoh: B01, B02, dst.)
    $q_id = mysqli_query($conn, "SELECT MAX(id_berita) AS max_id FROM berita");
    $d_id = mysqli_fetch_array($q_id);
    $no = (int) substr($d_id['max_id'], 1, 2);
    $no++;
    $char = "B";
    $id = $char . sprintf("%02s", $no);

    // 🔹 Logika Berita Utama: Jika ini 'Yes', set semua yang lain 'No'
    if ($is_berita_utama == 'Yes') {
        mysqli_query($conn, "UPDATE berita SET is_berita_utama = 'No' WHERE is_berita_utama = 'Yes'");
    }

    // 🔹 Upload Foto (Hanya 1)
    $nama_file_db = ""; // Nama file untuk disimpan ke DB
    $folder = "../gambar_berita/";
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $nama_file_db = uniqid() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $nama_file_db);
    }

    // 🔹 Insert berita ke tabel utama
    $insert_berita = "INSERT INTO berita (id_berita, judul, deskripsi, teks_berita, foto, tanggal, is_berita_utama)
                      VALUES ('$id', '$judul', '$deskripsi', '$teks_berita', '$nama_file_db', '$tanggal', '$is_berita_utama')";
    mysqli_query($conn, $insert_berita);

    // 🔹 Kembali ke halaman berita
    header("Location: ../berita-admin.php?status=success");
    exit;
}
?>