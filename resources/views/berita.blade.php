{{-- File: resources/views/berita.blade.php --}}

@extends('layouts.app')

@section('title', 'Berita - Rumah Que-Que')

@section('styles')
    <link href="{{ asset('css/berita.css') }}" rel="stylesheet">
@endsection

@section('content')
  <main>
    {{-- HERO (Berita Utama) --}}
    @if ($beritaUtama)
    <section class="hero">
      <div class="hero-left">
        <h1>{{ $beritaUtama->judul }}</h1>
        <div class="meta">{{ \Carbon\Carbon::parse($beritaUtama->tanggal)->format('l, d F Y') }}</div>
        <p>{{ $beritaUtama->deskripsi }}</p>
        <a class="btn-primary" href="#">Baca Selengkapnya</a>
      </div>
      <div class="hero-right">
        <img src="{{ asset('gambar_berita/' . $beritaUtama->foto) }}" alt="Berita Utama">
      </div>
    </section>
    @endif

    {{-- PROMO SECTION --}}
    <section class="promo">
        {{-- ... Konten Promo (statik/dinamik) ... --}}
    </section>

    {{-- NEWS SECTION (Berita Lainnya) --}}
    <section class="news">
      <h2>Berita lainnya</h2>
      <div class="cards">
        @foreach ($beritaLainnya as $berita)
        <article class="card-news">
          <h3>{{ $berita->judul }}</h3>
          <p>{{ $berita->deskripsi }}</p>
          <a href="#">Baca Selengkapnya →</a>
        </article>
        @endforeach
      </div>
    </section>
  </main>
@endsection