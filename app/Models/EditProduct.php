<?php
require_once __DIR__ . '/../Database/Database.php';

class EditProduct{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function editProduct($name, $sku, $category, $cost_price, $selling_price,$id)
    {
       try{

            $sql = "UPDATE products
                SET name = ?,
                    sku =  ?,
                    category_id = ?,
                    cost_price = ?,
                    selling_price = ?
                WHERE id = ?;";
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$name, $sku, $category, $cost_price, $selling_price, $id]);
            $stmt->rowCount();
            
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }
}