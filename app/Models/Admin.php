<?php
// File: app/Models/Admin.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin'; // Sesuai nama tabel di database
    protected $primaryKey = 'id_admin'; // Menggunakan ID yang didefinisikan di SQL Anda
    public $incrementing = false; // Karena id_admin adalah String (varchar)
    public $timestamps = false; // Matikan timestamps Laravel

    protected $fillable = [
        'id_admin',
        'username',
        'password',
        'nama_admin',
        'email_admin',
    ];

    protected $hidden = [
        'password',
    ];
}