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

    public function transaction()
    {
          $sql = "SELECT p.name, 'Stock In' AS type, si.quantity, si.date
        FROM stock_in si
        JOIN products p ON si.product_id = p.id

        UNION ALL

        SELECT p.name, 'Stock Out' AS type, so.quantity, so.date
        FROM stock_out so
        JOIN products p ON so.product_id = p.id

        ORDER BY date DESC
        LIMIT 5;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}