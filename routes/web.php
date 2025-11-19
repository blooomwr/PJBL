<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Untuk rute Logout
use App\Http\Controllers\PageController; // Controller halaman publik
use App\Http\Controllers\Auth\SocialController; // Controller Socialite
use App\Http\Controllers\AdminController; // Controller Admin Dashboard
use App\Http\Controllers\Admin\ProductController as AdminProductController; // Controller CRUD Produk Admin

/*
|--------------------------------------------------------------------------
| Rute Publik (Pembeli & Guest)
|--------------------------------------------------------------------------
*/

// Home/Beranda (Menggantikan HomeUtama.php)
Route::get('/', [PageController::class, 'home'])->name('home'); 

// Katalog
Route::get('/katalog', [PageController::class, 'katalog'])->name('katalog');

// Berita
Route::get('/berita', [PageController::class, 'berita'])->name('berita');

// Tentang Kami
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('tentangkami');

/*
|--------------------------------------------------------------------------
| Rute Admin (Dilindungi)
|--------------------------------------------------------------------------
*/

// Semua rute di bawah ini memerlukan login sebagai Admin (auth:admin)
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin (Menggantikan admin-dashboard.php)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Produk CRUD (Menggantikan produk-admin.php dan file backend insert/update/delete)
    Route::resource('products', AdminProductController::class)->names('admin.products');

    // Anda dapat menambahkan rute resource untuk Berita dan Promo Admin di sini
});


/*
|--------------------------------------------------------------------------
| Rute Otentikasi Dasar (Wajib untuk link di Header)
|--------------------------------------------------------------------------
*/

// Anda harus membuat Controller dan View untuk /login dan /register.
// Contoh di bawah menggunakan nama route standar Laravel.

// Rute Login (GET untuk menampilkan form, POST untuk memproses login)
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);


// Rute Register (GET untuk menampilkan form, POST untuk memproses pendaftaran)
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);


// Rute Logout (Menggantikan logout.php)
Route::post('/logout', function () {
    Auth::guard('web')->logout(); 
    return redirect()->route('home');
})->name('logout');


