<?php
require_once __DIR__ . '/../Database/Database.php';

class StockOut{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function stockout($product, $quantity,$selling_price)
    {
        //  start transaction
        $this->pdo->beginTransaction();

        // Insert into stock_in
        $sql1 = "INSERT INTO stock_out (product_id, quantity, selling_price) VALUES (?,?,?)";
        $stmt1 = $this->pdo->prepare($sql1);
        $result1 = $stmt1->execute([$product, $quantity, $selling_price]);

        // Update products quantity
        $sql2 = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
        $stmt2 = $this->pdo->prepare($sql2);
        $result2 = $stmt2->execute([$quantity, $product]);

        // Check if BOTH queries succeeded
        if($result1 && $result2){
            // Everything worked
            $this->pdo->commit();
            return true;
        } else {
            // Something failed
            $this->pdo->rollBack();
            return false;
        }
    }
}