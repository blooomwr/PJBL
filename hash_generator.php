<?php
$password_admin = '12345';
$hashed_password = password_hash($password_admin, PASSWORD_DEFAULT);
echo $hashed_password;
// Contoh Hasil: $2y$10$wT2B1yC12kE43M09tP4p.uB61Wd3d1P9iXnK.j1Y2aH3kQ1qT5L9M
?>