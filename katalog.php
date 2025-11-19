<?php

require_once 'classes/ProductCatalog.php';

$catalog = new ProductCatalog();

$catalog->addProduct(new Product(1, 'Kue Pisang Coklat', 20000, 'assets/rectangle 1.png', false));
$catalog->addProduct(new Product(2, 'Ketan Srikaya Pandan', 30000, 'assets/rectangle 16.png', true));
$catalog->addProduct(new Product(3, 'Tacookies (Almond)', 25000, 'assets/rectangle 10.png', true));
$catalog->addProduct(new Product(4, 'Tacookies (Coklat)', 25000, 'assets/rectangle 11.png', true));
$catalog->addProduct(new Product(5, 'Tacookies (Original)', 25000, 'assets/rectangle 12.png', false));
$catalog->addProduct(new Product(6, 'Snack Box 1', 5000, 'assets/rectangle 13.png', false));
$catalog->addProduct(new Product(7, 'Snack Box 2', 5000, 'assets/rectangle 14.png', false));
$catalog->addProduct(new Product(8, 'Wajik', 45000, 'assets/rectangle 15.png', false));

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$productsPerPage = 8;
$products = $catalog->getProductsByPage($currentPage, $productsPerPage);
$totalPages = $catalog->getTotalPages($productsPerPage);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Rumah Que-Que</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inria Serif', serif;
            background: linear-gradient(to bottom, #fef9ef, #fffaf3);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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
            font-family: 'Inria Serif', serif;
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
            font-family: 'Inria Serif', serif;
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
            font-family: 'Inria Serif', serif;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            font-weight: 500;
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
            font-family: 'Inria Serif', serif;
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

        .best-seller-badge svg {
            width: 70px;
            height: 70px;
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

        .best-seller-img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.2));
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
            line-height: 1.3;
            font-family: 'Inria Serif', serif;
        }

        .product-price {
            font-size: 0.85rem;
            color: #666;
            font-weight: 400;
            font-family: 'Inria Serif', serif;
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

            .product-card {
                padding: 12px;
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

            .product-card {
                padding: 10px;
            }

            .product-name {
                font-size: 0.9rem;
            }

            .product-price {
                font-size: 0.85rem;
            }

            .best-seller-badge svg {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>

<body>

    <?php include 'header2.php'; ?>

    <main>
        <div class="catalog-controls">
            <div class="filter-section">
                <button class="filter-btn">Kategori</button>
                <button class="filter-btn">Urut Berdasarkan</button>
            </div>

            <div class="right-section">
                <button class="wishlist-btn">
                    <i class="bi bi-bag-heart"></i>
                    Lihat Wishlist
                </button>

                <div class="search-section">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Cari">
                </div>
            </div>
        </div>

        <div class="catalog-header">
            <h1 class="catalog-title">Produk Kami</h1>
        </div>

        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image-container">
                        <?php if ($product->isBestSeller()): ?>
                            <div class="best-seller-badge">
                                <img src="assets/bestseller.png" alt="Best Seller" class="best-seller-img">
                            </div>
                        <?php endif; ?>

                        <img src="<?php echo $product->getImage(); ?>" alt="<?php echo $product->getName(); ?>" class="product-image">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?php echo $product->getName(); ?></h3>
                        <p class="product-price"><?php echo $product->getFormattedPrice(); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="page-link <?php echo $i === $currentPage ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>