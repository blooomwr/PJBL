
<?php

$kisah = file_get_contents('AssetTentangKami/kisah1.txt');

?>
<html lang="id">
<head>
    <link href="css01/tentangkami.css" rel="stylesheet">
    </head>
    <body>
        
    
        <section class="kisah">
          
        
        <div class="image-container">
        <?php include 'header2.php'; ?>

        </div>

        <!-- Deskripsi -->
         <h1 class="title">Kisah Manis Di Balik Kue</h1>
        <p class="description">
            <?php echo nl2br($kisah); ?>
        </p>
        </section>

        <div class="container-kedua">

    <!-- Bagian Dimana -->
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

    <!-- Bagian Kapan -->
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
      <img src="img/sertifikat1.png" alt="Visi dan Misi">
      <img src="img/sertifikat2.png" alt="Sertifikat Halal">
    </div>

    <div class="bottom-text">
      Dengan visi menghadirkan kebahagiaan lewat cita rasa rumahan, Que-Que telah teruji kelezatannya 
      dan bersertifikat halal resmi. Kami berkomitmen menjaga kualitas, kebersihan, dan kepercayaan 
      setiap pelanggan.
    </div>
  </div>
</div>
   <h1 class="title">Kisah Manis Di Balik Kue</h1>

</body>
</html>

<?php include 'footer.php'; ?>
