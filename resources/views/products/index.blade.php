@extends('layouts.app')

@section('title', 'Katalog Produk - Rumah Que-Que')

@section('styles')
<style>
    main {
        flex: 1;
        padding: 40px 20px;
    }

    .catalog-header {
        text-align: center;
        margin: 0 0 40px;
        position: relative;
    }

    .catalog-title {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 700;
        color: #5c3317;
        margin-bottom: 0;
        font-family: 'Poppins', sans-serif;
    }

    .catalog-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .catalog-controls {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        gap: 20px;
    }

    .filter-section {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-btn {
        background-color: #f5e6d3;
        border: none;
        border-radius: 20px;
        padding: 8px 20px;
        font-size: 0.9rem;
        color: #5c3317;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        white-space: nowrap;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .filter-btn::after {
        content: '▾';
        font-size: 0.8rem;
    }

    .filter-btn:hover {
        background-color: #e8d4bb;
    }

    .right-section {
        display: flex;
        flex-direction: column;
        gap: 15px;
        align-items: flex-end;
    }

    .wishlist-btn {
        background-color: #fff;
        border: 2px solid #ff8c42;
        border-radius: 25px;
        padding: 8px 16px;
        font-size: 0.9rem;
        color: #ff8c42;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        font-weight: 500;
        text-decoration: none;
    }

    .wishlist-btn:hover {
        background-color: #ff8c42;
        color: #fff;
    }

    .search-section {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 20px;
        padding: 8px 16px;
        border: 1px solid #ddd;
        width: 100%;
        max-width: 200px;
    }

    .search-section input {
        border: none;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        width: 100%;
        padding: 0 8px;
    }

    .search-section i {
        color: #ff8c42;
        font-size: 1rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px 20px;
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0;
    }

    .product-card {
        background-color: transparent;
        border-radius: 0;
        padding: 0;
        text-align: center;
        position: relative;
        box-shadow: none;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image-container {
        position: relative;
        background-color: #fff;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .product-image {
        width: 100%;
        height: auto;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 10px;
        display: block;
    }

    .best-seller-badge {
        position: absolute;
        top: -10px;
        left: -10px;
        z-index: 10;
    }

    .best-seller-img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.2));
    }

    .product-info {
        background-color: #fff;
        border-radius: 15px;
        padding: 10px 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .product-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 4px;
        line-height: 1.3;
        font-family: 'Poppins', sans-serif;
    }

    .product-price {
        font-size: 0.85rem;
        color: #666;
        font-weight: 400;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 0;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 50px 0 60px;
        flex-wrap: wrap;
    }

    .page-link {
        width: 40px;
        height: 40px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        color: #999;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 1rem;
        border: 1px solid transparent;
    }

    .page-link:hover {
        color: #5c3317;
        background-color: #f5f5f5;
    }

    .page-link.active {
        background-color: transparent;
        color: #5c3317;
        font-weight: 700;
        border-bottom: 2px solid #5c3317;
    }

    @media (max-width: 1200px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 25px 15px;
        }
    }

    @media (max-width: 992px) {
        .catalog-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .right-section {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .search-section {
            max-width: 250px;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .catalog-header {
            margin: 0 0 30px;
        }

        .catalog-title {
            font-size: 2.5rem;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .filter-btn {
            padding: 6px 16px;
            font-size: 0.85rem;
        }

        .wishlist-btn {
            padding: 6px 14px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .catalog-title {
            font-size: 2rem;
        }

        .right-section {
            flex-direction: column;
            align-items: stretch;
        }

        .search-section {
            max-width: 100%;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .product-name {
            font-size: 0.9rem;
        }

        .product-price {
            font-size: 0.85rem;
        }

        .best-seller-badge img {
            width: 60px;
            height: 60px;
        }
    }
</style>
@endsection

@section('content')
<main>
    <div class="catalog-controls">
        <div class="filter-section">
            <button class="filter-btn">Kategori</button>
            <button class="filter-btn">Urut Berdasarkan</button>
        </div>

        <div class="right-section">
            <a href="#" class="wishlist-btn">
                <i class="bi bi-bag-heart"></i>
                Lihat Wishlist
            </a>

            <div class="search-section">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari" id="searchInput">
            </div>
        </div>
    </div>

    <div class="catalog-header">
        <h1 class="catalog-title">Produk Kami</h1>
    </div>

    <div class="products-grid">
        @foreach($products as $product)
        <a href="{{ route('products.show', $product['id']) }}" style="text-decoration: none; color: inherit;">
            <div class="product-card">
                <div class="product-image-container">
                    @if($product['is_best_seller'])
                    <div class="best-seller-badge">
                        <img src="https://via.placeholder.com/70x70/FFD700/000000?text=★" alt="Best Seller" class="best-seller-img">
                    </div>
                    @endif

                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="product-image">
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product['name'] }}</h3>
                    <p class="product-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="pagination">
        @for($i = 1; $i <= $totalPages; $i++)
        <a href="?page={{ $i }}" class="page-link {{ $i == $currentPage ? 'active' : '' }}">
            {{ $i }}
        </a>
        @endfor
    </div>
</main>
@endsection

@section('scripts')
<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const products = document.querySelectorAll('.product-card');
        
        products.forEach(product => {
            const productName = product.querySelector('.product-name').textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
                product.parentElement.style.display = 'block';
            } else {
                product.parentElement.style.display = 'none';
            }
        });
    });
</script>
@endsection