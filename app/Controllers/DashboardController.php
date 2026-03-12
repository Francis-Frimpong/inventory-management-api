<?php
require_once __DIR__ . '/../Models/Dashboard.php';
require_once __DIR__ . '/../Core/Response.php';


class DashboardController
{
    private Dashboard $dashboard;

    public function __construct()
    {
        $this->dashboard = new Dashboard();
    }

    public function inventoryStats()
    {
        $totalProducts = $this->dashboard->totalProducts();
        $totalStockIn = $this->dashboard->totalStockIn();
        $totalStockOut = $this->dashboard->totalStockOut();
        $lowStock = $this->dashboard->lowStock();

        $data = [
            'totalProducts' => $totalProducts,
            'totalStockin' => $totalStockIn,
            'totalStockout' => $totalStockOut,
            'lowStock' => $lowStock
        ];

        Response::json($data, 200);
        echo "endpoint works";
        exit;
    }

}
