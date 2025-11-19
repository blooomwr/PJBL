{{-- resources/views/partials/_footer.blade.php --}}
<footer class="footer">
  <div class="footer-container">
    <div class="footer-logo">
      <img src="{{ asset('NEW LOGO RQQ.png') }}" alt="Rumah Que Que">
    </div>

    <div class="footer-links">
      <a href="{{ route('home') }}">Beranda</a>
      <a href="{{ route('katalog') }}">Katalog Produk</a>
      <a href="{{ route('tentangkami') }}">Tentang Kami</a>
    </div>

    <div class="footer-contact">
      <h4>Hubungi kami</h4>
      <p><i class="bi bi-phone"></i> +62 82123131234</p>
      <p><i class="bi bi-envelope"></i> quequeque@gmail.com</p>
      <p><i class="bi bi-geo-alt"></i> Jl. Aur Auran</p>
    </div>
  </div>
</footer>