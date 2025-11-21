<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Data berita dummy (nanti dari database)
    private function getNews()
    {
        return [
            [
                'id' => 1,
                'title' => 'Apresiasi untuk Rumah Que-Que',
                'date' => 'Kamis, 21 Maret 2024',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque gravida arcu ut ultricies bibendum. Integer vitae pharetra velit. Nam porttitor mauris nunc, in molestie nulla placerat non.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque gravida arcu ut ultricies bibendum. Integer vitae pharetra velit. Nam porttitor mauris nunc, in molestie nulla placerat non. Sed euismod turpis eget nulla scelerisque, vel finibus turpis ultrices. Donec ac justo at libero tincidunt volutpat. Suspendisse potenti. Nullam in ligula eu nulla tincidunt varius.',
                'image' => 'https://via.placeholder.com/600x400/AE4C02/ffffff?text=Sertifikat+Award',
                'is_featured' => true
            ],
            [
                'id' => 2,
                'title' => 'Kue Pisang Coklat Viral dan Jadi Buruan!',
                'date' => 'Senin, 18 Maret 2024',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque gravida arcu ut ultricies bibendum.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque gravida arcu ut ultricies bibendum. Integer vitae pharetra velit.',
                'image' => 'https://via.placeholder.com/600x400/8B4513/ffffff?text=Kue+Pisang',
                'is_featured' => false
            ],
            [
                'id' => 3,
                'title' => 'Grand Opening Cabang Baru Rumah Que-Que',
                'date' => 'Jumat, 15 Maret 2024',
                'excerpt' => 'Rumah Que-Que membuka cabang baru di pusat kota dengan konsep modern dan nyaman.',
                'content' => 'Rumah Que-Que membuka cabang baru di pusat kota dengan konsep modern dan nyaman. Berbagai promo menarik menanti pelanggan setia kami.',
                'image' => 'https://via.placeholder.com/600x400/FF8C42/ffffff?text=Grand+Opening',
                'is_featured' => false
            ],
        ];
    }

    private function getPromos()
    {
        return [
            [
                'id' => 1,
                'title' => 'Beli 3 varian Tacookies sekaligus',
                'discount' => 'Disc 2%',
                'image' => 'https://via.placeholder.com/140x90/CD853F/ffffff?text=Tacookies'
            ],
            [
                'id' => 2,
                'title' => 'Paket Hemat Ketan Srikaya',
                'discount' => 'Disc 5%',
                'image' => 'https://via.placeholder.com/140x90/228B22/ffffff?text=Ketan'
            ],
        ];
    }

    private function getActivities()
    {
        return [
            'https://via.placeholder.com/800x600/FF9A3D/ffffff?text=Kegiatan+1',
            'https://via.placeholder.com/1200x600/AE4C02/ffffff?text=Kegiatan+2',
            'https://via.placeholder.com/800x600/8B4513/ffffff?text=Kegiatan+3',
        ];
    }

    public function index()
    {
        $news = $this->getNews();
        $featuredNews = collect($news)->where('is_featured', true)->first();
        $otherNews = collect($news)->where('is_featured', false)->all();
        $promos = $this->getPromos();
        $activities = $this->getActivities();

        return view('news.index', compact('featuredNews', 'otherNews', 'promos', 'activities'));
    }

    public function show($id)
    {
        $news = $this->getNews();
        $article = collect($news)->firstWhere('id', $id);
        
        if (!$article) {
            abort(404);
        }

        return view('news.show', compact('article'));
    }
}