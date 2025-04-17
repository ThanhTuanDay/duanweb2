<?php
require_once(dirname(__DIR__) . "../dto/order.dto.php");
require_once(dirname(__DIR__) . "../lib/staticOrderStatus.php");
require_once(dirname(__DIR__) . "../lib/state/OrderStatusContext.php");
require_once(dirname(__DIR__) . "../lib/state/OrderStateFactory.php");
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


    public function getOrderItemsWithProductInfoByOrderId($orderId): array
    {
        $sql = "SELECT oi.*,p.name,p.image_url FROM order_items as oi join products as p on oi.product_id = p.id  WHERE oi.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
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
        $sql = "SELECT o.*,a.address,u.name,u.email,a.phone 
        FROM orders as o 
        JOIN user_addresses as a on o.user_id = a.user_id and o.delivery_address_id = a.id  
        JOIN users as u on u.id = o.user_id
        WHERE o.id =  ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $data = $result->fetch_assoc();
            return $this->mapToOrderDto($data);
        }
        return null;
    }

    public function getOrderTimeline(string $orderId): array
    {
        $sql = "SELECT status, description, created_at 
                FROM order_status 
                WHERE order_id = ? 
                ORDER BY created_at ASC";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt)
            return [];

        $stmt->bind_param("s", $orderId);
        $stmt->execute();

        $result = $stmt->get_result();
        $timeline = [];

        while ($row = $result->fetch_assoc()) {
            $timeline[] = [
                'status' => $row['status'],
                'description' => $row['description'],
                'created_at' => $row['created_at'],
            ];
        }

        return $timeline;
    }

    public function getOrdersByUserId($userId): array
    {
        $orders = [];
        $sql = "SELECT o.*,a.address,u.name 
        FROM orders as o 
        JOIN user_addresses as a on o.user_id = a.user_id and o.delivery_address_id = a.id 
        JOIN users AS u 
        ON u.id = o.user_id  WHERE o.user_id =  ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $this->mapToOrderDto($row);
        }
        return $orders;
    }

    public function getRecentOrderStatuses(int $limit = 5): array
    {
        $sql = "SELECT os.*, o.user_id, u.name AS user_name 
                FROM order_status os
                JOIN orders o ON os.order_id = o.id
                JOIN users u ON o.user_id = u.id
                ORDER BY os.created_at DESC
                LIMIT ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $recentStatuses = [];
        while ($row = $result->fetch_assoc()) {
            $recentStatuses[] = [
                'order_id' => $row['order_id'],
                'status' => $row['status'],
                'description' => $row['description'],
                'created_at' => $row['created_at'],
                'user_name' => $row['user_name']
            ];
        }

        return $recentStatuses;
    }

    public function getSalesByDate($from, $to, $period = 'weekly')
    {
        $results = [];
        $stmt = $this->conn->prepare("SELECT 
            DATE(created_at) AS date,
            SUM(total_price) AS total
        FROM orders
        WHERE created_at BETWEEN ? AND ?
        GROUP BY DATE(created_at)
    ");
        $stmt->bind_param("ss", $from, $to);
        $stmt->execute();
        $res = $stmt->get_result();


        $sales = [];
        while ($row = $res->fetch_assoc()) {
            $sales[$row['date']] = (float) $row['total'];
        }

        $date = new DateTime($from);
        $end = new DateTime($to);
        $end->setTime(23, 59, 59);

        while ($date <= $end) {
            $key = $date->format('Y-m-d');

            if ($period === 'yearly') {
                $monthKey = $date->format('Y-m');
                if (!isset($results[$monthKey])) {
                    $results[$monthKey] = 0;
                }
                if (isset($sales[$key])) {
                    $results[$monthKey] += $sales[$key];
                }
            } elseif ($period === 'monthly') {
                $dayKey = $date->format('Y-m-d');
                $results[$dayKey] = $sales[$dayKey] ?? 0;
            } else { 
                $dayKey = $date->format('Y-m-d');
                $results[$dayKey] = $sales[$dayKey] ?? 0;
            }

            $date->modify('+1 day');
        }

       
        $final = [];
        foreach ($results as $label => $total) {
            $final[] = [
                'date' => $label,
                'total' => $total
            ];
        }

        return $final;
    }


    public function getProductStats($productId): ?array
    {
        $sql = "
            SELECT 
                IFNULL(SUM(oi.quantity), 0) AS total_sales,
                IFNULL(SUM(oi.quantity * oi.price), 0) AS revenue,
                IFNULL(SUM(oi.quantity * oi.price * 0.4), 0) AS profit, 
                ROUND(IFNULL(SUM(oi.quantity * oi.price * 0.4) / NULLIF(SUM(oi.quantity * oi.price), 0), 0) * 100, 2) AS profit_margin
            FROM order_items oi
            JOIN orders o ON o.id = oi.order_id
            WHERE oi.product_id = ?
            AND o.status IN ('completed') 
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateOrderStatus($orderId, $status, $description = null): bool
    {
        $sql = "SELECT status FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            $currentStatus = $row['status'];

            $context = new OrderStatusContext();
            $context->setState(OrderStateFactory::fromString($currentStatus));

            try {
                if ($status === OrderStatus::Cancelled) {
                    $context->cancel();
                } else {
                    $context->next();
                    if ($context->getState()->getStatus() !== $status)
                        return false;
                }

                $updatedStatus = $context->getState()->getStatus();

                $updateStmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
                $updateStmt->bind_param("ss", $updatedStatus, $orderId);
                $updateSuccess = $updateStmt->execute();
                file_put_contents(__DIR__ . '/order-log', json_encode("UPDATE SUCCESS {$updateSuccess}"), FILE_APPEND);

                $logSuccess = $this->logOrderStatus($orderId, $updatedStatus, $description);

                return $updateSuccess && $logSuccess;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }
    public function logOrderStatus(string $orderId, string $status, string $description): bool
    {
        $sql = "INSERT INTO order_status (order_id, status, description, created_at)
            VALUES (?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt)
            return false;

        $stmt->bind_param("sss", $orderId, $status, $description);
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

    public function getAllOrders()
    {
        $sql = "SELECT 
    o.*, 
    a.address, 
    u.name 
    FROM orders AS o
    JOIN user_addresses AS a 
        ON o.user_id = a.user_id 
        AND o.delivery_address_id = a.id
    JOIN users AS u 
        ON u.id = o.user_id
    ORDER BY o.created_at DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $orders = [];

            while ($row = $result->fetch_assoc()) {
                $orders[] = $this->mapToOrderDto($row);
            }

            return $orders;
        }

        return null;
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
        if (isset($data['address'])) {
            $orderDto->setDeliveryAddress($data['address']);
        }
        if (isset($data['name'])) {
            $orderDto->setUserName($data['name']);
        }
        if (isset($data['payment_method'])) {
            $orderDto->setPaymentMethod($data['payment_method']);
        }

        if (isset($data['email'])) {
            $orderDto->setUserEmail($data['email']);
        }

        if (isset($data['phone'])) {
            $orderDto->setPhone($data['phone']);
        }

        return $orderDto;
    }
}
