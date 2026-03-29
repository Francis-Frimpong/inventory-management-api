<?php
require_once __DIR__ . '/../Database/Database.php';

class StockIn{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function stockin($product, $quantity,$purchase_price,$supplier)
    {
        //  start transaction
        $this->pdo->beginTransaction();

        // Insert into stock_in
        $sql1 = "INSERT INTO stock_in (product_id, quantity, purchase_price, supplier) VALUES (?,?,?,?)";
        $stmt1 = $this->pdo->prepare($sql1);
        $result1 = $stmt1->execute([$product, $quantity, $purchase_price, $supplier]);

        // Update products quantity
        $sql2 = "UPDATE products SET quantity = quantity + ? WHERE id = ?";
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