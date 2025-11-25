<?php
include 'connlog.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // 1. Cek di tabel ADMIN
    $sql_admin = "SELECT * FROM admin WHERE username = '$username'";
    $result_admin = $conn->query($sql_admin);

    if ($result_admin && $result_admin->num_rows > 0) {
        $admin = $result_admin->fetch_assoc();

        // Cek password Admin 
        if (password_verify($password, $admin['password'])) {
            $_SESSION['role'] = 'admin';
            $_SESSION['id_user'] = $admin['id_admin'];
            $_SESSION['nama_user'] = $admin['nama_admin'];
            header("Location: admin-dashboard.php");
            exit();
        }
    }

    // 2. Cek di tabel PEMBELI HANYA JIKA BUKAN ADMIN
    $sql_pembeli = "SELECT * FROM pembeli WHERE username = '$username' OR email_pembeli = '$username'";
    $result_pembeli = $conn->query($sql_pembeli);

    if ($result_pembeli && $result_pembeli->num_rows > 0) {
        $pembeli = $result_pembeli->fetch_assoc();

        // Verifikasi password yang sudah di-hash untuk Pembeli
        if (password_verify($password, $pembeli['password'])) {
            $_SESSION['role'] = 'pembeli';
            $_SESSION['id_user'] = $pembeli['id_pembeli'];
            $_SESSION['nama_user'] = $pembeli['nama_pembeli'];

            header("Location: index.php");
            exit();
        }
    }

    // Jika tidak ada yang cocok
    $error = "Username atau password salah.";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rumah Que Que</title>
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

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            margin-top: 100px;
            text-align: center;
            position: relative;
        }

        .back-link {
            position: absolute;
            top: -50px;
            /* Disesuaikan agar berada di atas logo */
            left: -50px;
            font-size: 30px;
            color: #ae4c02;
            text-decoration: none;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #8a3c02;
        }

        .form-control {
            background-color: #ffeccf !important;
            border: none !important;
            border-radius: 30px !important;
            height: 55px;
            padding: 0 20px;
            margin-bottom: 20px;
        }

        .btn-login {
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

        .btn-login:hover {
            background-color: #8a3c02 !important;
        }

        .logo-top {
            width: 70px;
            margin-bottom: 50px;
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

    <div class="login-container">
        <a href="javascript:history.back()" class="back-link">
            <i class="bi bi-arrow-left"></i>
        </a>
        <img src="assets/NEW LOGO RQQ.png" alt="Rumah Que Que" class="logo-top">

        <h2>Login</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['signup']) && $_GET['signup'] == 'success'): ?>
            <div class="alert alert-success">Pendaftaran berhasil! Silakan Login.</div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="text" name="username" class="form-control" placeholder="Username" required>

            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <i class="bi bi-eye-slash toggle-password" data-target="password"></i>
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <p class="mt-4">Don't have an account? <a href="signup.php" class="text-decoration-none" style="color:#ae4c02; font-weight: bold;">Sign Up</a></p>

    </div>

    <?php include 'footer.php'; 
    ?>

    <!-- // Bootstrap JS -->
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