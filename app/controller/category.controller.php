<?php
require_once(dirname(__DIR__) . "../config/config.php");
require_once(dirname(__DIR__) . "../models/category.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/product.dto.php');
?>
<?php
class CategoryController {
    private $db;
    private $categoryModel;

    public function __construct() {
        $this->db = new Database();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function getAllCategory(): array {
        return $this->categoryModel->getAllCategories();
    }
    public function getPaginatedCategories($page, $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        return $this->categoryModel->getPaginationCategories($offset, $perPage);
    }
}

