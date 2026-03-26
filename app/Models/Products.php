<?php
require_once __DIR__ . '/../Database/Database.php';

class Products{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function Product()
    {
        $sql = "SELECT name , sku, category_id, cost_price, quantity FROM products";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}