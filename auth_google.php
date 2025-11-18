<?php
// File: auth_google.php
session_start();

// ==========================================================
// !!! GANTI DENGAN KREDENSIAL DARI GOOGLE CLOUD CONSOLE !!!
// ==========================================================
$client_id = '450500029392-t6550sojd18q3p8kv7k6hj4okd6ltat5.apps.googleusercontent.com';
$redirect_uri = 'http://localhost/PJBL/callback.php'; 
// ==========================================================

$scope = 'email profile'; 
$state = bin2hex(random_bytes(16)); 

$_SESSION['oauth_state'] = $state;

// Membangun URL otorisasi Google (Parameter access_type=offline DIHILANGKAN)
$url = 'https://accounts.google.com/o/oauth2/v2/auth?' . 
       'scope=' . urlencode($scope) . 
       '&state=' . $state . 
       '&redirect_uri=' . urlencode($redirect_uri) . 
       '&response_type=code' . 
       '&client_id=' . $client_id;

// Mengarahkan pengguna ke Google
header('Location: ' . $url);
exit;
?>