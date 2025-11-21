@extends('layouts.app')

@section('title', 'Berita - Rumah Que-Que')

@section('content')
<style>
:root {
  --bg: #f7e9d5;
  --accent: #c66a21;
  --accent-dark: #7a2e03;
  --gold: #f1a92f;
  --card: #fff6ef;
  --shadow: rgba(60,30,10,0.15);
}

/*******************************************
  HERO SECTION
*******************************************/
.hero {
  display: flex;
  gap: 36px;
  align-items: center;
  padding: 40px 6%;
  justify-content: center;
  justify-items: center;
}

.hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 48px;
  margin-bottom: 12px;
  color: var(--accent-dark);
}

.meta {
  color: rgba(0,0,0,0.5);
  font-size: 14px;
  margin-bottom: 14px;
}

.hero p {
  max-width: 480px;
  line-height: 1.7;
  color: rgba(0,0,0,0.75);
}

.btn-primary {
  display: inline-block;
  margin-top: 18px;
  padding: 12px 28px;
  border-radius: 28px;
  background: #fff;
  border: 2px solid var(--accent-dark);
  text-decoration: none;
  font-weight: 600;
  color: var(--accent-dark);
  box-shadow: 0 6px 0 rgba(0,0,0,0.06);
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: var(--accent-dark);
  color: white;
  transform: translateY(-2px);
}

.hero-right {
  width: 500px;
  height: 400px;
  border-radius: 36px;
  overflow: hidden;
  box-shadow: 0 12px 30px var(--shadow);
}

.hero-right img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/*******************************************
  PROMO SECTION
*******************************************/
.promo {
  margin-top: 40px;
  background: linear-gradient(var(--gold), #f9b84a);
  padding: 80px 6%;
  border-top-left-radius: 260px;
  border-top-right-radius: 260px;
  text-align: center;
}

.promo .title {
  font-family: 'Playfair Display', serif;
  font-size: 40px;
  letter-spacing: 6px;
  margin-bottom: 30px;
  color: var(--accent-dark);
}

.carousel {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  gap: 20px;
}

.promo-cards {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.card {
  width: 360px;
  height: 220px;
  border-radius: 200px;
  background: var(--card);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  box-shadow: 0 18px 30px rgba(0,0,0,0.12);
  padding: 20px;
  transition: transform 0.3s ease;
}

.card:hover {
  transform: scale(1.02);
}

.card img {
  width: 140px;
  height: 90px;
  object-fit: contain;
  margin-bottom: 10px;
  filter: drop-shadow(0 6px 12px rgba(0,0,0,0.12));
}

.card-title {
  font-size: 14px;
  letter-spacing: 1px;
  margin-bottom: 6px;
}

.card-discount {
  font-family: 'Playfair Display';
  font-size: 26px;
  margin-top: 6px;
  font-weight: 700;
  color: var(--accent-dark);
}

.arrow {
  position: relative;
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255,255,255,0.85);
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
  cursor: pointer;
  font-size: 22px;
  font-weight: bold;
  color: var(--accent-dark);
  transition: all 0.3s ease;
}

.arrow:hover {
  background: white;
  transform: scale(1.1);
}

/*******************************************
  ACTIVITIES SECTION
*******************************************/
.activities {
  padding: 48px 6%;
  text-align: center;
}

.activities h2 {
  font-family: 'Playfair Display', serif;
  font-size: 36px;
  margin-bottom: 26px;
  color: var(--accent-dark);
}

.activities .grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 18px;
}

.activities img {
  width: 100%;
  height: 220px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 10px 18px var(--shadow);
  transition: transform 0.3s ease;
}

.activities img:hover {
  transform: scale(1.05);
}

/*******************************************
  NEWS SECTION
*******************************************/
.news {
  padding: 40px 6%;
  text-align: center;
}

.news h2 {
  font-family: 'Playfair Display';
  font-size: 36px;
  margin-bottom: 20px;
  color: var(--accent-dark);
}

.news .cards {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.card-news {
  background: #fff;
  padding: 18px;
  width: 320px;
  border-radius: 12px;
  box-shadow: 0 10px 18px rgba(0,0,0,0.06);
  text-align: left;
  transition: transform 0.3s ease;
}

.card-news:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 25px rgba(0,0,0,0.12);
}

.card-news h3 {
  font-family: 'Playfair Display';
  margin-bottom: 8px;
  color: var(--accent-dark);
  font-size: 18px;
}

.card-news p {
  font-size: 13px;
  line-height: 1.6;
  color: rgba(0,0,0,0.7);
}

.card-news a {
  display: inline-block;
  margin-top: 12px;
  color: var(--accent-dark);
  font-weight: 600;
  text-decoration: none;
  transition: color 0.3s ease;
}

.card-news a:hover {
  color: var(--accent);
}

/*******************************************
  RESPONSIVE BREAKPOINTS
*******************************************/
@media (max-width: 900px) {
  .hero {
    flex-direction: column;
  }

  .hero-right {
    width: 100%;
    height: 220px;
  }

  .activities .grid {
    grid-template-columns: 1fr;
  }

  .news .cards {
    flex-direction: column;
    align-items: center;
  }

  .carousel {
    flex-direction: column;
    gap: 30px;
  }
}
</style>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-left">
            <h1>{{ $featuredNews['title'] }}</h1>
            <div class="meta">{{ $featuredNews['date'] }}</div>
            <p>{{ $featuredNews['excerpt'] }}</p>
            <a class="btn-primary" href="{{ route('news.show', $featuredNews['id']) }}">Baca Selengkapnya</a>
        </div>
        <div class="hero-right">
            <img src="{{ $featuredNews['image'] }}" alt="{{ $featuredNews['title'] }}">
        </div>
    </section>

    <!-- Promo Section -->
    <section class="promo">
        <div class="title">PROMO SAAT INI</div>
        <div class="carousel">
            <div class="arrow left" onclick="prevPromo()">&#x2190;</div>
            
            <div class="promo-cards">
                @foreach($promos as $promo)
                <div class="card">
                    <img src="{{ $promo['image'] }}" alt="promo">
                    <div class="card-title">{{ $promo['title'] }}</div>
                    <div class="card-discount">{{ $promo['discount'] }}</div>
                </div>
                @endforeach
            </div>
            
            <div class="arrow right" onclick="nextPromo()">&#x2192;</div>
        </div>
    </section>

    <!-- Activities Section -->
    <section class="activities">
        <h2>Kegiatan Que-Que</h2>
        <div class="grid">
            @foreach($activities as $activity)
            <img src="{{ $activity }}" alt="kegiatan">
            @endforeach
        </div>
    </section>

    <!-- News Section -->
    <section class="news">
        <h2>Berita lainnya</h2>
        <div class="cards">
            @foreach($otherNews as $news)
            <article class="card-news">
                <h3>{{ $news['title'] }}</h3>
                <p>{{ $news['excerpt'] }}</p>
                <a href="{{ route('news.show', $news['id']) }}">Baca Selengkapnya →</a>
            </article>
            @endforeach
        </div>
    </section>
</main>

<script>
    document.querySelectorAll('.arrow').forEach(a => {
        a.addEventListener('click', () => {
            const cards = document.querySelectorAll('.promo .card');
            cards.forEach(c => {
                c.animate([
                    {transform: 'scale(1)'},
                    {transform: 'scale(0.96)'},
                    {transform: 'scale(1)'}
                ], {duration: 420});
            });
        });
    });

    function prevPromo() {
        // Animation already handled by event listener above
    }

    function nextPromo() {
        // Animation already handled by event listener above
    }
</script>
@endsection