@extends('layouts.app')

@section('title', $product['name'] . ' - Rumah Que-Que')

@section('styles')
<style>
    main {
        padding: 40px 20px;
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
    }

    .breadcrumb-custom a:hover {
        color: #AE4C02;
    }

    .breadcrumb-custom .active {
        color: #5c3317;
    }

    .product-detail-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 60px;
    }

    .product-image-large {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .product-detail-info {
        padding: 20px 0;
    }

    .best-seller-tag {
        display: inline-block;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        color: #000;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .product-detail-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #5c3317;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .product-detail-price {
        font-size: 2rem;
        font-weight: 700;
        color: #AE4C02;
        margin-bottom: 30px;
    }

    .product-description {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .stock-info {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
        font-size: 1rem;
    }

    .stock-label {
        color: #5c3317;
        font-weight: 600;
    }

    .stock-available {
        color: #22c55e;
        font-weight: 600;
    }

    .stock-out {
        color: #ef4444;
        font-weight: 600;
    }

    .quantity-selector {
        margin-bottom: 30px;
    }

    .quantity-label {
        display: block;
        color: #5c3317;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1rem;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0;
        width: fit-content;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
    }

    .quantity-btn {
        background: #f5e6d3;
        border: none;
        width: 45px;
        height: 45px;
        font-size: 1.5rem;
        color: #5c3317;
        cursor: pointer;
        transition: background 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-btn:hover {
        background: #e8d4bb;
    }

    .quantity-input {
        width: 80px;
        height: 45px;
        text-align: center;
        border: none;
        border-left: 2px solid #e0e0e0;
        border-right: 2px solid #e0e0e0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #5c3317;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .btn-add-cart {
        background: #FF9A3D;
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 154, 61, 0.3);
    }

    .btn-add-cart:hover {
        background: #AE4C02;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(174, 76, 2, 0.4);
    }

    .btn-buy-now {
        background: #fff;
        color: #AE4C02;
        border: 2px solid #AE4C02;
        padding: 15px 40px;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-buy-now:hover {
        background: #AE4C02;
        color: white;
        transform: translateY(-2px);
    }

    .btn-disabled {
        background: #ccc;
        color: #666;
        cursor: not-allowed;
        border: none;
    }

    .btn-disabled:hover {
        background: #ccc;
        transform: none;
    }

    .product-features {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px solid #f0f0f0;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .feature-icon {
        width: 24px;
        height: 24px;
        color: #AE4C02;
    }

    .feature-text {
        color: #666;
        font-size: 0.95rem;
    }

    @media (max-width: 992px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .product-detail-title {
            font-size: 2rem;
        }

        .product-detail-price {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 768px) {
        .product-detail-title {
            font-size: 1.75rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<main>
    <div class="product-detail-container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-custom">
            <a href="{{ route('home') }}">Beranda</a>
            <span> / </span>
            <a href="{{ route('products.index') }}">Katalog</a>
            <span> / </span>
            <span class="active">{{ $product['name'] }}</span>
        </nav>

        <!-- Product Detail -->
        <div class="product-detail-grid">
            <!-- Product Image -->
            <div>
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="product-image-large">
            </div>

            <!-- Product Info -->
            <div class="product-detail-info">
                @if($product['is_best_seller'])
                <span class="best-seller-tag">⭐ Best Seller</span>
                @endif

                <h1 class="product-detail-title">{{ $product['name'] }}</h1>

                <div class="product-detail-price">
                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                </div>

                <p class="product-description">
                    {{ $product['description'] }}
                </p>

                <!-- Stock -->
                <div class="stock-info">
                    <span class="stock-label">Stok:</span>
                    @if($product['stock'] > 0)
                    <span class="stock-available">{{ $product['stock'] }} Tersedia</span>
                    @else
                    <span class="stock-out">Habis</span>
                    @endif
                </div>

                <!-- Quantity -->
                <div class="quantity-selector">
                    <label class="quantity-label">Jumlah</label>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQty()">−</button>
                        <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="{{ $product['stock'] }}" readonly>
                        <button class="quantity-btn" onclick="increaseQty()">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @if($product['stock'] > 0)
                    <button class="btn-add-cart">
                        🛒 Tambah ke Keranjang
                    </button>
                    <button class="btn-buy-now">
                        Beli Sekarang
                    </button>
                    @else
                    <button class="btn-add-cart btn-disabled" disabled>
                        Stok Habis
                    </button>
                    @endif
                </div>

                <!-- Product Features -->
                <div class="product-features">
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="bi bi-truck feature-icon"></i>
                            <span class="feature-text">Pengiriman Cepat</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-shield-check feature-icon"></i>
                            <span class="feature-text">Produk Berkualitas</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-arrow-repeat feature-icon"></i>
                            <span class="feature-text">Garansi 7 Hari</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-credit-card feature-icon"></i>
                            <span class="feature-text">Pembayaran Aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    const maxStock = {{ $product['stock'] }};
    
    function increaseQty() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value < maxStock) {
            input.value = value + 1;
        }
    }
    
    function decreaseQty() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    }
</script>
@endsection