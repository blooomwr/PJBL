<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "pjbl"; // Sesuaikan nama DB
    public $conn;

    public function __construct() {
        // Mulai session jika belum dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    // Method untuk mengamankan input string
    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }
}
?>