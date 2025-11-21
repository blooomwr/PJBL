<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Nanti data ini akan diambil dari database
        // Untuk sekarang pakai data dummy dulu
        
        return view('home');
    }
}