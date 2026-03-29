<?php
require_once __DIR__ . '/../Models/StockIn.php';
require_once __DIR__ . '/../Core/Response.php';

class StockInController
{
    private StockIn $addStockin;

    public function __construct()
    {
        $this->addStockin = new StockIn;
    }

    public function addStock()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$data){
            Response::json(['error' => 'Invalid JSON or empty body'], 400);
        }

        if(
            empty(trim($data['product_id'])) ||
            empty(trim($data['quantity'])) ||
            empty(trim($data['purchase_price'])) ||
            empty(trim($data['supplier']))
        ){
            Response::json(['error' => 'Date are required in empty fields'], 400);
            return;
        }

        $product = $this->addStockin->stockin($data['product_id'], $data['quantity'], $data['purchase_price'], $data['supplier'],);

        if($product){
            Response::json(['success' => 'Stock data added']);

        }
    }
}
