<?php
require_once 'Database.php';

class Dashboard {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Ini otomatis start session
        $this->checkAuth();
    }

    // Cek Keamanan
    private function checkAuth() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ../login.php");
            exit();
        }
    }

    // Ambil 5 Histori Terakhir
    public function getRecentLogs($limit = 5) {
        $sql = "SELECT * FROM audit_log ORDER BY timestamp DESC LIMIT $limit";
        $result = $this->db->conn->query($sql);
        
        $logs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $logs[] = $row;
            }
        }
        return $logs;
    }
}
?>