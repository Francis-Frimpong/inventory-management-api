<?php
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__. '/../app/Controllers/DashboardController.php';
require_once __DIR__. '/../app/Controllers/CategoryController.php';
require_once __DIR__. '/../app/Controllers/ProductController.php';

$router = new Router();

//user dashboard
$router->get('/api/dashboard', [DashboardController::class, 'inventoryStats']);

$router->get('/api/dashboard/recent-transactions', [DashboardController::class, 'recentTransaction']);

$router->get('/api/categories', [CategoryController::class, 'showCategoryList']);

$router->post('/api/categories/add-categories', [CategoryController::class, 'addCategory']);

$router->delete('/api/categories/delete-categories/{id}', [CategoryController::class, 'deleteCategory']);

// products
$router->get('/api/product', [ProductController::class, 'showProduct']);



$router->dispatch();

