<?php
// File: app/Models/AuditLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_log';
    protected $primaryKey = 'id_log';
    public $timestamps = false; // Karena hanya menggunakan kolom 'timestamp' kustom

    protected $fillable = [
        'id_admin',
        'nama_admin',
        'aksi',
        'detail',
    ];

    // Relasi (opsional): Log ini dibuat oleh satu Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}