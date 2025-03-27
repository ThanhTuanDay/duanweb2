<?php
require_once(dirname(__DIR__) . "../dto/order.dto.php");

class OrderModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->link;
    }

    public function createOrder(OrderDto $order): bool
    {
        $sql = "INSERT INTO orders (user_id, total_price, status, store_id, created_at)
        VALUES ( ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        $userId = $order->getUserId();
        $totalPrice = $order->getTotalPrice();
        $status = $order->getStatus();
        $storeId = $order->getStoreId();

        $stmt->bind_param(
            "sdss",
            $userId,
            $totalPrice,
            $status,
            $storeId
        );

        return $stmt->execute();
    }

    public function getOrderById($id): ?OrderDto
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $this->mapToOrderDto($data);
        }
        return null;
    }

    public function updateOrderStatus($orderId, $status): bool
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $status, $orderId);
        return $stmt->execute();
    }

    public function deleteOrder($id): bool
    {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    public function getOrdersByStoreId($storeId): array
    {
        $orders = [];
        $sql = "SELECT * FROM orders WHERE store_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $storeId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $this->mapToOrderDto($row);
        }
        return $orders;
    }

    private function mapToOrderDto($data): OrderDto
    {
        return new OrderDto(
            $data['id'],
            $data['user_id'],
            (float) $data['total_price'],
            $data['status'],
            $data['store_id'],
            $data['created_at']
        );
    }
}
?>