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
    public function getProductsPaginated($limit, $offset): array
    {
        $sql = "
            SELECT p.*, c.name AS category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id
            ORDER BY p.created_at DESC
            LIMIT ? OFFSET ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
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
    public function countProducts(): int
    {
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

    public function isProductSold($id): bool
    {
        return $this->orderItemModel->isProductSold($id);
    }

    function updateStatusToFalse($id)
    {
        $sql = "UPDATE products SET status = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getProductsForMenu($offset = null, $limit = null, $filter): array
    {
        $sql = "SELECT p.*, c.name as category_slug 
            FROM products p
            JOIN categories c ON p.category_id = c.id 
            WHERE p.status = 1";

        if ($filter != 'all') {
            $sql .= " AND c.name = ?";
        }
        if ($offset != null && $limit != null) {
            $sql .= " ORDER BY p.created_at DESC LIMIT ?, ?";
        }

        $stmt = $this->conn->prepare($sql);

        if($offset != null && $limit != null){
            if ($filter != 'all') {
                $stmt->bind_param("sii", $filter, $offset, $limit);
            } else {
                $stmt->bind_param("ii", $offset, $limit);
            }
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
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
