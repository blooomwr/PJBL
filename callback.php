<?php
// File: callback.php
include 'connlog.php'; 
include 'config_secrets.php'; // ⬅️ TAMBAHKAN INI

if (isset($_GET['code'])) {
    

    $client_id = GOOGLE_CLIENT_ID;
    $client_secret = GOOGLE_CLIENT_SECRET;
    $redirect_uri = 'http://localhost/PJBL/callback.php'; 
    // ... (sisa kode) ...

    $code = $_GET['code'];

    // 1. Cek Token CSRF
    if (!isset($_GET['state']) || !isset($_SESSION['oauth_state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
        header("Location: signup.php?error=csrf_token_mismatch");
        exit();
    }
    unset($_SESSION['oauth_state']);

    // 2. Pertukaran Code dengan Access Token (Menggunakan cURL)
    $token_url = 'https://oauth2.googleapis.com/token';
    $fields = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri, // Menggunakan URI tanpa query parameter
        'grant_type' => 'authorization_code'
    ];

    // ... (omitted code for Step 2) ...
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    // 🛑 TAMBAHKAN BARIS DEBUG INI 🛑
    if (curl_errno($ch)) {
        die("cURL Error (Token Exchange): " . curl_error($ch));
    }
    // 🛑 TAMBAHKAN BARIS DEBUG INI 🛑

    curl_close($ch);

    $token_data = json_decode($response, true);

    if (!isset($token_data['access_token'])) {
        // 🚨 GANTI KODE DI SINI 🚨

        // Tampilkan respons mentah yang diterima dari Google
        die("Gagal Tukar Token. Respon Mentah Google: " . $response);
    }

    $access_token = $token_data['access_token'];

    // 3. Ambil Data Profil Pengguna
    $profile_url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=' . $access_token;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $profile_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $profile_response = curl_exec($ch);
    curl_close($ch);

    $user_data = json_decode($profile_response, true);

    if (!isset($user_data['email'])) {
        header("Location: signup.php?error=gagal_ambil_email");
        exit();
    }

    // ... (setelah $user_data berhasil didapatkan) ...

    // 4. Proses Login atau Register ke Database
    $email = $conn->real_escape_string($user_data['email']);
    $nama = $conn->real_escape_string($user_data['name'] ?? 'Pengguna Baru');

    // 🚨 FIX: Gunakan ID unik dari Google sebagai username dasar untuk menghindari konflik
    // Tambahkan prefix 'google_' jika Anda memiliki ID unik dari Google di $user_data
    $username_base = explode('@', $email)[0];

    // Cek apakah user sudah terdaftar
    $sql = "SELECT id_pembeli, nama_pembeli FROM pembeli WHERE email_pembeli = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // A. LOGIN: User sudah ada
        // ... (login logic sudah benar)
    } else {
        // B. REGISTER: User baru

        // Cek dan buat username unik jika sudah ada
        $username = $username_base;
        $i = 1;
        while ($conn->query("SELECT username FROM pembeli WHERE username = '$username'")->num_rows > 0) {
            $username = $username_base . $i++;
        }

        $sql_insert = "INSERT INTO pembeli (email_pembeli, username, nama_pembeli, password) 
                       VALUES ('$email', '$username', '$nama', NULL)";

        if ($conn->query($sql_insert) === TRUE) {
            // Login setelah register (logic sudah benar)
            // ...
            header("Location: HomeUtama.php?signup=google_success");
            exit();
        } else {
            // 🚨 Tampilkan error database agar tahu penyebab gagal register
            die("Gagal mendaftar user baru. Error SQL: " . $conn->error);
        }
    }
} else {
    header("Location: signup.php?error=otorisasi_dibatalkan");
    exit();
}
