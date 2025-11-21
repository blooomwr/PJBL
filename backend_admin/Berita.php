<?php
require_once 'Database.php';

class Berita {
    private $db;

    public function __construct() {
        $this->db = new Database();

    }

    // Pindahkan checkAuth ke method khusus yang dipanggil manual di halaman admin
    public function requireAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak.']);
                exit();
            } else {
                header("Location: ../login.php");
                exit();
            }
        }
    }

    // Generate ID Baru (B01, B02, dst)
    private function generateId() {
        $query = "SELECT MAX(id_berita) AS max_id FROM berita";
        $result = $this->db->conn->query($query);
        $row = $result->fetch_assoc();
        
        $no = (int) substr($row['max_id'], 1, 2);
        $no++;
        return "B" . sprintf("%02s", $no);
    }

    // Catat Audit Log
    private function logHistory($aksi, $detail) {
        $id_admin = $_SESSION['id_user'];
        $nama_admin = $_SESSION['nama_user'];
        $detail_safe = $this->db->escape($detail);

        $sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) 
                VALUES ('$id_admin', '$nama_admin', '$aksi', '$detail_safe')";
        $this->db->conn->query($sql);
    }

    // Helper Query (PENTING UNTUK HALAMAN ADMIN)
    public function query($sql) {
        return $this->db->conn->query($sql);
    }

    // --- CRUD METHODS ---

    public function create($data, $file) {
        $id = $this->generateId();
        $judul = $this->db->escape($data['judul']);
        $deskripsi = $this->db->escape($data['deskripsi']);
        $teks_berita = $this->db->escape($data['teks_berita']);
        $tanggal = $data['tanggal'];
        $is_berita_utama = isset($data['is_berita_utama']) ? 'Yes' : 'No';

        // Reset Berita Utama lain jika yang ini 'Yes'
        if ($is_berita_utama == 'Yes') {
            $this->db->conn->query("UPDATE berita SET is_berita_utama = 'No' WHERE is_berita_utama = 'Yes'");
        }
        
        // Upload Foto
        $nama_file_db = "";
        if (isset($file['foto']) && $file['foto']['error'] == 0) {
            $nama_file_db = $this->uploadImage($file['foto']);
        }

        $sql = "INSERT INTO berita (id_berita, judul, deskripsi, teks_berita, foto, tanggal, is_berita_utama)
                VALUES ('$id', '$judul', '$deskripsi', '$teks_berita', '$nama_file_db', '$tanggal', '$is_berita_utama')";

        if ($this->db->conn->query($sql)) {
            $this->logHistory("Menambah berita baru", "$judul (ID: $id)");
            return true;
        }
        return false;
    }

    public function update($data, $file) {
        $id = $this->db->escape($data['id_berita']);
        $judul = $this->db->escape($data['judul']);
        $deskripsi = $this->db->escape($data['deskripsi']);
        $teks_berita = $this->db->escape($data['teks_berita']);
        $tanggal = $data['tanggal'];
        $is_berita_utama = isset($data['is_berita_utama']) ? 'Yes' : 'No';
        $foto_lama = $this->db->escape($data['foto_lama']);
        $nama_file_db = $foto_lama;

        // Reset Berita Utama lain jika yang ini 'Yes'
        if ($is_berita_utama == 'Yes') {
            $this->db->conn->query("UPDATE berita SET is_berita_utama = 'No' WHERE is_berita_utama = 'Yes'");
        }

        // Cek upload foto baru
        if (isset($file['foto']) && $file['foto']['error'] == 0) {
            $this->deletePhysicalImage($foto_lama);
            $nama_file_db = $this->uploadImage($file['foto']);
        }

        $sql = "UPDATE berita SET 
                judul='$judul', deskripsi='$deskripsi', teks_berita='$teks_berita', 
                foto='$nama_file_db', tanggal='$tanggal', is_berita_utama='$is_berita_utama'
                WHERE id_berita='$id'";

        if ($this->db->conn->query($sql)) {
            $this->logHistory("Mengubah berita", "$judul (ID: $id)");
            return true;
        }
        return false;
    }

    public function delete($ids) {
        if (empty($ids)) return false;

        // Hapus Foto Fisik
        foreach ($ids as $id) {
            $id = $this->db->escape($id);
            $q = "SELECT foto FROM berita WHERE id_berita = '$id'";
            $res = $this->db->conn->query($q);
            if ($row = $res->fetch_assoc()) {
                $this->deletePhysicalImage($row['foto']);
            }
        }

        // Hapus DB
        $idList = "'" . implode("','", $ids) . "'";
        $cleanIds = str_replace("'", "", $idList);
        
        $sql = "DELETE FROM berita WHERE id_berita IN ($idList)";
        
        if ($this->db->conn->query($sql)) {
            $count = count($ids);
            $this->logHistory("Menghapus berita", "Total $count berita dihapus. (IDs: $cleanIds)");
            return true;
        }
        return false;
    }

    public function getById($id) {
        $id = $this->db->escape($id);
        $query = "SELECT * FROM berita WHERE id_berita = '$id'";
        $result = $this->db->conn->query($query);
        return $result->fetch_assoc();
    }

    // --- HELPERS ---

    private function uploadImage($file) {
        $folder = "../gambar_berita/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        
        $nama_file = uniqid() . "_" . $file['name'];
        move_uploaded_file($file['tmp_name'], $folder . $nama_file);
        return $nama_file;
    }

    private function deletePhysicalImage($filename) {
        if (!empty($filename)) {
            $path = "../gambar_berita/" . $filename;
            if (file_exists($path)) unlink($path);
        }
    }
}