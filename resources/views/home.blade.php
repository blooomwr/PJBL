{{-- File: resources/views/home.blade.php --}}

{{-- Menggunakan master layout yang sudah Anda buat --}}
@extends('layouts.app') 

@section('title', 'Home - Rumah Que-Que')

{{-- Pindahkan semua CSS kustom dari HomeUtama.php ke sini --}}
@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="hero-section container d-flex align-items-center py-0" style="margin-top:0;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Rumah Que-Que</h1>
                <p class="hero-subtitle">Kue Paling Enak di Bogor!</p>

                <div class="btnhero mt-4">
                    {{-- Ganti img src dengan asset() --}}
                    <a href="#" class="btnwistlist"><img src="{{ asset('img01/logobelanja.png') }}">Lihat Wishlist</a>
                    <a href="#" class="btnbelisekarang">Pesan Sekarang</a>
                </div>
            </div>

            <div class="col-md-6">
                <img src="{{ asset('img01/Hero.png') }}" class="img-fluid">
            </div>
        </div>
    </section>


    <div class="produk-terlaris-box-oren">
        <div class="container text-center py-5">
            <h2 class="judul-section">PRODUK TERLARIS</h2>

            <div class="row mt-4 mb-5 justify-content-center gx-xxl-5 gy-4">
                {{-- Loop data yang dikirim dari Controller --}}
                @foreach ($produkTerlaris as $produk)
                <div class="col-md-3">
                    <div class="card-produk">
                        {{-- Sesuaikan dengan path asset Anda --}}
                        <img src="{{ asset('gambar_produk/' . $produk->gambar->first()->nama_file) }}"> 
                        <p class="nama-produk">{{ $produk->nama }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- ... Sisa konten Testimoni dan FAQ ... --}}
    </div> 
@endsection