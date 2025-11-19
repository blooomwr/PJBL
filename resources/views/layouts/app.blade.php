{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Rumah Que-Que')</title>

  {{-- CSS ASSET --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
  
  {{-- Jika Anda memiliki CSS kustom global, muat di sini --}}
  {{-- <link href="{{ asset('css/custom-global.css') }}" rel="stylesheet">  --}}
  
  {{-- Blade allows injecting custom styles per page --}}
  @yield('styles') 

  <style>
    /* Pindahkan semua CSS GLOBAL dari header.php/header2.php dan footer.php ke file CSS terpisah 
       atau letakkan di sini untuk konsolidasi. */
    body {
      font-family: 'Playfair Display', serif;
      background: linear-gradient(to bottom, #fef9ef, #fffaf3);
    }
    /* ... Tambahkan seluruh CSS untuk .header-container, .navbar-custom, .auth-links, .footer di sini ... */
  </style>
</head>
<body>

  @include('partials._header_nav') {{-- Memuat navigasi dinamis --}}

  <main>
    @yield('content') {{-- Tempat konten unik setiap halaman akan masuk --}}
  </main>
  
  @include('partials._footer') {{-- Memuat footer --}}

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @yield('scripts')
</body>
</html>