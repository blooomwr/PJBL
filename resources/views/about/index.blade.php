@extends('layouts.app')

@section('title', 'Tentang Kami - Rumah Que-Que')

@section('content')
<style>
    body {
        background-color: #fff3e0;
    }

    .about-page {
        width: 100%;
        background-color: #fff3e0;
    }

    /* Hero Image Section */
    .hero-image {
        width: 100%;
        height: 60vh;
        background-image: url('https://via.placeholder.com/1200x600/AE4C02/ffffff?text=Rumah+Que-Que');
        background-size: cover;
        background-position: center;
        position: relative;
        -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
        mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
    }

    /* Kisah Section */
    .story-section {
        text-align: center;
        padding: 40px 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .story-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #6d3d1a;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .story-text {
        font-size: 1.1rem;
        line-height: 2;
        color: #5c3d2e;
        text-align: justify;
        margin-bottom: 60px;
    }

    /* Info Cards */
    .info-container {
        max-width: 900px;
        margin: 0 auto 80px;
        padding: 0 20px;
    }

    .info-card {
        display: flex;
        align-items: center;
        gap: 40px;
        margin-bottom: 60px;
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .info-card.reverse {
        flex-direction: row-reverse;
    }

    .info-image {
        width: 300px;
        height: 200px;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .info-text h2 {
        font-size: 2.5rem;
        color: #a14d0b;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .info-text p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #5c3d2e;
    }

    /* Orange Box Section */
    .orange-box {
        background-color: #f5a623;
        border-radius: 100px;
        padding: 60px 20px;
        width: 100%;
        margin: 80px 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .orange-box h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4b2b00;
        text-align: center;
        margin-bottom: 40px;
    }

    .orange-box .highlight {
        color: #7a3000;
    }

    /* Banner Inside Orange Box */
    .banner-image {
        width: 100%;
        max-width: 800px;
        height: 200px;
        margin: 40px auto;
        background-image: url('https://via.placeholder.com/800x200/8B4513/ffffff?text=Box+Banner');
        background-size: cover;
        background-position: center;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Content Box */
    .content-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .white-box {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin: 20px 0;
    }

    .white-box ul {
        margin: 0;
        padding-left: 25px;
        line-height: 1.8;
        text-align: left;
        color: #5c3d2e;
    }

    .white-box ul li {
        margin-bottom: 10px;
    }

    /* Certificate Images */
    .certificate-grid {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px 0;
        flex-wrap: wrap;
    }

    .certificate-grid img {
        width: 150px;
        height: 200px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        object-fit: cover;
        background: white;
        padding: 10px;
    }

    /* Bottom Text Box */
    .bottom-box {
        background-color: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: justify;
        line-height: 1.8;
        color: #5c3d2e;
    }

    /* Final Title */
    .final-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #6d3d1a;
        text-align: center;
        margin: 60px 0 40px;
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-image {
            height: 40vh;
        }

        .story-title {
            font-size: 2rem;
        }

        .info-card {
            flex-direction: column !important;
            text-align: center;
        }

        .info-card.reverse {
            flex-direction: column !important;
        }

        .info-image {
            width: 100%;
            height: 250px;
        }

        .info-text h2 {
            font-size: 2rem;
        }

        .orange-box h1 {
            font-size: 2rem;
        }

        .certificate-grid img {
            width: 120px;
            height: 160px;
        }
    }
</style>

<div class="about-page">
    <!-- Hero Image -->
    <div class="hero-image"></div>

    <!-- Story Section -->
    <section class="story-section">
        <h1 class="story-title">Kisah Manis Di Balik Kue</h1>
        <p class="story-text">{{ $story }}</p>
    </section>

    <!-- Info Cards -->
    <div class="info-container">
        <!-- Dimana -->
        <div class="info-card">
            <img src="https://via.placeholder.com/300x200/8B4513/ffffff?text=Lokasi+Toko" alt="Dimana" class="info-image">
            <div class="info-text">
                <h2>Dimana</h2>
                <p>
                    Rumah QueQue, samping klinik LNA,<br>
                    Jl. Cemped Jl. Bangbarung Raya No.2A,<br>
                    Bantarjati, Kec. Bogor Utara, Kota Bogor,<br>
                    Jawa Barat 16153
                </p>
            </div>
        </div>

        <!-- Kapan -->
        <div class="info-card reverse">
            <img src="https://via.placeholder.com/300x200/AE4C02/ffffff?text=Sejak+2015" alt="Kapan" class="info-image">
            <div class="info-text">
                <h2>Kapan</h2>
                <p>Berdiri tahun 2015 - sekarang</p>
            </div>
        </div>
    </div>

    <!-- Orange Box Section -->
    <div class="orange-box">
        <h1>Kenapa harus <span class="highlight">Que-Que</span></h1>

        <div class="banner-image"></div>

        <div class="content-wrapper">
            <!-- Reasons List -->
            <div class="white-box">
                <ul>
                    <li>Karena setiap kue kami dibuat dengan cinta dan bahan pilihan terbaik.</li>
                    <li>Teksturnya lembut, rasanya otentik, dan aromanya bikin rindu gigitan pertama.</li>
                    <li>Kami nggak cuma jual kue — kami hadirkan nostalgia rasa rumahan yang selalu dirindukan.</li>
                </ul>
            </div>

            <!-- Certificates -->
            <div class="certificate-grid">
                <img src="https://via.placeholder.com/150x200/FFD700/000000?text=Visi+Misi" alt="Visi dan Misi">
                <img src="https://via.placeholder.com/150x200/FFD700/000000?text=Halal" alt="Sertifikat Halal">
            </div>

            <!-- Bottom Description -->
            <div class="bottom-box">
                Dengan visi menghadirkan kebahagiaan lewat cita rasa rumahan, Que-Que telah teruji kelezatannya 
                dan bersertifikat halal resmi. Kami berkomitmen menjaga kualitas, kebersihan, dan kepercayaan 
                setiap pelanggan.
            </div>
        </div>
    </div>

    <!-- Final Title -->
    <h1 class="final-title">"Bersama Que-Que"</h1>
</div>
@endsection