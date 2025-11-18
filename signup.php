<?php
include 'connlog.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nama_pembeli = $username; // Menggunakan username sebagai nama default

    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok.";
    } else {
        // Cek apakah email/username sudah ada
        $check = $conn->query("SELECT email_pembeli, username FROM pembeli WHERE email_pembeli='$email' OR username='$username'");
        if ($check->num_rows > 0) {
            $error = "Email atau Username sudah terdaftar.";
        } else {
            // Hash password sebelum disimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO pembeli (email_pembeli, username, password, nama_pembeli) VALUES ('$email', '$username', '$hashed_password', '$nama_pembeli')";

            if ($conn->query($sql) === TRUE) {
                $success = "Pendaftaran berhasil! Silakan Login.";
                // Setelah berhasil, arahkan ke halaman login
                header("Location: login.php?signup=success");
                exit();
            } else {
                $error = "Error: " . $conn->error;
            }
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
        body {
            font-family: 'Playfair Display', serif;
            background: linear-gradient(to bottom, #fdeedc, #fffaf3);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .signup-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            margin-top: 50px;
            text-align: center;
        }

        .form-control {
            background-color: #ffeccf !important;
            border: none !important;
            border-radius: 30px !important;
            height: 55px;
            padding: 0 20px;
            margin-bottom: 20px;
        }

        .btn-signup {
            background-color: #ae4c02 !important;
            border: none !important;
            color: white !important;
            font-weight: bold;
            padding: 12px 0;
            width: 100%;
            border-radius: 30px;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        .btn-signup:hover {
            background-color: #8a3c02 !important;
        }

        .divider-text {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #777;
        }

        .divider-text::before,
        .divider-text::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background: #ccc;
            margin: 0 10px;
        }

        .social-icons img {
            width: 50px;
            height: 50px;
            margin: 0 10px;
            cursor: pointer;
        }

        .logo-top {
            width: 70px;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        footer {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="signup-container">
        <img src="NEW LOGO RQQ.png" alt="Rumah Que Que" class="logo-top">

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

        <div class="divider-text">Or sign up with</div>

        <div class="social-icons d-flex justify-content-center gap-3 mt-3">
            <a href="auth_google.php" class="btn btn-light border" style="width: 120px; color: #555;">
                <i class="bi bi-google"></i> Google
            </a>

            <a href="#" class="btn btn-light border" style="width: 120px; color: #555; background-color: #eee;">
                <i class="bi bi-facebook"></i> Facebook
            </a>

            <a href="#" class="btn btn-light border" style="width: 120px; color: #555; background-color: #eee;">
                <i class="bi bi-twitter-x"></i> X
            </a>
        </div>

        <p class="mt-4">Have an account? <a href="login.php" class="text-decoration-none" style="color:#ae4c02; font-weight: bold;">Login</a></p>

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