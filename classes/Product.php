<?php

class Product {
    private $id;
    private $name;
    private $price;
    private $image;
    private $isBestSeller;

    public function __construct($id, $name, $price, $image, $isBestSeller = false) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->isBestSeller = $isBestSeller;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getFormattedPrice() {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImage() {
        return $this->image;
    }

    public function isBestSeller() {
        return $this->isBestSeller;
    }
}

?>
