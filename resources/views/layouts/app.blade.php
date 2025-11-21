<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Que-Que')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            padding: 0;
            margin: 0;
            background-color: #fff3e0;
            font-family: 'Poppins', sans-serif !important;
            color: #5c3d2e;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }

        /* Header Styles */
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin: 20px auto;
            position: relative;
        }

        .logo-container {
            position: flex;
            left: 40px;
        }

        .logo-container img {
            height: 60px;
            width: auto;
        }

        .navbar-custom {
            background-color: #AE4C02;
            border-radius: 50px;
            padding: 10px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 900px;
        }

        .navbar-nav {
            margin: auto;
        }

        .nav-link {
            color: #fffaf3 !important;
            font-size: 18px;
            font-weight: 500;
            margin: 0 20px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #ffd9b3 !important;
        }

        .auth-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .auth-links a {
            color: #fffaf3;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #ffd9b3;
        }

        .divider {
            color: #fffaf3;
        }

        /* Footer Styles */
        .footer {
            background-color: #fdeedc;
            position: relative;
            padding: 60px 0 40px;
            border-top-left-radius: 100% 100%;
            border-top-right-radius: 100% 100%;
            font-family: 'Poppins', sans-serif;
        }

        .footer-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            color: #555;
            text-align: left;
        }

        .footer-logo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-logo img {
            width: 100px;
            margin-bottom: 10px;
        }

        .footer-logo h3 {
            color: #d97325;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-links a {
            text-decoration: none;
            color: #555;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: #d97325;
        }

        .footer-contact h4 {
            color: #444;
            margin-bottom: 10px;
        }

        .footer-contact p {
            margin: 4px 0;
            font-size: 0.9rem;
        }

        .footer-contact i {
            margin-right: 6px;
            color: #d97325;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header-container">
        <div class="logo-container">
            <img src="https://via.placeholder.com/60x60/AE4C02/ffffff?text=RQQ" alt="Rumah Que Que">
        </div>

        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <ul class="navbar-nav d-flex flex-row justify-content-center flex-grow-1">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Katalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about.index') }}">Tentang Kami</a></li>
                </ul>

                <div class="auth-links">
                    @auth
                        <a href="/dashboard">Dashboard</a>
                        <span class="divider">|</span>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <span class="divider">|</span>
                        <a href="{{ route('register') }}">Sign Up</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="https://via.placeholder.com/100x100/AE4C02/ffffff?text=RQQ" alt="Rumah Que Que">
            </div>

            <div class="footer-links">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('products.index') }}">Katalog Produk</a>
                <a href="#">Tentang Kami</a>
            </div>

            <div class="footer-contact">
                <h4>Hubungi kami</h4>
                <p><i class="bi bi-telephone"></i> +62 82123131234</p>
                <p><i class="bi bi-envelope"></i> quequeque@gmail.com</p>
                <p><i class="bi bi-geo-alt"></i> Jl. Aur Auran</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>