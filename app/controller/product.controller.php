<?php
require_once(dirname(__DIR__) . "../config/config.php");
require_once(dirname(__DIR__) . "../models/product.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/product.dto.php');
?>
<?php
class ProductController{
    private $db;
    private $productModel;
    public function __construct() {
        $this->db = new Database();
        $this->productModel = new ProductModel($this->db);
    }

    public function getPaginatedProducts($page, $perPage): array {
        $offset = ($page - 1) * $perPage;
        return $this->productModel->getProductsPaginated($perPage, $offset);
    }
    
    public function countTotalProducts(): int {
        return $this->productModel->countProducts();
    }

   public function createProduct($productDto): bool {
         return $this->productModel->createProduct($productDto);
   }
   public function updateProduct($productDto):bool{
        return $this->productModel->updateProduct($productDto);
   }

   public function deleteProduct($productId):bool{
        return $this->productModel->deleteProduct($productId);
   }

   public function isProductSold($productId):bool{
        return $this->productModel->isProductSold($productId);
   }
   public function blockProduct($productId):bool{
        return $this->productModel->updateStatusToFalse($productId);
   }
}

