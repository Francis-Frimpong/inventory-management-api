<?php
require_once __DIR__ .'/../Models/Category.php';
require_once __DIR__ . '/../Core/Response.php';

class CategoryController{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function showCategoryList()
    {
        $categoryName = $this->category->showCategory();

        $data = [
            'name' => $categoryName
        ];

        Response::json($data, 200);
        exit;
    }

    public function addCategory()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$data){
            Response::json(['error' => 'Invalid JSON or empty body'], 400);
            return;
        }

        if(empty(trim($data['name']))){
            Response::json(['error' => 'Category name is required'], 400);
            return;
        }

        $addCategory = $this->category->category($data['name']);

        if($addCategory){
            Response::json(['success' => 'Category added'],200);
        }
    }

    public function deleteCategory($id)
    {
        $deleteCategory = $this->category->delete($id);

        if($deleteCategory){
            Response::json(['success' => 'Category deleted'],200);
        }
    }

}