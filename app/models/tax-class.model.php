<?php
class TaxClassModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn->link;
    }

    public function getAllTaxClasses(): array
    {
        $sql = "SELECT * FROM tax_classes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $classes = [];
        while ($row = $result->fetch_assoc()) {
            $classes[] = $row;
        }
        return $classes;
    }

    public function createTaxClass(string $name, string $description): bool
    {
        $sql = "INSERT INTO tax_classes (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $name, $description);
        return $stmt->execute();
    }

    public function updateTaxClass(int $id, string $name, string $description): bool
    {
        $sql = "UPDATE tax_classes SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $description, $id);
        return $stmt->execute();
    }

    public function deleteTaxClass(int $id): bool
    {
        $sql = "DELETE FROM tax_classes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


?>