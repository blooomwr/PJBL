<?php
// Pastikan sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login (Session 'id_user' harus ada dari proses login)
if (isset($_SESSION['id_user'])) {
    
    // 1. KONEKSI DATABASE
    // Sesuaikan path ke file database Anda
    if (file_exists(__DIR__ . '/../config/database.php')) {
        require_once __DIR__ . '/../config/database.php';
    } elseif (file_exists(__DIR__ . '/../config/database.php')) {
        require_once __DIR__ . '/../config/database.php';
    }
    
    if (!isset($db)) {
        $db = new Database();
    }
    
    $conn = $db->conn;
    $id_login = $conn->real_escape_string($_SESSION['id_user']); // ID dari session login

    // 2. PROSES UPDATE NAMA (Jika tombol simpan ditekan)
    if (isset($_POST['btn_update_profile'])) {
        $nama_baru = $conn->real_escape_string($_POST['nama_baru']);
        
        if (!empty($nama_baru)) {
            // UPDATE KE TABEL 'pembeli'
            $updateSql = "UPDATE pembeli SET nama_pembeli = '$nama_baru' WHERE id_pembeli = '$id_login'";
            
            if ($conn->query($updateSql)) {
                // Update session agar nama di header langsung berubah tanpa logout
                $_SESSION['nama_user'] = $nama_baru; 
                
                echo "<script>alert('Nama berhasil diperbarui!'); window.location.href=window.location.href;</script>";
            } else {
                echo "<script>alert('Gagal update nama: " . $conn->error . "');</script>";
            }
        }
    }

    // 3. AMBIL DATA PEMBELI (Untuk ditampilkan di form)
    $queryUser = "SELECT * FROM pembeli WHERE id_pembeli = '$id_login'";
    $resultUser = $conn->query($queryUser);
    
    if ($resultUser && $resultUser->num_rows > 0) {
        $dataPembeli = $resultUser->fetch_assoc();
    } else {
        // Data dummy jika error
        $dataPembeli = ['username' => '-', 'email_pembeli' => '-', 'nama_pembeli' => 'User'];
    }
?>

<style>
    .modal-backdrop { z-index: 1050; }
    .modal { z-index: 1060; }
    
    .custom-modal-header {
        background-color: #AE4C02;
        color: #fffaf3;
        border-bottom: none;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .custom-modal-title {
        font-family: 'Inria Serif', serif;
        font-weight: 700;
    }
    .modal-content {
        border-radius: 20px;
        border: none;
    }
    .profile-modal-body {
        font-family: 'Inria Serif', serif;
        background-color: #fffaf3;
        padding: 30px;
    }
    .form-label-custom {
        color: #AE4C02;
        font-weight: bold;
    }
    .form-control-custom {
        border: 1px solid #AE4C02;
        border-radius: 10px;
        padding: 10px;
        background-color: #fff;
    }
    /* Style untuk input Readonly (Abu-abu) */
    .form-control-readonly {
        background-color: #e9e9e9;
        color: #666;
        border: 1px solid #ccc;
        cursor: not-allowed; /* Cursor tanda larang */
    }
    .btn-save-profile {
        background-color: #AE4C02;
        color: white;
        border-radius: 20px;
        padding: 8px 30px;
        font-weight: bold;
        transition: 0.3s;
        border: none;
    }
    .btn-save-profile:hover {
        background-color: #8a3c02;
        color: white;
    }
</style>

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header custom-modal-header">
        <h5 class="modal-title custom-modal-title" id="profileModalLabel">Profil Saya</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form method="POST" action="">
          <div class="modal-body profile-modal-body">
            
            <div class="mb-3">
                <label class="form-label form-label-custom">Username</label>
                <input type="text" class="form-control form-control-custom form-control-readonly" 
                       value="<?= isset($dataPembeli['username']) ? htmlspecialchars($dataPembeli['username']) : '-'; ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Email</label>
                <input type="email" class="form-control form-control-custom form-control-readonly" 
                       value="<?= isset($dataPembeli['email_pembeli']) ? htmlspecialchars($dataPembeli['email_pembeli']) : '-'; ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Nama</label>
                <input type="text" name="nama_baru" class="form-control form-control-custom" 
                       value="<?= isset($dataPembeli['nama_pembeli']) ? htmlspecialchars($dataPembeli['nama_pembeli']) : ''; ?>" required>
            </div>

          </div>
          
          <div class="modal-footer" style="background-color: #fffaf3; border-top: none; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 20px;">Tutup</button>
            <button type="submit" name="btn_update_profile" class="btn btn-save-profile">Simpan Perubahan</button>
          </div>
      </form>

    </div>
  </div>
</div>

<?php 
} // End if isset session 
?>