@extends('layouts.app')

@section('title', $article['title'] . ' - Rumah Que-Que')

@section('content')
<style>
:root {
  --bg: #f7e9d5;
  --accent: #c66a21;
  --accent-dark: #7a2e03;
  --card: #fff6ef;
  --shadow: rgba(60,30,10,0.15);
}

main {
    padding: 40px 6%;
    max-width: 1000px;
    margin: 0 auto;
}

.breadcrumb-custom {
    background: transparent;
    padding: 0;
    margin-bottom: 30px;
    font-size: 0.9rem;
}

.breadcrumb-custom a {
    color: #999;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-custom a:hover {
    color: var(--accent);
}

.breadcrumb-custom .active {
    color: var(--accent-dark);
}

.article-header {
    text-align: center;
    margin-bottom: 40px;
}

.article-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 20px;
    line-height: 1.2;
}

.article-meta {
    color: #999;
    font-size: 1rem;
    margin-bottom: 30px;
}

.article-image {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 12px 30px var(--shadow);
    margin-bottom: 40px;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #444;
    margin-bottom: 60px;
}

.article-content p {
    margin-bottom: 20px;
}

.back-button {
    display: inline-block;
    background: var(--card);
    color: var(--accent-dark);
    padding: 12px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.back-button:hover {
    background: var(--accent-dark);
    color: white;
    transform: translateX(-5px);
}

@media (max-width: 768px) {
    .article-title {
        font-size: 2rem;
    }

    .article-content {
        font-size: 1rem;
    }
}
</style>

<main>
    <!-- Breadcrumb -->
    <nav class="breadcrumb-custom">
        <a href="{{ route('home') }}">Beranda</a>
        <span> / </span>
        <a href="{{ route('news.index') }}">Berita</a>
        <span> / </span>
        <span class="active">{{ $article['title'] }}</span>
    </nav>

    <!-- Article Header -->
    <div class="article-header">
        <h1 class="article-title">{{ $article['title'] }}</h1>
        <div class="article-meta">{{ $article['date'] }}</div>
    </div>

    <!-- Article Image -->
    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="article-image">

    <!-- Article Content -->
    <div class="article-content">
        <p>{{ $article['content'] }}</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque gravida arcu ut ultricies bibendum. Integer vitae pharetra velit. Nam porttitor mauris nunc, in molestie nulla placerat non.</p>
        <p>Sed euismod turpis eget nulla scelerisque, vel finibus turpis ultrices. Donec ac justo at libero tincidunt volutpat. Suspendisse potenti. Nullam in ligula eu nulla tincidunt varius. Maecenas euismod eros vel justo scelerisque, at bibendum nisi fermentum.</p>
    </div>

    <!-- Back Button -->
    <a href="{{ route('news.index') }}" class="back-button">← Kembali ke Berita</a>
</main>
@endsection