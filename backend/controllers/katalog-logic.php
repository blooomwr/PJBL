<?php
// Panggil Class Produk (ini otomatis include Database.php dan start session)
require_once __DIR__ . '/../models/Produk.php'; 

// Inisialisasi Object
$produkModel = new Produk();

// --- LOGIKA FILTER & PENCARIAN ---

// Ambil parameter dari URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$kategoriFilter = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$sortFilter = isset($_GET['sort']) ? $_GET['sort'] : '';
$keyword = isset($_GET['cari']) ? $_GET['cari'] : '';

$perPage = 8; 
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

// --- PANGGIL DATA DARI CLASS ---

// Ambil Produk (Filter, Sort, Pagination sudah dihandle di Class)
$result = $produkModel->getAll($keyword, $kategoriFilter, $sortFilter, $start, $perPage);

// Ambil Total Data (untuk Pagination)
$totalProducts = $produkModel->countAll($keyword, $kategoriFilter);
$totalPages = ceil($totalProducts / $perPage);
?>