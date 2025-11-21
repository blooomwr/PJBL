<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $story = "Toko Que rumahan yang berdiri tahun xxxx, didirikan oleh Ibu Dini ....
        
Berawal dari hobi membuat kue untuk keluarga, Ibu Dini mulai menerima pesanan dari tetangga dan teman. Dengan resep turun-temurun dan sentuhan cinta di setiap adonan, kue-kue buatannya selalu laris manis.

Kini, Rumah Que-Que telah melayani ribuan pelanggan dengan berbagai varian kue tradisional dan modern yang tetap mempertahankan cita rasa rumahan.";

        return view('about.index', compact('story'));
    }
}