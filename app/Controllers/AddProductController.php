<?php
require_once __DIR__ .'/../Models/AddProduct.php';
require_once __DIR__ .'/../Core/Response.php';

class AddProductController
{
    private AddProducts $addProducts;

    public function __construct()
    {
        $this->addProducts = new AddProducts();
    }

    public function addproductData()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$data){
            Response::json(['error' => 'Invalid JSON or empty body'], 400);
        }

        if(
            empty(trim($data['name'])) ||
            empty(trim($data['sku'])) ||
            empty(trim($data['category_id'])) ||
            empty(trim($data['cost_price'])) ||
            empty(trim($data['selling_price'])) 
        ){
            Response::json(['error' => 'Date are required in empty fields'], 400);
            return;
        }

        $product = $this->addProducts->addProduct($data['name'], $data['sku'], $data['category_id'], $data['cost_price'], $data['selling_price']);

        if($product){
            Response::json(['success' => 'Product data added']);

        }
    }
}