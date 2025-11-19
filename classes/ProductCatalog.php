<?php

require_once 'Product.php';

class ProductCatalog {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getAllProducts() {
        return $this->products;
    }

    public function getProductsByPage($page = 1, $perPage = 8) {
        $start = ($page - 1) * $perPage;
        return array_slice($this->products, $start, $perPage);
    }

    public function getTotalPages($perPage = 8) {
        return ceil(count($this->products) / $perPage);
    }

    public function getTotalProducts() {
        return count($this->products);
    }
}

?>
