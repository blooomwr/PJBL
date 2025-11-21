@extends('layouts.app')

@section('title', 'Rumah Que-Que - Home')

@section('styles')
<style>
    /* Hero Section */
    .hero-section {
        margin-top: 0 !important;
        padding: 60px 0;
    }

    .hero-title {
        font-size: 100px;
        font-weight: 700;
        color: #8a4300;
    }

    .hero-subtitle {
        font-size: 22px;
    }

    .btnhero {
        display: flex;
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }

    .btnwistlist {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #FF9A3D;
        color: white;
        font-weight: 500;
        border: white 3px solid;
        border-radius: 25px;
        padding: 10px 25px;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0px 3px 6px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }

    .btnwistlist:hover {
        background: #AE4C02;
        transform: translateY(-2px);
        box-shadow: 0px 6px 10px rgba(0,0,0,0.18);
        color: white;
    }

    .btnbelisekarang {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #AE4C02;
        font-weight: 500;
        border: #AE4C02 2px solid;
        border-radius: 25px;
        padding: 10px 50px;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0px 0px 6px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }

    .btnbelisekarang:hover {
        background: #AE4C02;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0px 6px 10px rgba(0,0,0,0.18);
    }

    /* Produk Terlaris */
    .judul-section {
        font-size: 50px;
        padding-top: 20px;
        margin: 20px auto;
        margin-bottom: 50px !important;
    }

    .produk-terlaris-box-oren {
        background-color: #f5a623 !important;
        border-radius: 1000px / 100px;
        padding: 50px 20px 80px 20px;
        text-align: center;
        color: #4b2b00;
        width: 100%;
        height: auto;
        margin-top: 100px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .card-produk {
        background: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
        height: 100%;
    }

    .card-produk img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 12px;
    }

    .nama-produk {
        margin-top: 15px;
        font-weight: 600;
        font-size: 18px;
    }

    /* Testimoni */
    .row.testimoni-row {
        height: 500px;
    }

    .col-md-4 {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .judul-testimoni {
        font-size: 40px;
        text-align: left;
    }

    .testimoni-scroll {
        max-height: 540px;
        overflow-y: auto;
        padding-right: 10px;
        touch-action: none;
        -ms-touch-action: none;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .testimoni-scroll::-webkit-scrollbar {
        display: none;
    }

    .card-testi {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        text-align: center;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }

    .arrow-btn {
        font-size: 2rem;
        color: #AE4C02;
        cursor: pointer;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .arrow-btn:hover {
        color: #6a2e00;
        transform: translateY(1px);
    }

    .arrow-btn.disabled {
        color: #ccc;
        cursor: not-allowed;
        transform: none;
    }

    /* FAQ */
    .faq-section {
        padding: 80px 0;
    }

    .faq-box {
        width: 100%;
    }

    .faq-search {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
    }

    .faq-search .judul-section {
        margin-left: 120px !important;
    }

    .faq-search input {
        margin-right: 120px;
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
        outline: none;
    }

    .faq-accordion {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .faq-item {
        width: 100%;
        margin-bottom: 0 !important;
    }

    .faq-question {
        background: #FFB835;
        padding: 14px 18px;
        border-radius: 6px;
        font-weight: 600;
        color: #4b2b00;
        cursor: pointer;
        transition: 0.25s;
    }

    .faq-question:hover,
    .faq-question.active {
        background: #ff9c00;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease;
        background: #FFE6C7;
        border-radius: 0 0 6px 6px;
        margin-top: 3px;
    }

    .faq-answer p {
        margin: 0;
        padding: 12px 18px;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
    <!-- HERO SECTION -->
    <section class="hero-section container d-flex align-items-center py-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Rumah Que-Que</h1>
                <p class="hero-subtitle">Kue Paling Enak di Bogor!</p>

                <div class="btnhero mt-4">
                    <a href="#" class="btnwistlist">
                        <img src="https://via.placeholder.com/24x24/ffffff/ffffff?text=🛒" class="icon" alt="cart">
                        Lihat Wishlist
                    </a>
                    <a href="#" class="btnbelisekarang">Pesan Sekarang</a>
                </div>
            </div>

            <div class="col-md-6">
                <img src="https://via.placeholder.com/600x500/FF9A3D/ffffff?text=Hero+Image+Kue" class="img-fluid" alt="Hero">
            </div>
        </div>
    </section>

    <!-- PRODUK TERLARIS -->
    <div class="produk-terlaris-box-oren">
        <div class="container text-center py-5">
            <h2 class="judul-section">PRODUK TERLARIS</h2>

            <div class="row mt-4 mb-5 justify-content-center gx-xxl-5 gy-4">
                <div class="col-md-3">
                    <div class="card-produk">
                        <img src="https://via.placeholder.com/300x250/8B4513/ffffff?text=Tacookie+Original" alt="Tacookie Original">
                        <p class="nama-produk">TACOOKIE ORIGINAL</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-produk">
                        <img src="https://via.placeholder.com/300x250/228B22/ffffff?text=Ketan+Serikaya" alt="Ketan Serikaya">
                        <p class="nama-produk">Ketan Serikaya Pandan</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-produk">
                        <img src="https://via.placeholder.com/300x250/6F4E37/ffffff?text=Tacookie+Chocolate" alt="Tacookie Chocolate">
                        <p class="nama-produk">TACOOKIES CHOCOLATE</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TESTIMONI -->
        <div class="container py-5">
            <div class="row testimoni-row">
                <div class="col-md-4">
                    <h2 class="judul-testimoni">APA KATA<br>PELANGGAN<br>KAMI?</h2>
                </div>

                <div class="col-md-8 d-flex align-items-center">
                    <div class="testimoni-scroll flex-grow-1 me-2">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card-testi">
                                    <h5>Budi Setiawan</h5>
                                    <p>★★★★★</p>
                                    <p>"Enak banget!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-testi">
                                    <h5>Tenxii</h5>
                                    <p>★★★★★</p>
                                    <p>"Awalnya coba, eh ketagihan."</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-testi">
                                    <h5>Carlos Jessifer</h5>
                                    <p>★★★★★</p>
                                    <p>"So good and tasty!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-testi">
                                    <h5>BoBoiboy</h5>
                                    <p>★★★★★</p>
                                    <p>"Ketan top banget!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-testi">
                                    <h5>Siti Nurhaliza</h5>
                                    <p>★★★★★</p>
                                    <p>"Rasanya mantap jiwa!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-testi">
                                    <h5>Ahmad Dhani</h5>
                                    <p>★★★★★</p>
                                    <p>"Kue terenak se-Indonesia!"</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-content-between">
                        <i class="bi bi-arrow-up-circle-fill arrow-btn fs-1 mb-3"></i>
                        <i class="bi bi-arrow-down-circle-fill arrow-btn fs-1 mt-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ -->
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

@section('scripts')
<script>
    // Testimoni scroll
    const scrollContainer = document.querySelector('.testimoni-scroll');
    const arrowUp = document.querySelector('.arrow-btn.bi-arrow-up-circle-fill');
    const arrowDown = document.querySelector('.arrow-btn.bi-arrow-down-circle-fill');

    function updateArrowState() {
        if (scrollContainer.scrollTop <= 0) {
            arrowUp.classList.add('disabled');
        } else {
            arrowUp.classList.remove('disabled');
        }

        if (scrollContainer.scrollTop + scrollContainer.clientHeight >= scrollContainer.scrollHeight) {
            arrowDown.classList.add('disabled');
        } else {
            arrowDown.classList.remove('disabled');
        }
    }

    arrowUp.addEventListener('click', () => {
        scrollContainer.scrollBy({ top: -1100, behavior: 'smooth' });
    });

    arrowDown.addEventListener('click', () => {
        scrollContainer.scrollBy({ top: 1100, behavior: 'smooth' });
    });

    scrollContainer.addEventListener('scroll', updateArrowState);
    updateArrowState();

    // FAQ accordion
    const questions = document.querySelectorAll(".faq-question");

    questions.forEach((question) => {
        question.addEventListener("click", () => {
            questions.forEach((q) => {
                if (q !== question) {
                    q.classList.remove("active");
                    q.nextElementSibling.style.maxHeight = null;
                }
            });

            question.classList.toggle("active");
            const answer = question.nextElementSibling;
            if (question.classList.contains("active")) {
                answer.style.maxHeight = answer.scrollHeight + "px";
            } else {
                answer.style.maxHeight = null;
            }
        });
    });
</script>
@endsection