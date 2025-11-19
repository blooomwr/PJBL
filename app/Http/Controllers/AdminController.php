<?php
// File: app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Halaman Dashboard Admin - Menggantikan admin-dashboard.php
    public function dashboard()
    {
        // Mengambil histori aktivitas terakhir
        $histories = AuditLog::orderBy('timestamp', 'desc')->limit(5)->get();

        // Mengambil data admin yang sedang login
        $admin = Auth::guard('admin')->user();
        
        return view('admin.dashboard', compact('histories', 'admin'));
    }
}