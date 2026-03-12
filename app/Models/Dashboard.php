<?php
require_once __DIR__ . '/../Database/Database.php';

class Dashboard{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }


      public function totalProducts()
    {
        $sql = "SELECT COUNT(*) AS total_products FROM products";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetch();

        return $results['total_products'] ?? 0;
    }
    public function totalStockIn()
    {
        $sql = "SELECT SUM(quantity) AS total_stockIn FROM stock_in";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetch();

        return $results['total_stockIn'] ?? 0;
    }
    public function totalStockOut()
    {
        $sql = "SELECT SUM(quantity) AS total_stockOut FROM stock_out";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetch();

        return $results['total_stockOut'] ?? 0;
    }

    public function lowStock()
    {
        $sql = "SELECT COUNT(*) AS low_stock FROM products WHERE quantity < 10";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetch();

        return $results['low_stock'] ?? 0;
    }
}