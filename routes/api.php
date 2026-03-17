<?php
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__. '/../app/Controllers/DashboardController.php';
require_once __DIR__. '/../app/Controllers/CategoryController.php';

$router = new Router();

//user dashboard
$router->get('/api/dashboard', [DashboardController::class, 'inventoryStats']);

$router->get('/api/dashboard/recent-transactions', [DashboardController::class, 'recentTransaction']);

$router->post('/api/categories', [CategoryController::class, 'addCategory']);


$router->dispatch();

