<?php
require_once 'Database.php';

class Promo {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

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

    private function generateId() {
        $query = "SELECT MAX(id_promo) AS max_id FROM promo";
        $result = $this->db->conn->query($query);
        $row = $result->fetch_assoc();
        $no = (int) substr($row['max_id'], 1, 2);
        $no++;
        return "R" . sprintf("%02s", $no);
    }

    private function logHistory($aksi, $detail) {
        $id_admin = $_SESSION['id_user'] ?? 'SYSTEM';
        $nama_admin = $_SESSION['nama_user'] ?? 'System';
        $detail_safe = $this->db->escape($detail);
        $sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) VALUES ('$id_admin', '$nama_admin', '$aksi', '$detail_safe')";
        $this->db->conn->query($sql);
    }

    public function create($data, $file) {
        $this->requireAdmin();
        $id = $this->generateId();
        $nama = $this->db->escape($data['nama']);
        $kode = $this->db->escape($data['kode_promo']); 
        
        $nama_file_db = "";
        if (isset($file['gambar']) && $file['gambar']['error'] == 0) {
            $nama_file_db = $this->uploadImage($file['gambar']);
        }

        $sql = "INSERT INTO promo (id_promo, nama, kode_promo, gambar) VALUES ('$id', '$nama', '$kode', '$nama_file_db')";

        if ($this->db->conn->query($sql)) {
            // PERBAIKAN: Menampilkan Nama, Kode, DAN ID
            $this->logHistory("Menambah promo baru", "$nama (Kode: $kode) (ID: $id)");
            return true;
        }
        return false;
    }

    public function update($data, $file) {
        $this->requireAdmin();
        $id = $this->db->escape($data['id_promo']);
        $nama = $this->db->escape($data['nama']);
        $kode = $this->db->escape($data['kode_promo']);
        
        $gambar_lama = $this->db->escape($data['gambar_lama']);
        $nama_file_db = $gambar_lama;

        if (isset($file['gambar']) && $file['gambar']['error'] == 0) {
            $this->deletePhysicalImage($gambar_lama);
            $nama_file_db = $this->uploadImage($file['gambar']);
        }

        $sql = "UPDATE promo SET nama='$nama', kode_promo='$kode', gambar='$nama_file_db' WHERE id_promo='$id'";

        if ($this->db->conn->query($sql)) {
            // PERBAIKAN: Menampilkan Nama, Kode, DAN ID
            $this->logHistory("Mengubah promo", "$nama (Kode: $kode) (ID: $id)");
            return true;
        }
        return false;
    }

    public function delete($ids) {
        $this->requireAdmin();
        if (empty($ids)) return false;

        $idList = "'" . implode("','", $ids) . "'";
        
        // Hapus file fisik dulu
        $q = "SELECT gambar FROM promo WHERE id_promo IN ($idList)";
        $res = $this->db->conn->query($q);
        while ($row = $res->fetch_assoc()) {
            $this->deletePhysicalImage($row['gambar']);
        }

        // Hapus data di database
        $sql = "DELETE FROM promo WHERE id_promo IN ($idList)";
        if ($this->db->conn->query($sql)) {
            $cleanIds = str_replace("'", "", $idList);
            // PERBAIKAN: Menampilkan daftar ID yang dihapus
            $this->logHistory("Menghapus promo", "ID yang dihapus: $cleanIds");
            return true;
        }
        return false;
    }

    public function getById($id) {
        $id = $this->db->escape($id);
        $query = "SELECT * FROM promo WHERE id_promo = '$id'";
        return $this->db->conn->query($query)->fetch_assoc();
    }

    public function query($sql) {
        return $this->db->conn->query($sql);
    }

    private function uploadImage($file) {
        $folder = "../gambar_promo/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        $nama_file = uniqid() . "_" . $file['name'];
        move_uploaded_file($file['tmp_name'], $folder . $nama_file);
        return $nama_file;
    }

    private function deletePhysicalImage($filename) {
        if (!empty($filename)) {
            $path = "../gambar_promo/" . $filename;
            if (file_exists($path)) unlink($path);
        }
    }
}
?>