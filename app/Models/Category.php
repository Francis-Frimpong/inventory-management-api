<?php
require_once __DIR__ . '/../Database/Database.php';


class Category{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function category($name)
    {
        $sql = "INSERT INTO categories(name) VALUE (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name]);
        return $stmt;
    }

    public function showCategory()
    {
        $sql = "SELECT name FROM categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
         $sql = "
            DELETE FROM categories
            WHERE id = ?
            AND NOT EXISTS (
                    SELECT 1 
                    FROM products 
                    WHERE category_id = ?
            )
            ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id, $id]);
            return $stmt->fetch();
    }
}