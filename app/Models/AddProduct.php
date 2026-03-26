<?php
require_once __DIR__ . '/../Database/Database.php';

class AddProducts{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function addProduct($productName,$sku,$category,$costPrice,$sellingPrice)
    {
        $sql = "INSERT INTO products (name, sku, category_id, cost_price, selling_price) VALUE (?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productName, $sku, $category, $costPrice, $sellingPrice]);

        return $stmt;
    }
}