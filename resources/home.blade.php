{{-- File: resources/views/home.blade.php --}}

@extends('layouts.app') {{-- Menggunakan master layout --}}

@section('title', 'Home - Rumah Que-Que')

@section('content')
    {{-- Konten Hero Section --}}
    <section class="hero-section container d-flex align-items-center py-0" style="margin-top:0;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Rumah Que-Que</h1>
                <p class="hero-subtitle">Kue Paling Enak di Bogor!</p>

                <div class="btnhero mt-4">
                    <a href="#" class="btnwistlist"><img src="img01/logobelanja.png" class=".icon"></img>Lihat Wishlist</a>
                    <a href="#" class="btnbelisekarang">Pesan Sekarang</a>
                </div>
            </div>

            <div class="col-md-6">
                <img src="img01/Hero.png" class="img-fluid">
            </div>
        </div>
    </section>

    {{-- Konten Produk Terlaris --}}
<div class="produk-terlaris-box-oren">

    <div class="container text-center py-5">
        <h2 class="judul-section">PRODUK TERLARIS</h2>

        <div class="row mt-4 mb-5 justify-content-center gx-xxl-5 gy-4">
            <div class="col-md-3">
                <div class="card-produk">
                    <img src="sesuai best seller si">
                    <p class="nama-produk">TACOOKIE ORIGINAL</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-produk">
                    <img src="sesuai best seller si">
                    <p class="nama-produk">Ketan Serikaya Pandan</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-produk">
                    <img src="sesuai best seller si">
                    <p class="nama-produk">TACOOKIES CHOCOLATE</p>
                </div>
            </div>
        </div>
    </div>
</div>

   <!-- TESTIMONI -->
    <div class="container py-5">
    <div class="row testimoni-row">
        <!-- Judul -->
        <div class="col-md-4">
            <h2 class="judul-testimoni">APA KATA<br>PELANGGAN<br>KAMI?</h2>
        </div>

        <!-- Testimoni + tombol -->
        <div class="col-md-8 d-flex align-items-center">
            <!-- Kontainer scrollable -->
            <div class="testimoni-scroll flex-grow-1 me-2">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Budi Setiawan</h5>
                            <p>★★★★★</p>
                            <p>“Enak banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Tenxii</h5>
                            <p>★★★★★</p>
                            <p>“Awalnya coba, eh ketagihan.”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Carlos Jessifer</h5>
                            <p>★★★★★</p>
                            <p>“So good and tasty!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>BoBoiboy</h5>
                            <p>★★★★★</p>
                            <p>“Ketan top banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Budi Setiawan</h5>
                            <p>★★★★★</p>
                            <p>“Enak banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Tenxii</h5>
                            <p>★★★★★</p>
                            <p>“Awalnya coba, eh ketagihan.”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Carlos Jessifer</h5>
                            <p>★★★★★</p>
                            <p>“So good and tasty!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>BoBoiboy</h5>
                            <p>★★★★★</p>
                            <p>“Ketan top banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Budi Setiawan</h5>
                            <p>★★★★★</p>
                            <p>“Enak banget!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Tenxii</h5>
                            <p>★★★★★</p>
                            <p>“Awalnya coba, eh ketagihan.”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>Carlos Jessifer</h5>
                            <p>★★★★★</p>
                            <p>“So good and tasty!”</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-testi">
                            <h5>BoBoiboy</h5>
                            <p>★★★★★</p>
                            <p>“Ketan top banget!”</p>
                        </div>
                    </div>
                    <!-- Tambahkan card lain sesuai kebutuhan -->
                </div>
            </div>

            <!-- Tombol panah -->
            <div class="d-flex flex-column justify-content-between">
                <i class="bi bi-arrow-up-circle-fill arrow-btn fs-1 mb-3"></i>
                <i class="bi bi-arrow-down-circle-fill arrow-btn fs-1 mt-3"></i>
            </div>
        </div>
    </div>
</div>


    {{-- Konten Tentang Kami --}}

<!-- FAQ (tidak masuk box oren) -->

<section class="faq-section py-5">
  <div class="container">
    <div class="faq-box p-4">

      <div class="faq-search">
        <h2 class="judul-section">FaQ</h2>
        <input type="text" id="faqSearch" placeholder="Cari Kata Kunci">
      </div>

      <div class="faq-accordion">

        <div class="faq-item">
          <div class="faq-question">Bagaimana cara melakukan pemesanan?</div>
          <div class="faq-answer">
            <p>Klik tombol pesan sekarang, dan kamu akan diarahkan ke WhatsApp.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Metode pembayaran apa saja yang tersedia?</div>
          <div class="faq-answer">
            <p>Bisa menggunakan apa saja.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Apakah harga sudah termasuk pajak?</div>
          <div class="faq-answer">
            <p>Sudah.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Bisakah mengubah pesanan setelah bayar?</div>
          <div class="faq-answer">
            <p>Bisa dibicarakan lewat admin WhatsApp.</p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>
@endsection