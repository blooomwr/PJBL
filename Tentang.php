<?php
// 1. Logika Sesi dan Koneksi
include 'connlog.php'; 

// 2. Ambil data kisah
$kisah = file_get_contents('AssetTentangKami/kisah1.txt');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Rumah Que Que</title>
    
    <link href="css01/tentangkami.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">

    <style>
        /* === 1. PERBAIKAN UKURAN (BOX MODEL) === */
        /* Memastikan padding tidak membuat elemen melebar/membesar */
        * {
            box-sizing: border-box;
        }

        /* === 2. OVERRIDE STYLE HEADER KHUSUS HALAMAN INI === */
        header.header-container {
            position: absolute !important; /* Melayang di atas gambar */
            top: 20px !important;          /* Jarak dari atas (sama seperti margin halaman lain) */
            left: 0;
            width: 100%;
            z-index: 999; 
            background: transparent !important; 
            margin: 0 !important; 
            
            /* Memaksa font header kembali ke Playfair Display agar ukurannya sama persis */
            font-family: 'Playfair Display', serif !important;
        }

        /* Memastikan link di dalam navbar juga ikut font Playfair */
        header.header-container .nav-link, 
        header.header-container .auth-links a {
            font-family: 'Playfair Display', serif !important;
        }

        /* === 3. Style Body === */
        body {
            background-color: #fff3e0; 
        }
    </style>
</head>
<body>

    <?php 
    // 3. Muat Header
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'pembeli') {
        include 'header.php'; 
    } else {
        include 'header2.php'; 
    }
    ?>
        
    <section class="kisah">
        <div class="image-container"></div>

        <h1 class="title">Kisah Manis Di Balik Kue</h1>
        <div class="description">
            <?php echo nl2br($kisah); ?>
        </div>
    </section>

    <div class="container-kedua">
        
        <div class="section">
            <div class="img1"></div>
            <div class="text">
                <h2>Dimana</h2>
                <p>
                Rumah QueQue, samping klinik LNA,<br>
                Jl. Cemped Jl. Bangbarung Raya No.2A,<br>
                Bantarjati, Kec. Bogor Utara, Kota Bogor,<br>
                Jawa Barat 16153
                </p>
            </div>
        </div>

        <div class="section reverse">
            <div class="img1"></div>
            <div class="text">
                <h2>Kapan</h2>
                <p>Berdiri tahun 2015 - sekarang</p>
            </div>
        </div>

        <div class="box-oren">
            <h1>Kenapa harus <span class="highlight">Que-Que</span></h1>

            <div class="img-setelah-kenapaharus"></div>

            <div class="content">
                <div class="box">
                    <ul>
                        <li>Karena setiap kue kami dibuat dengan cinta dan bahan pilihan terbaik.</li>
                        <li>Teksturnya lembut, rasanya otentik, dan aromanya bikin rindu gigitan pertama.</li>
                        <li>Kami nggak cuma jual kue — kami hadirkan nostalgia rasa rumahan yang selalu dirindukan.</li>
                    </ul>
                </div>

                <div class="images">
                    <img src="img01/sertifikat1.png" alt="Visi dan Misi">
                    <img src="img01/sertifikat2.png" alt="Sertifikat Halal">
                </div>

                <div class="bottom-text">
                    Dengan visi menghadirkan kebahagiaan lewat cita rasa rumahan, Que-Que telah teruji kelezatannya 
                    dan bersertifikat halal resmi. Kami berkomitmen menjaga kualitas, kebersihan, dan kepercayaan 
                    setiap pelanggan.
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    
</body>
</html>