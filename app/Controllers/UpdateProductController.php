<?php
require_once __DIR__ . '/../Models/EditProduct.php';

class UpdateProductController
{
    private EditProduct $updateProduct;

    public function __construct()
    {
        $this->updateProduct = new EditProduct();
    }

    public function updateProduct($id)
    {
        try{

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
    
            $productUpdate = $this->updateProduct->editProduct($data['name'], $data['sku'], $data['category_id'], $data['cost_price'], $data['selling_price'], $id);
    
            if($productUpdate){
                Response::json(['success' => 'Product data updated'],200);
                return;
            }
           
        }catch(Exception $e){
              echo "Error updating product: " . $e->getMessage();
            exit;
        }
    }
}
