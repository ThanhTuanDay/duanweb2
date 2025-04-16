<?php

class SettingsModel
{
    private $conn;
    private $table = "stores";

    public function __construct($db)
    {
        $this->conn = $db->link;
    }

    public function getStoreInfo($id = "ee70a51b-0c45-11f0-ab99-6ef87da1f643"): ?array
    {
        $sql = "SELECT * FROM {$this->table} Where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
    
        return null;
    }

    public function updateStoreInfo(array $data): bool
    {
        $sql = "UPDATE {$this->table}
                SET 
                    name = ?,
                    email = ?,
                    phone = ?,
                    currency = ?,
                    minimum_order_amount = ?,
                    delivery_fee = ?,
                    free_delivery_enabled = ?,
                    free_delivery_threshold = ?,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param(
            "ssssddiis",
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['currency'],
            $data['minimum_order_amount'],
            $data['delivery_fee'],
            $data['free_delivery_enabled'],
            $data['free_delivery_threshold'],
            $data['id']
        );

        return $stmt->execute();
    }


    public function getAllSettings(): array
    {
        $sql = "SELECT `key`, `value` FROM settings";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $settings = [];
        while ($row = $result->fetch_assoc()) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    public function updateSetting(string $key, $value): bool
    {
        $sql = "INSERT INTO settings (`key`, `value`) VALUES (?, ?) 
                ON DUPLICATE KEY UPDATE `value` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $key, $value, $value);
        return $stmt->execute();
    }


    public function updateSettings(array $settings): bool
    {
        foreach ($settings as $key => $value) {
            if (!$this->updateSetting($key, $value)) {
                return false;
            }
        }
        return true;
    }

}
