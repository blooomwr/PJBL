<?php
// File: app/Models/ProdukGambar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukGambar extends Model
{
    use HasFactory;

    protected $table = 'produk_gambar';
    protected $primaryKey = 'id_gambar'; // ID auto increment
    public $timestamps = false; 

    protected $fillable = [
        'id_produk',
        'nama_file',
    ];

    // Relasi: Setiap gambar dimiliki oleh satu produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}