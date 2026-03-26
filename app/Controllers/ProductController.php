<?php
require_once __DIR__ . '/../Models/Products.php';

class ProductController
{
    private Products $product;

    public function __construct()
    {
        $this->product = new Products();
    }

    public function showProduct()
    {
        $addedProducts = $this->product->Product();

        $data = $addedProducts;

        Response::json($data, 200);
    }
}
