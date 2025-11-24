<?php
$password_plain = '12345';
// Gunakan algoritma hashing yang kuat
$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);
echo "Password Hashed: " . $hashed_password;
?>