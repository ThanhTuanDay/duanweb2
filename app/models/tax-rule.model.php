<?php
class TaxRuleModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->link;
    }

    public function getAllRules(): array
    {
        $sql = "SELECT * FROM tax_rules ORDER BY priority ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $rules = [];
        while ($row = $result->fetch_assoc()) {
            $rules[] = $row;
        }
        return $rules;
    }

    public function createTaxRule(array $data): bool
    {
        $sql = "INSERT INTO tax_rules (name, rate, country, state, priority,tax_class_id, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sdssiii",
            $data['name'],
            $data['rate'],
            $data['country'],
            $data['state'],
            $data['priority'],
            $data['tax_class_id'],
            $data['active']
        );
        return $stmt->execute();
    }

    public function updateTaxRule(int $id, array $data): bool
    {
        $sql = "UPDATE tax_rules SET name=?, rate=?, country=?, state=?, priority=?,tax_class_id=? ,is_active=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sdssiiii",
            $data['name'],
            $data['rate'],
            $data['country'],
            $data['state'],
            $data['priority'],
            $data['tax_class_id'],
            $data['active'],
            $id
        );
        return $stmt->execute();
    }
    public function updateTaxRuleStatus(int $id, array $data): bool
    {
        $sql = "UPDATE tax_rules SET is_active=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "ii",
            $data['active'],
            $id
        );
        return $stmt->execute();
    }

    public function deleteTaxRule(int $id): bool
    {
        $sql = "DELETE FROM tax_rules WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>