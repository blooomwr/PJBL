<?php
require_once __DIR__ . '/../config/Database.php';

class Wishlist {
    private $db;

    public function __construct() {
        $this->db = new Database();
        // TIDAK ADA CEK LOGIN DISINI
    }

    private function getCartId($id_pembeli) {
        $id_pembeli = $this->db->escape($id_pembeli);
        $q = "SELECT id_keranjang FROM keranjang WHERE id_pembeli = '$id_pembeli'";
        $res = $this->db->conn->query($q);
        
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            return $row['id_keranjang'];
        } else {
            $this->db->conn->query("INSERT INTO keranjang (id_pembeli) VALUES ('$id_pembeli')");
            return $this->db->conn->insert_id;
        }
    }

    public function addToWishlist($id_pembeli, $id_produk, $jumlah, $varian = '') {
        $id_keranjang = $this->getCartId($id_pembeli);
        $id_produk = $this->db->escape($id_produk);
        $jumlah = (int) $jumlah;
        $varian = $this->db->escape($varian);

        $q = "SELECT id_detail, jumlah FROM detail_keranjang 
              WHERE id_keranjang = '$id_keranjang' AND id_produk = '$id_produk' AND varian = '$varian'";
        $res = $this->db->conn->query($q);

        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $newQty = $row['jumlah'] + $jumlah;
            $this->db->conn->query("UPDATE detail_keranjang SET jumlah = $newQty WHERE id_detail = " . $row['id_detail']);
        } else {
            $this->db->conn->query("INSERT INTO detail_keranjang (id_keranjang, id_produk, jumlah, varian) VALUES ('$id_keranjang', '$id_produk', $jumlah, '$varian')");
        }
        
        return ['status' => 'success', 'message' => 'Produk berhasil ditambahkan ke Wishlist!'];
    }

    public function getUserWishlist($id_pembeli, $keyword = '', $kategori = '', $sort = '') {
        $id_keranjang = $this->getCartId($id_pembeli);
        
        $sql = "SELECT dk.id_detail, dk.jumlah, dk.varian, 
                p.id_produk, p.nama, p.harga, p.kategori, p.kode_review,
                (SELECT nama_file FROM produk_gambar pg WHERE pg.id_produk = p.id_produk LIMIT 1) as gambar 
                FROM detail_keranjang dk
                JOIN produk p ON dk.id_produk = p.id_produk
                WHERE dk.id_keranjang = '$id_keranjang'";

        if (!empty($keyword)) {
            $safeKey = $this->db->escape($keyword);
            $sql .= " AND (p.nama LIKE '%$safeKey%')";
        }

        if (!empty($kategori)) {
            $safeKat = $this->db->escape($kategori);
            $sql .= " AND p.kategori = '$safeKat'";
        }

        switch ($sort) {
            case 'terlama': $sql .= " ORDER BY dk.id_detail ASC"; break;
            case 'harga_rendah': $sql .= " ORDER BY p.harga ASC"; break;
            case 'harga_tinggi': $sql .= " ORDER BY p.harga DESC"; break;
            case 'nama_az': $sql .= " ORDER BY p.nama ASC"; break;
            default: $sql .= " ORDER BY dk.id_detail DESC"; break;
        }
        
        return $this->db->conn->query($sql);
    }

    public function removeItem($id_detail) {
        $id_detail = $this->db->escape($id_detail);
        if ($this->db->conn->query("DELETE FROM detail_keranjang WHERE id_detail = '$id_detail'")) {
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }
    
    public function updateQuantity($id_detail, $change) {
        $id_detail = $this->db->escape($id_detail);
        $change = (int) $change;
        $q = "SELECT jumlah FROM detail_keranjang WHERE id_detail = '$id_detail'";
        $res = $this->db->conn->query($q);
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $newQty = $row['jumlah'] + $change;
            if ($newQty < 1) $newQty = 1;
            $this->db->conn->query("UPDATE detail_keranjang SET jumlah = $newQty WHERE id_detail = '$id_detail'");
            return ['status' => 'success', 'newQty' => $newQty];
        }
        return ['status' => 'error'];
    }
}
?>