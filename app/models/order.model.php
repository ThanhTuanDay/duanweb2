<?php
require_once(dirname(__DIR__) . "../dto/order.dto.php");
require_once(dirname(__DIR__) . "../lib/staticOrderStatus.php");
class OrderModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->link;
    }
    public function countOrders(): int
    {
        $sql = "SELECT COUNT(*) as total FROM orders";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getTopSellingCategories($limit = 5): array
    {
        $sql = "
            SELECT 
                c.name AS category_name,
                SUM(oi.quantity) AS total_sold
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            JOIN orders o ON oi.order_id = o.id
            WHERE o.status = ?
            GROUP BY c.id
            ORDER BY total_sold DESC
            LIMIT ?
        ";

        $status = OrderStatus::Completed;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function sumCompletedOrders(): float
    {
        $sql = "SELECT SUM(total_price) as revenue FROM orders WHERE status = ?";
        $stmt = $this->conn->prepare($sql);

        $status = OrderStatus::Completed;
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row['revenue'] ?? 0.0;
    }

    public function getRecentOrders(): array
    {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 5";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createOrder(OrderDto $order): ?string
    {
        $sql = "INSERT INTO orders (user_id, total_price, status, store_id, created_at, delivery_address_id)
            VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $this->conn->prepare($sql);
       
        $userId = $order->getUserId();
        $totalPrice = $order->getTotalPrice();
        $status = $order->getStatus();
        $storeId = $order->getStoreId();
        $deliveryAddressId = $order->getDeliveryAddressId();
        $stmt->bind_param("sdsss", $userId, $totalPrice, $status, $storeId, $deliveryAddressId);
        $result = $stmt->execute();

        $lastOrder = $this->getLastInsertedOrderByUser($userId);
        $orderId = $lastOrder['id'];
        if (!$result) {
            return null;
        }
        file_put_contents(__DIR__ . '/order-log', json_encode($orderId), FILE_APPEND);
        $this->insertOrderItems($orderId, $order->getOrderItems());
        return $orderId;
    }


    public function insertOrderItems($orderId, $orderItems): bool
    {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        foreach ($orderItems as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];

            $stmt->bind_param("ssds", $orderId, $productId, $quantity, $price);
            if (!$stmt->execute()) {
                return false;
            }
        }
        return true;
    }

    public function getLastInsertedOrderByUser($userId)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
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

    public function getOrderWithAddressById($id): ?OrderDto
    {
        $sql = "SELECT o.*,a.address FROM orders as o join user_addresses as a on o.user_id = a.user_id and o.delivery_address_id = a.id  WHERE o.id =  ?";
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
    public function getTopSellingProducts($limit = 5): array
    {
        $sql = "
            SELECT 
                p.id, 
                p.name, 
                p.image_url, 
                p.price,
                SUM(oi.quantity) as total_sold
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            JOIN orders o ON oi.order_id = o.id
            WHERE o.status = ?
            GROUP BY p.id
            ORDER BY total_sold DESC
            LIMIT ?
        ";

        $status = OrderStatus::Completed;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
  
    private function mapToOrderDto($data): OrderDto
    {
        $orderDto = new OrderDto(
            $data['id'],
            $data['user_id'],
            (float) $data['total_price'],
            $data['status'],
            $data['store_id'],
            $data['created_at']
        );
        file_put_contents(__DIR__ . '/order-log', json_encode($data['address']), FILE_APPEND);
        if(isset($data['address'])) {
            $orderDto->setDeliveryAddress($data['address']);
        }

        return $orderDto;
    }
}
?>