<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | The default guard is set to 'web', yang akan menggunakan provider 'pembeli'
    | (yang terdaftar di bawah) secara default.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Mendefinisikan setiap "Guard" (penjaga sesi) di aplikasi Anda.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'pembeli', // Digunakan untuk pengguna umum (Pembeli)
        ],

        // 1. Tambahkan Guard untuk Admin
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin', // Menggunakan provider 'admin'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Mendefinisikan bagaimana pengguna diambil dari database (Model Eloquent).
    |
    */

    'providers' => [
        
        // 1. Provider untuk Pembeli (Menggantikan 'users' default)
        'pembeli' => [
            'driver' => 'eloquent',
            // Pastikan Anda membuat Model Pembeli di App\Models\Pembeli
            'model' => App\Models\Pembeli::class, 
        ],
        
        // 2. Provider untuk Admin
        'admin' => [
            'driver' => 'eloquent',
            // Pastikan Anda membuat Model Admin di App\Models\Admin
            'model' => App\Models\Admin::class, 
        ],

        // Kami menyimpan 'users' untuk konfigurasi reset password bawaan
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk fitur reset password.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];