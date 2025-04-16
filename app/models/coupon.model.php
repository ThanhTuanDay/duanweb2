<?php
class CouponModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn->link;
    }

    public function getAllCoupons(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM coupons ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        $coupons = [];
        while ($row = $result->fetch_assoc()) {
            $coupons[] = $row;
        }

        return $coupons;
    }

    public function getCouponById(string $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM coupons WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc() ?: null;
    }

    public function createCoupon(array $data): bool
    {
        $sql = "INSERT INTO coupons 
            (id, name, code, description, discount_type, discount_amount, valid_from, valid_until, minimum_spend, maximum_spend, usage_limit, usage_limit_per_user, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssiiii",
            $data['id'],
            $data['name'],
            $data['code'],
            $data['description'],
            $data['discount_type'],
            $data['discount_amount'],
            $data['valid_from'],
            $data['valid_until'],
            $data['minimum_spend'],
            $data['maximum_spend'],
            $data['usage_limit'],
            $data['usage_limit_per_user'],
            $data['is_active']
        );
        return $stmt->execute();
    }

    public function updateCoupon(string $id, array $data): bool
    {
        $sql = "UPDATE coupons SET name=?, code=?, description=?, discount_type=?, discount_amount=?, valid_from=?, valid_until=?, minimum_spend=?, maximum_spend=?, usage_limit=?, usage_limit_per_user=?, active=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssiiis",
            $data['name'],
            $data['code'],
            $data['description'],
            $data['discount_type'],
            $data['discount_amount'],
            $data['valid_from'],
            $data['valid_until'],
            $data['minimum_spend'],
            $data['maximum_spend'],
            $data['usage_limit'],
            $data['usage_limit_per_user'],
            $data['active'],
            $id
        );
        return $stmt->execute();
    }

    public function deleteCoupon(string $id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM coupons WHERE id = ?");
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}


?>