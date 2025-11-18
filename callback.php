<?php
// File: callback.php
include 'connlog.php'; 

if (isset($_GET['code'])) {
    
    // ==========================================================
    // !!! GANTI DENGAN KREDENSIAL DARI GOOGLE CLOUD CONSOLE !!!
    // ==========================================================
    $client_id = '450500029392-t6550sojd18q3p8kv7k6hj4okd6ltat5.apps.googleusercontent.com';
    $client_secret = 'KLBtTgQUSvyfDk1wbWR39d8nu6y';
    $redirect_uri = 'http://localhost/PJBL/callback.php'; 
    // ==========================================================

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

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($response, true);
    
    if (!isset($token_data['access_token'])) {
        $error_msg = $token_data['error_description'] ?? 'Gagal mendapatkan Access Token dari Google.';
        header("Location: signup.php?error=" . urlencode($error_msg));
        exit();
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

    // 4. Proses Login atau Register ke Database
    $email = $conn->real_escape_string($user_data['email']);
    $nama = $conn->real_escape_string($user_data['name'] ?? 'Pengguna Baru');
    $username = explode('@', $email)[0]; 

    // Cek apakah user sudah terdaftar
    $sql = "SELECT id_pembeli, nama_pembeli FROM pembeli WHERE email_pembeli = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // A. LOGIN: User sudah ada
        $pembeli = $result->fetch_assoc();
        $_SESSION['role'] = 'pembeli';
        $_SESSION['id_user'] = $pembeli['id_pembeli'];
        $_SESSION['nama_user'] = $pembeli['nama_pembeli'];
        header("Location: HomeUtama.php"); 
        exit();
    } else {
        // B. REGISTER: User baru
        $sql_insert = "INSERT INTO pembeli (email_pembeli, username, nama_pembeli, password) 
                       VALUES ('$email', '$username', '$nama', NULL)"; // Password NULL
                       
        if ($conn->query($sql_insert) === TRUE) {
            // Login setelah register
            $_SESSION['role'] = 'pembeli';
            $_SESSION['id_user'] = $conn->insert_id;
            $_SESSION['nama_user'] = $nama;
            header("Location: HomeUtama.php?signup=google_success");
            exit();
        } else {
            die("Gagal mendaftar user baru: " . $conn->error);
        }
    }

} else {
    header("Location: signup.php?error=otorisasi_dibatalkan");
    exit();
}
?>