<?php
require_once(dirname(__DIR__) . "../dto/category.dto.php");


class CategoryModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->link;
    }

    public function createCategory(CategoryDto $category): bool
    {
        $sql = "INSERT INTO categories (name, description, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        $name = $category->getName();
        $description = $category->getDescription();

        $stmt->bind_param(
            "ss",
            $name,
            $description
        );

        return $stmt->execute();
    }

    public function getCategoryById($id): ?CategoryDto
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $this->mapToCategoryDto($data);
        }
        return null;
    }

    public function updateCategory(CategoryDto $category): bool
    {
        if ($this->isCategorySold($category->getId())) {
            return false;
        }

        $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);


        $name = $category->getName();
        $description = $category->getDescription();
        $id = $category->getId();

        $stmt->bind_param(
            "sss",
            $name,
            $description,
            $id
        );

        return $stmt->execute();
    }

    public function isCategorySold($categoryId): bool
    {
        $sql = "SELECT COUNT(*) as total 
                FROM products p
                JOIN order_items oi ON p.id = oi.product_id
                JOIN orders o ON oi.order_id = o.id
                WHERE p.category_id = ? AND o.status = 'completed'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'] > 0;
    }

    public function hasProductsInCategory($categoryId): bool
    {
        $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] > 0;
    }

    public function deleteCategory($id): bool
    {
        if ($this->hasProductsInCategory($id)) {
            return false;
        }

        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function getAllCategories(): array
    {
        $categories = [];
        $sql = "SELECT * FROM categories ORDER BY created_at DESC";
        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $categories[] = $this->mapToCategoryDto($row);
        }
        return $categories;
    }

    private function mapToCategoryDto($data): CategoryDto
    {
        return new CategoryDto(
            $data['id'],
            $data['name'],
            $data['description'],
            $data['created_at']
        );
    }
}
