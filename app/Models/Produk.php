<?php
// File: app/Models/Produk.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; // Primary key adalah String
    public $incrementing = false; 
    public $timestamps = false; // Matikan timestamps Laravel

    protected $fillable = [
        'id_produk',
        'nama',
        'deskripsi',
        'harga',
        'varian',
        'stok',
        'kategori',
        'is_bestseller',
        // 'terakhir_edit' diurus oleh database/Migration
    ];

    // Relasi: Satu produk memiliki banyak gambar
    public function gambar()
    {
        return $this->hasMany(ProdukGambar::class, 'id_produk', 'id_produk');
    }
}