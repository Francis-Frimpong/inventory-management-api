<?php
require_once __DIR__ . '/../Models/StockOut.php';
require_once __DIR__ . '/../Core/Response.php';

class StockOutController
{
    private StockOut $removeStockin;

    public function __construct()
    {
        $this->removeStockin = new StockOut;
    }

    public function removeStock()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$data){
            Response::json(['error' => 'Invalid JSON or empty body'], 400);
        }

        if(
            empty(trim($data['product_id'])) ||
            empty(trim($data['quantity'])) ||
            empty(trim($data['selling_price'])) 
        ){
            Response::json(['error' => 'Date are required in empty fields'], 400);
            return;
        }

        $product = $this->removeStockin->stockout($data['product_id'], $data['quantity'], $data['selling_price']);

        if($product){
            Response::json(['success' => 'Stock removed']);
        }
    }
}
