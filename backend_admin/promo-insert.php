<?php
include 'conn.php';

if (isset($_POST['tambah'])) {

    $nama = $_POST['nama'];

    // 🔹 Buat ID Promo baru (contoh: R01, R02, dst.)
    $q_id = mysqli_query($conn, "SELECT MAX(id_promo) AS max_id FROM promo");
    $d_id = mysqli_fetch_array($q_id);
    $no = (int) substr($d_id['max_id'], 1, 2);
    $no++;
    $char = "R"; // 'R' untuk P(r)omo
    $id = $char . sprintf("%02s", $no);

    // 🔹 Upload Foto (Hanya 1)
    $nama_file_db = ""; 
    $folder = "../gambar_promo/";
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $nama_file_db = uniqid() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $nama_file_db);
    }

    // 🔹 Insert promo ke tabel utama
    $insert_promo = "INSERT INTO promo (id_promo, nama, gambar)
                      VALUES ('$id', '$nama', '$nama_file_db')";
    mysqli_query($conn, $insert_promo);

    // 🔹 Kembali ke halaman promo
    header("Location: ../promo-admin.php?status=success");
    exit;
}
?>