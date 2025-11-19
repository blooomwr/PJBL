<?php
// File: app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Tampilkan formulir register
    public function showRegistrationForm()
    {
        // Asumsikan view register ada di resources/views/auth/register.blade.php
        return view('auth.register'); 
    }

    // Proses pendaftaran
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:50', 'unique:pembeli,email_pembeli'],
            'username' => ['required', 'string', 'max:30', 'unique:pembeli,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pembeli = Pembeli::create([
            'email_pembeli' => $request->email,
            'username' => $request->username,
            'nama_pembeli' => $request->username, // Menggunakan username sebagai nama default
            'password' => Hash::make($request->password), // Wajib di-hash
        ]);

        // Login otomatis setelah register
        Auth::guard('web')->login($pembeli);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil!');
    }
}