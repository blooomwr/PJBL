{{-- File: resources/views/partials/_header_nav.blade.php --}}

<header class="header-container">
    {{-- Logo di kiri luar --}}
    <div class="logo-container">
        <img src="{{ asset('NEW LOGO RQQ.png') }}" alt="Rumah Que Que">
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            {{-- Menu Tengah --}}
            <ul class="navbar-nav d-flex flex-row justify-content-center flex-grow-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('katalog') }}">Katalog</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('tentangkami') }}">Tentang Kami</a></li>
            </ul>

            {{-- 🚨 LOGIKA LOGIN/GUEST 🚨 --}}
            <div class="auth-links">
                @guest('web')
                    {{-- Tampilan saat BELUM Login (Guest) --}}
                    <a href="{{ route('login') }}">Login</a>
                    <span class="divider">|</span>
                    <a href="{{ route('register') }}">Sign Up</a>
                @else
                    {{-- Tampilan saat SUDAH Login --}}
                    <a href="#" class="nav-link" style="padding: 0; margin: 0;">
                        <i class="bi bi-person-circle user-icon me-2"></i>
                        {{ Auth::guard('web')->user()->nama_pembeli }} {{-- Mengambil nama dari Model Pembeli --}}
                    </a>
                    <span class="divider">|</span>
                    <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                @endguest
            </div>
        </div>
    </nav>
</header>