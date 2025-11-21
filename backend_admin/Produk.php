<?php
require_once 'Database.php';

class Produk {
    private $db;

    public function __construct() {
        $this->db = new Database();
        // HAPUS checkAuth() DARI SINI agar halaman publik bisa akses
    }

    // Cek Keamanan Admin (Dipanggil Manual)
    public function checkAuth() {
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

    // Generate ID
    private function generateId() {
        $query = "SELECT MAX(id_produk) AS max_id FROM produk";
        $result = $this->db->conn->query($query);
        $row = $result->fetch_assoc();
        $no = (int) substr($row['max_id'], 1, 2);
        $no++;
        return "P" . sprintf("%02s", $no);
    }

    // Generate Kode Review
    private function generateReviewCode() {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        do {
            $code = substr(str_shuffle($chars), 0, 8);
            $check = $this->db->conn->query("SELECT id_produk FROM produk WHERE kode_review = '$code'");
        } while ($check->num_rows > 0);
        return $code;
    }

    // Log History
    private function logHistory($aksi, $detail) {
        $id_admin = $_SESSION['id_user'] ?? 'SYSTEM';
        $nama_admin = $_SESSION['nama_user'] ?? 'System';
        $detail_safe = $this->db->escape($detail);
        $sql = "INSERT INTO audit_log (id_admin, nama_admin, aksi, detail) VALUES ('$id_admin', '$nama_admin', '$aksi', '$detail_safe')";
        $this->db->conn->query($sql);
    }

    // --- FITUR RATING ---

    public function hasRated($id_produk, $id_pembeli) {
        $id_produk = $this->db->escape($id_produk);
        $id_pembeli = $this->db->escape($id_pembeli);
        $query = "SELECT id_review FROM produk_review WHERE id_produk = '$id_produk' AND id_pembeli = '$id_pembeli'";
        $result = $this->db->conn->query($query);
        return ($result && $result->num_rows > 0);
    }

    public function addRating($id_produk, $rating, $input_kode, $id_pembeli) {
        $id = $this->db->escape($id_produk);
        $kode = strtoupper(trim($this->db->escape($input_kode)));
        $rating = (int) $rating;
        $id_user = $this->db->escape($id_pembeli);

        $q = "SELECT kode_review FROM produk WHERE id_produk = '$id'";
        $res = $this->db->conn->query($q);
        $data = $res->fetch_assoc();

        if (!$data || $data['kode_review'] !== $kode) {
            return ['status' => 'error', 'message' => 'Kode Review salah!'];
        }

        if ($this->hasRated($id, $id_user)) {
            return ['status' => 'error', 'message' => 'Anda sudah memberikan rating untuk produk ini.'];
        }

        $sql_insert = "INSERT INTO produk_review (id_produk, id_pembeli, rating) VALUES ('$id', '$id_user', '$rating')";
        $sql_update = "UPDATE produk SET total_score = total_score + $rating, total_reviewers = total_reviewers + 1 WHERE id_produk = '$id'";

        if ($this->db->conn->query($sql_insert) && $this->db->conn->query($sql_update)) {
            return ['status' => 'success', 'message' => 'Terima kasih atas penilaian Anda!'];
        }

        return ['status' => 'error', 'message' => 'Gagal menyimpan rating.'];
    }

    // --- ADMIN METHODS ---

    public function create($data, $files) {
        $this->checkAuth(); 
        $id = $this->generateId();
        
        $kode_review = "";
        if (!empty($data['kode_review'])) {
            $input_kode = strtoupper(trim($this->db->escape($data['kode_review'])));
            $check = $this->db->conn->query("SELECT id_produk FROM produk WHERE kode_review = '$input_kode'");
            if ($check->num_rows > 0) return false;
            $kode_review = $input_kode;
        } else {
            $kode_review = $this->generateReviewCode(); 
        }

        $nama = $this->db->escape($data['nama']);
        $deskripsi = $this->db->escape($data['deskripsi']);
        $harga = $data['harga'];
        $stok = $data['stok'];
        $kategori = $data['kategori'];
        $varian = $this->db->escape($data['varian']);
        $is_bestseller = isset($data['is_bestseller']) ? 'Yes' : 'No';

        $sql = "INSERT INTO produk (id_produk, kode_review, nama, deskripsi, harga, varian, stok, kategori, is_bestseller)
                VALUES ('$id', '$kode_review', '$nama', '$deskripsi', '$harga', '$varian', '$stok', '$kategori', '$is_bestseller')";

        if ($this->db->conn->query($sql)) {
            $this->logHistory("Menambah produk baru", "$nama (ID: $id) - Kode: $kode_review");
            $this->uploadImages($id, $files);
            return true;
        }
        return false;
    }

    public function update($data, $files) {
        $this->checkAuth();
        $id = $this->db->escape($data['id_produk']);
        
        $kode_baru = strtoupper(trim($this->db->escape($data['kode_review'])));
        if (!empty($kode_baru)) {
            $check = $this->db->conn->query("SELECT id_produk FROM produk WHERE kode_review = '$kode_baru' AND id_produk != '$id'");
            if ($check->num_rows == 0) {
                $this->db->conn->query("UPDATE produk SET kode_review='$kode_baru' WHERE id_produk='$id'");
            } else {
                return false; 
            }
        }

        $nama = $this->db->escape($data['nama']);
        $deskripsi = $this->db->escape($data['deskripsi']);
        $harga = $data['harga'];
        $stok = $data['stok'];
        $kategori = $data['kategori'];
        $varian = $this->db->escape($data['varian']);
        $is_bestseller = isset($data['is_bestseller']) ? 'Yes' : 'No';

        $sql = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', harga='$harga', 
                varian='$varian', stok='$stok', kategori='$kategori', is_bestseller='$is_bestseller' WHERE id_produk='$id'";

        if ($this->db->conn->query($sql)) {
            $this->logHistory("Mengubah produk", "$nama (ID: $id)");
            $this->uploadImages($id, $files);
            return true;
        }
        return false;
    }

    public function delete($ids) {
        $this->checkAuth();
        if (empty($ids)) return false;
        foreach ($ids as $id) {
            $q = "SELECT nama_file FROM produk_gambar WHERE id_produk='$id'";
            $res = $this->db->conn->query($q);
            while ($row = $res->fetch_assoc()) {
                $path = "../gambar_produk/" . $row['nama_file'];
                if (file_exists($path)) unlink($path);
            }
        }
        $idList = "'" . implode("','", $ids) . "'";
        $sql = "DELETE FROM produk WHERE id_produk IN ($idList)";
        if ($this->db->conn->query($sql)) {
            $count = count($ids);
            $this->logHistory("Menghapus produk", "Total $count dihapus.");
            return true;
        }
        return false;
    }

    public function deleteImage($id_gambar) {
        $this->checkAuth();
        $id_gambar = $this->db->escape($id_gambar);
        $q = "SELECT nama_file FROM produk_gambar WHERE id_gambar='$id_gambar'";
        $res = $this->db->conn->query($q);
        $data = $res->fetch_assoc();
        if ($data) {
            $path = "../gambar_produk/" . $data['nama_file'];
            if (file_exists($path)) unlink($path);
            $this->db->conn->query("DELETE FROM produk_gambar WHERE id_gambar='$id_gambar'");
            $this->logHistory("Menghapus gambar", $data['nama_file']);
            return true;
        }
        return false;
    }

    // --- PUBLIC METHODS ---

    public function getById($id) {
        $id = $this->db->escape($id);
        $query = "SELECT * FROM produk WHERE id_produk = '$id'";
        $result = $this->db->conn->query($query);
        return $result->fetch_assoc();
    }
    public function getImages($id) {
        $id = $this->db->escape($id);
        $query = "SELECT * FROM produk_gambar WHERE id_produk = '$id'";
        $result = $this->db->conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) { $data[] = $row; }
        return $data;
    }
    public function getRelated($id, $limit=5) {
        $id = $this->db->escape($id);
        $query = "SELECT p.*, (SELECT nama_file FROM produk_gambar pg WHERE pg.id_produk = p.id_produk LIMIT 1) as gambar 
                  FROM produk p WHERE id_produk != '$id' ORDER BY RAND() LIMIT $limit";
        return $this->db->conn->query($query);
    }
    public function getAll($keyword="", $kategori="", $sort="", $start=0, $perPage=8) {
        $whereClauses = [];
        if (!empty($keyword)) {
            $safeKey = $this->db->escape($keyword);
            $whereClauses[] = "(nama LIKE '%$safeKey%' OR deskripsi LIKE '%$safeKey%')";
        }
        if (!empty($kategori)) {
            $safeKat = $this->db->escape($kategori);
            $whereClauses[] = "kategori = '$safeKat'";
        }
        $sqlWhere = count($whereClauses) > 0 ? "WHERE " . implode(' AND ', $whereClauses) : "";
        
        $sqlOrder = "ORDER BY id_produk DESC"; 
        switch ($sort) {
            case 'terlama': $sqlOrder = "ORDER BY id_produk ASC"; break;
            case 'harga_rendah': $sqlOrder = "ORDER BY harga ASC"; break;
            case 'harga_tinggi': $sqlOrder = "ORDER BY harga DESC"; break;
            case 'nama_az': $sqlOrder = "ORDER BY nama ASC"; break;
        }

        $query = "SELECT p.*, (SELECT nama_file FROM produk_gambar pg WHERE pg.id_produk = p.id_produk LIMIT 1) as gambar 
                  FROM produk p $sqlWhere $sqlOrder LIMIT $start, $perPage";
        return $this->db->conn->query($query);
    }
    public function countAll($keyword = "", $kategori = "") {
        $whereClauses = [];
        if (!empty($keyword)) {
            $safeKey = $this->db->escape($keyword);
            $whereClauses[] = "(nama LIKE '%$safeKey%' OR deskripsi LIKE '%$safeKey%')";
        }
        if (!empty($kategori)) {
            $safeKat = $this->db->escape($kategori);
            $whereClauses[] = "kategori = '$safeKat'";
        }
        $sqlWhere = count($whereClauses) > 0 ? "WHERE " . implode(' AND ', $whereClauses) : "";
        $query = "SELECT COUNT(*) as total FROM produk $sqlWhere";
        $result = $this->db->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    public function query($sql) { 
        return $this->db->conn->query($sql); 
    }

    private function uploadImages($id_produk, $files) {
        $folder = "../gambar_produk/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        if (isset($files['gambar'])) {
            foreach ($files['gambar']['tmp_name'] as $key => $tmp) {
                if ($files['gambar']['error'][$key] == 0) {
                    $nama_file = uniqid() . "_" . $files['gambar']['name'][$key];
                    move_uploaded_file($tmp, $folder . $nama_file);
                    $sql = "INSERT INTO produk_gambar (id_produk, nama_file) VALUES ('$id_produk', '$nama_file')";
                    $this->db->conn->query($sql);
                }
            }
        }
    }
}
?>