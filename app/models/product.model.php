<?php
require_once(dirname(__DIR__) . "../dto/product.dto.php");
require_once(dirname(__DIR__) . "/models/order-item.model.php");

class ProductModel
{
    private $conn;
    private $orderItemModel;
    public function __construct($db)
    {
        $this->conn = $db->link;
        $this->orderItemModel = new OrderItemModel($db);
    }

    public function createProduct(ProductDto $product): bool
    {
        $sql = "INSERT INTO products (name, description, price, category_id, image_url, stock, store_id, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $categoryId = $product->getCategoryId();
        $imageUrl = $product->getImageUrl();
        $stock = $product->getStock();
        $storeId = $product->getStoreId();

        $stmt->bind_param(
            "ssdssis",
            $name,
            $description,
            $price,
            $categoryId,
            $imageUrl,
            $stock,
            $storeId
        );

        return $stmt->execute();
    }

    public function isStockAvailable($productId, $quantity): bool
    {
        $sql = "SELECT stock FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['stock'] >= $quantity;
        }
        return false;
    }

    public function getProductsByStoreId($storeId): array
    {
        $products = [];
        $sql = "SELECT * FROM products WHERE store_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $storeId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $products[] = $this->mapToProductDto($row);
        }
        return $products;
    }

    public function getProductById($id): ?ProductDto
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $this->mapToProductDto($data);
        }
        return null;
    }

    public function updateProduct(ProductDto $product): bool
    {
        if ($this->orderItemModel->isProductSold($product->getId())) {
            return false;
        }

        $sql = "UPDATE products SET name = ?, description = ?, price = ?, category_id = ?, image_url = ?, stock = ?, store_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $categoryId = $product->getCategoryId();
        $imageUrl = $product->getImageUrl();
        $stock = $product->getStock();
        $storeId = $product->getStoreId();
        $id = $product->getId();

        $stmt->bind_param(
            "ssdssiss",
            $name,
            $description,
            $price,
            $categoryId,
            $imageUrl,
            $stock,
            $storeId,
            $id
        );

        return $stmt->execute();
    }
    public function countProducts(): int {
        $sql = "SELECT COUNT(*) as total FROM products";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
    public function deleteProduct($id): bool
    {
        if ($this->orderItemModel->isProductSold($id)) {
            return false;
        }

        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function getAllProducts(): array
    {
        $products = [];
        $sql = "SELECT * FROM products ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $products[] = $this->mapToProductDto($row);
        }
        return $products;
    }

    public function getProductsByCategoryId($categoryId): array
    {
        $products = [];
        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $products[] = $this->mapToProductDto($row);
        }

        $stmt->close();
        return $products;
    }

    public function sellProduct($productId, $quantity): bool
    {
        $sql = "SELECT stock FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result || $result->num_rows === 0) {
            return false;
        }

        $product = $result->fetch_assoc();

        if ($product['stock'] < $quantity) {
            return false;
        }


        $newStock = $product['stock'] - $quantity;
        $updateSql = "UPDATE products SET stock = ? WHERE id = ?";
        $updateStmt = $this->conn->prepare($updateSql);
        $updateStmt->bind_param("is", $newStock, $productId);
        $success = $updateStmt->execute();

        $updateStmt->close();
        return $success;
    }

    private function mapToProductDto($data): ProductDto
    {
        return new ProductDto(
            $data['id'],
            $data['name'],
            $data['description'],
            (float) $data['price'],
            $data['category_id'],
            $data['image_url'],
            (int) $data['stock'],
            $data['store_id'],
            $data['created_at']
        );
    }
}
