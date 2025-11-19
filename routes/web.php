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
| Rute Otentikasi Sosial (Socialite)
|--------------------------------------------------------------------------
*/


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
| Rute Otentikasi Standar (Manual Login/Logout)
|--------------------------------------------------------------------------
*/

// Catatan: Jika Anda menggunakan Laravel Breeze/UI, rute ini mungkin sudah ada 
// dan rute di bawah ini dapat diabaikan atau disesuaikan.

// Rute Logout (Menggantikan logout.php)
Route::post('/logout', function () {
    // Logout dari guard 'web' (pembeli)
    Auth::guard('web')->logout(); 
    // Jika Anda juga mengelola logout Admin, Anda bisa menambahkannya di sini atau di rute terpisah.
    
    return redirect()->route('home');
})->name('logout');


// Anda juga perlu memastikan rute /login dan /register sudah terdefinisi.
// Jika menggunakan Breeze/UI, rute ini sudah terintegrasi.
// Jika tidak, Anda perlu mendefinisikan rute GET dan POST untuk login/register Anda.