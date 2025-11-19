<?php
// File: app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_berita',
        'judul',
        'deskripsi',
        'teks_berita',
        'foto',
        'tanggal',
        'is_berita_utama',
    ];
}