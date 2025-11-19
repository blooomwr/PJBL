<?php
// File: app/Models/Promo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo';
    protected $primaryKey = 'id_promo';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_promo',
        'nama',
        'gambar',
    ];
}