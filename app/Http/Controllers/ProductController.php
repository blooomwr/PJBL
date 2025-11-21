<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Data produk Rumah Que-Que (nanti akan dari database)
    private function getProducts()
    {
        return [
            [
                'id' => 1,
                'name' => 'Kue Pisang Coklat',
                'price' => 20000,
                'image' => 'https://via.placeholder.com/300x300/8B4513/ffffff?text=Kue+Pisang',
                'is_best_seller' => false,
                'description' => 'Kue pisang lembut dengan topping coklat yang lezat',
                'stock' => 20
            ],
            [
                'id' => 2,
                'name' => 'Ketan Srikaya Pandan',
                'price' => 30000,
                'image' => 'https://via.placeholder.com/300x300/228B22/ffffff?text=Ketan+Srikaya',
                'is_best_seller' => true,
                'description' => 'Ketan manis dengan srikaya pandan yang harum dan legit',
                'stock' => 15
            ],
            [
                'id' => 3,
                'name' => 'Tacookies (Almond)',
                'price' => 25000,
                'image' => 'https://via.placeholder.com/300x300/D2691E/ffffff?text=Tacookies+Almond',
                'is_best_seller' => true,
                'description' => 'Cookies renyah dengan taburan almond pilihan',
                'stock' => 30
            ],
            [
                'id' => 4,
                'name' => 'Tacookies (Coklat)',
                'price' => 25000,
                'image' => 'https://via.placeholder.com/300x300/6F4E37/ffffff?text=Tacookies+Coklat',
                'is_best_seller' => true,
                'description' => 'Cookies coklat dengan rasa yang rich dan renyah',
                'stock' => 25
            ],
            [
                'id' => 5,
                'name' => 'Tacookies (Original)',
                'price' => 25000,
                'image' => 'https://via.placeholder.com/300x300/CD853F/ffffff?text=Tacookies+Original',
                'is_best_seller' => false,
                'description' => 'Cookies original klasik dengan rasa mentega yang khas',
                'stock' => 35
            ],
            [
                'id' => 6,
                'name' => 'Snack Box 1',
                'price' => 50000,
                'image' => 'https://via.placeholder.com/300x300/FF8C42/ffffff?text=Snack+Box+1',
                'is_best_seller' => false,
                'description' => 'Paket snack box berisi kue-kue pilihan',
                'stock' => 10
            ],
            [
                'id' => 7,
                'name' => 'Snack Box 2',
                'price' => 50000,
                'image' => 'https://via.placeholder.com/300x300/FFA500/ffffff?text=Snack+Box+2',
                'is_best_seller' => false,
                'description' => 'Paket snack box dengan variasi kue premium',
                'stock' => 12
            ],
            [
                'id' => 8,
                'name' => 'Wajik',
                'price' => 45000,
                'image' => 'https://via.placeholder.com/300x300/8B6914/ffffff?text=Wajik',
                'is_best_seller' => false,
                'description' => 'Wajik tradisional dengan gula merah asli',
                'stock' => 18
            ],
        ];
    }

    public function index(Request $request)
    {
        $productsPerPage = 8;
        $currentPage = $request->input('page', 1);
        
        $allProducts = $this->getProducts();
        $totalProducts = count($allProducts);
        $totalPages = ceil($totalProducts / $productsPerPage);
        
        // Get products for current page
        $offset = ($currentPage - 1) * $productsPerPage;
        $products = array_slice($allProducts, $offset, $productsPerPage);
        
        return view('products.index', compact('products', 'currentPage', 'totalPages'));
    }

    public function show($id)
    {
        $products = $this->getProducts();
        $product = collect($products)->firstWhere('id', $id);
        
        if (!$product) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }
}