<?php

class OrderItemModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->link;
    }

    public function createOrderItem(OrderItemDto $item): bool
    {
        $sql = "INSERT INTO order_items ( order_id, product_id, quantity, price)
        VALUES ( ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $orderId = $item->getOrderId();
        $productId = $item->getProductId();
        $quantity = $item->getQuantity();
        $price = $item->getPrice();

        $stmt->bind_param(
            "ssii",
            $orderId,
            $productId,
            $quantity,
            $price
        );

        return $stmt->execute();
    }

    public function isProductSold($productId): bool
    {
        $sql = "SELECT COUNT(*) as total 
                FROM order_items oi
                JOIN orders o ON oi.order_id = o.id
                WHERE oi.product_id = ? AND o.status = 'completed'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            return $row['total'] > 0;
        }
        return false;
    }

    public function getOrderItemsByOrderId($orderId): array
    {
        $items = [];
        $sql = "SELECT * FROM order_items WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $items[] = $this->mapToOrderItemDto($row);
        }
        return $items;
    }

    public function deleteItemsByOrderId($orderId): bool
    {
        $sql = "DELETE FROM order_items WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $orderId);
        return $stmt->execute();
    }

    private function mapToOrderItemDto($data): OrderItemDto
    {
        return new OrderItemDto(
            $data['id'],
            $data['order_id'],
            $data['product_id'],
            (int) $data['quantity'],
            (float) $data['price']
        );
    }
}
