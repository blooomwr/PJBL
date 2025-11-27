<?php
require_once __DIR__ . '/../config/database.php';

class Pembeli {
    private $db;

    public function __construct() {
        // Class Database otomatis memulai session
        $this->db = new Database(); 
    }
    
    /*Memproses login pembeli (menggunakan username atau email) dan memverifikasi password.*/
    public function login($username, $password) {
        $conn = $this->db->conn;
        $username_safe = $this->db->escape($username);

        // Cari di tabel 'pembeli' (berdasarkan username atau email)
        $sql = "SELECT * FROM pembeli WHERE username = '$username_safe' OR email_pembeli = '$username_safe'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $pembeli = $result->fetch_assoc();

            // Verifikasi password yang sudah di-hash
            if (password_verify($password, $pembeli['password'])) {
                // Mengembalikan data pembeli untuk diatur di session oleh file login.php
                return ['status' => 'success', 'data' => $pembeli];
            }
        }
        
        return ['status' => 'error', 'message' => 'Username atau password salah.'];
    }

    /*Memproses registrasi pembeli baru.*/
    public function register($email, $username, $password) {
        $conn = $this->db->conn;
        $email_safe = $this->db->escape($email);
        $username_safe = $this->db->escape($username);
        $nama_pembeli = $username_safe; 

        // 1. Cek duplikasi email atau username
        $check = $conn->query("SELECT email_pembeli, username FROM pembeli WHERE email_pembeli='$email_safe' OR username='$username_safe'");
        if ($check->num_rows > 0) {
            return ['status' => 'error', 'message' => 'Email atau Username sudah terdaftar.'];
        }
        
        // 2. Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 3. Insert data
        $sql = "INSERT INTO pembeli (email_pembeli, username, password, nama_pembeli) 
                VALUES ('$email_safe', '$username_safe', '$hashed_password', '$nama_pembeli')";

        if ($conn->query($sql) === TRUE) {
            return ['status' => 'success', 'message' => 'Pendaftaran berhasil! Silakan Login.'];
        } else {
            return ['status' => 'error', 'message' => 'Error saat menyimpan data: ' . $conn->error];
        }
    }

    /**
     * Menghapus semua data sesi (session_unset, session_destroy)*/
    public function logout() {
        session_unset(); 
        session_destroy(); 
        return true;
    }
}
?>