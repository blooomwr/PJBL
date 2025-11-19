<?php

// File: app/Models/Pembeli.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk Login

class Pembeli extends Authenticatable // Gunakan ini karena Pembeli bisa login
{
    use HasFactory;

    // 1. Definisikan nama tabel yang digunakan di database
    protected $table = 'pembeli'; 

    // 2. Definisikan primary key yang digunakan (jika bukan 'id')
    protected $primaryKey = 'id_pembeli';

    // 3. Matikan timestamps otomatis (jika Anda tidak punya created_at/updated_at)
    public $timestamps = false; 

    // 4. Kolom yang bisa diisi (Fillable)
    protected $fillable = [
        'email_pembeli',
        'username',
        'password',
        'nama_pembeli',
    ];

    // 5. Konfigurasi untuk kolom yang disembunyikan (seperti password)
    protected $hidden = [
        'password',
    ];

    // 6. Konfigurasi untuk Admin (Sama seperti Pembeli, tapi ganti $table dan $primaryKey)
    // Anda bisa membuat Model Admin dengan cara yang sama.
}