<?php
// File: app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pembeli;
use App\Models\Admin;

class LoginController extends Controller
{
    // Tampilkan formulir login
    public function showLoginForm()
    {
        // Asumsikan view login ada di resources/views/auth/login.blade.php
        return view('auth.login'); 
    }

    // Proses login (menggunakan guard Admin dan Pembeli)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;
        
        // 1. Cek Admin
        // Ambil Admin berdasarkan username. Kita asumsikan password Admin sudah di-hash di DB.
        $admin = Admin::where('username', $username)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->intended(route('admin.dashboard'));
        }

        // 2. Cek Pembeli
        // Cek apakah input username adalah email
        $loginField = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email_pembeli' : 'username';

        if (Auth::guard('web')->attempt([$loginField => $username, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // Jika semua gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
}