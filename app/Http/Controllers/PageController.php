<?php
// File: app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Berita;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Menggantikan HomeUtama.php
    public function home()
    {
        // Mengambil produk best seller
        $produkTerlaris = Produk::where('is_bestseller', 'Yes')->limit(3)->get();

        return view('home', compact('produkTerlaris'));
    }

    // Menggantikan katalog.php
    public function katalog()
    {
        $products = Produk::paginate(8); // Contoh pagination
        return view('katalog', compact('products'));
    }

    // Menggantikan Berita.php
    public function berita()
    {
        $beritaUtama = Berita::orderBy('tanggal', 'desc')->first();
        $beritaLainnya = Berita::where('id_berita', '!=', optional($beritaUtama)->id_berita)->limit(2)->get();

        return view('berita', compact('beritaUtama', 'beritaLainnya'));
    }

    // Menggantikan Tentang Kami.php
    public function tentangKami()
    {
        // Asumsi file AssetTentangKami/kisah1.txt dipindahkan ke resources/assets
        $kisah = file_get_contents(resource_path('assets/AssetTentangKami/kisah1.txt'));

        return view('tentangkami', compact('kisah'));
    }
}