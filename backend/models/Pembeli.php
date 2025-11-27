<?php
require_once __DIR__ . '/../config/database.php';

class Pembeli {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    
    // --- METHOD LOGIN (UPDATE: ADMIN & PEMBELI) ---
    public function login($username, $password) {
        $conn = $this->db->conn;
        $username_safe = $this->db->escape($username);

        // 1. CEK DI TABEL ADMIN DULU
        $sql_admin = "SELECT * FROM admin WHERE username = '$username_safe'";
        $result_admin = $conn->query($sql_admin);

        if ($result_admin && $result_admin->num_rows > 0) {
            $admin = $result_admin->fetch_assoc();
            
            // Verifikasi password Admin
            if (password_verify($password, $admin['password'])) {
                return [
                    'status' => 'success', 
                    'role' => 'admin', 
                    'data' => $admin
                ];
            }
        }

        // 2. JIKA BUKAN ADMIN, CEK DI TABEL PEMBELI
        // (Bisa login pakai username atau email)
        $sql_pembeli = "SELECT * FROM pembeli WHERE username = '$username_safe' OR email_pembeli = '$username_safe'";
        $result_pembeli = $conn->query($sql_pembeli);

        if ($result_pembeli && $result_pembeli->num_rows > 0) {
            $pembeli = $result_pembeli->fetch_assoc();

            // Verifikasi password Pembeli
            if (password_verify($password, $pembeli['password'])) {
                return [
                    'status' => 'success', 
                    'role' => 'pembeli', 
                    'data' => $pembeli
                ];
            }
        }
        
        // Jika tidak ada yang cocok di kedua tabel
        return ['status' => 'error', 'message' => 'Username atau password salah.'];
    }

    // --- METHOD REGISTER ---
    public function register($email, $username, $password) {
        $conn = $this->db->conn;
        $email_safe = $this->db->escape($email);
        $username_safe = $this->db->escape($username);
        $nama_pembeli = $username_safe; 

        // Cek duplikasi
        $check = $conn->query("SELECT email_pembeli, username FROM pembeli WHERE email_pembeli='$email_safe' OR username='$username_safe'");
        if ($check->num_rows > 0) {
            return ['status' => 'error', 'message' => 'Email atau Username sudah terdaftar.'];
        }
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO pembeli (email_pembeli, username, password, nama_pembeli) 
                VALUES ('$email_safe', '$username_safe', '$hashed_password', '$nama_pembeli')";

        if ($conn->query($sql) === TRUE) {
            return ['status' => 'success', 'message' => 'Pendaftaran berhasil! Silakan Login.'];
        } else {
            return ['status' => 'error', 'message' => 'Error saat menyimpan data: ' . $conn->error];
        }
    }

    // --- METHOD LOGOUT ---
    public function logout() {
        session_unset(); 
        session_destroy(); 
        return true;
    }
}
?>