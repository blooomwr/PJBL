<?php
include 'connlog.php';
require_once 'backend/models/Pembeli.php'; // Panggil Class Pembeli

$error = '';
$success = '';
$pembeliObj = new Pembeli(); // Instansiasi Class

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password dan konfirmasi password
    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok.";
    } else {
        // PANGGIL METHOD REGISTER DARI CLASS PEMBELI
        $registerResult = $pembeliObj->register($email, $username, $password);

        if ($registerResult['status'] === 'success') {
            $success = $registerResult['message'];
            // Setelah berhasil, arahkan ke halaman login
            header("Location: login.php?signup=success");
            exit();
        } else {
            $error = $registerResult['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Rumah Que Que</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* ... styles remain the same ... */
    </style>
</head>

<body>

    <div class="signup-container">
        <a href="javascript:history.back()" class="back-link">
            <i class="bi bi-arrow-left"></i>
        </a>
        <img src="assets/NEW LOGO RQQ.png" alt="Rumah Que Que" class="logo-top">

        <h2>Sign Up</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="text" name="username" class="form-control" placeholder="Username" required>

            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <i class="bi bi-eye-slash toggle-password" data-target="password"></i>
            </div>

            <div class="form-group">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                <i class="bi bi-eye-slash toggle-password" data-target="confirm_password"></i>
            </div>

            <button type="submit" class="btn btn-signup">Sign Up</button>
        </form>

            <div class="divider-text"></div>

             <p class="mt-4">Have an account? <a href="login.php" class="text-decoration-none" style="color:#ae4c02; font-weight: bold;">Login</a></p>

            </div>
    </div>

    <?php include 'footer.php'; // Termasuk bagian footer 
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                targetInput.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>
</html>