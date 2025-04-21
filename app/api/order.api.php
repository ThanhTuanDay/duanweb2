<?php
require_once(dirname(__DIR__) . '../controller/order.controller.php');
$orderController = new OrderController();

header('Content-Type: application/json');

if (
    ($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET['action'])) ||
    ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST['action']))
) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method or missing action"
    ]);
    exit();
}

$action = $_GET['action'] ?? $_POST['action'];

switch ($action) {
    case 'getAllOrders':
        $orders = $orderController->getAllOrders();
        $recentOrderStatus = $orderController->getRecentOrderStatus(5);
        if ($orders === null) {
            echo json_encode([]);
            exit;
        }
        if ($orders instanceof OrderDto) {
            $orders = [$orders];
        }

        $response = [
            "order" => array_map(function ($order) {
                return [
                    'id' => $order->getId(),
                    'user_id' => $order->getUserId(),
                    'user_name' => $order->getUserName(),
                    'total' => $order->getTotalPrice(),
                    'status' => $order->getStatus(),
                    'created_at' => $order->getCreatedAt(),
                    'payment_method' => "COD",
                    'delivery_address' => $order->getDeliveryAddress()
                ];
            }, $orders),
            "recentOrder" => $recentOrderStatus
        ];

        echo json_encode($response);
        break;

    case 'getOrderDetailById':
        $orderId = $_GET['orderId'] ?? null;
        if (!$orderId) {
            echo json_encode(["success" => false, "message" => "Missing order ID"]);
            exit();
        }

        $order = $orderController->getOrderById($orderId);
        $orderTimeLine = $orderController->getOrderTimeLine($orderId);
        $orderItem = $orderController->getOrderItemsByOrderId($orderId);

        if (!$order) {
            echo json_encode([
                "success" => false,
                "message" => "Order not found"
            ]);
            exit();
        }

        $response = [
            "success" => true,
            "order" => $order,
            "timeline" => $orderTimeLine,
            "items" => $orderItem,
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    case 'updateOrderStatus':
        $orderId = $_POST['orderId'] ?? null;
        $status = $_POST['status'] ?? null;
        $description = $_POST['description'] ?? null;
        if (!$orderId || !$status) {
            echo json_encode(["success" => false, "message" => "Missing order ID or status"]);
            exit();
        }

        $result = $orderController->updateOrderStatus($orderId, $status, $description);
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Order status updated' : 'Failed to update status'
        ]);
        break;
    case 'getSalesByDay':
        $from = $_POST['from'] ?? null;
        $to = $_POST['to'] ?? null;
        $period = $_POST['period'] ?? null;
        if (!$from || !$to) {
            echo json_encode(["success" => false, "message" => "Missing from/to date"]);
            break;
        }

        $salesData = $orderController->getSalesByDate($from, $to, $period);
        echo json_encode([
            "success" => true,
            "data" => $salesData
        ]);
        break;
    case 'getStats':
        $id = $_POST['id'] ?? null;
        $stats = $orderController->getProductStats($id);
        echo json_encode(['success' => true, 'data' => $stats]);
        break;

    case 'getTopCustomerByPurchase':
        $from = $_POST['from'] ?? null;
        $to = $_POST['to'] ?? null;
        $limit = $_POST['limit'] ?? 5;
        
        $topCustomers = $orderController->getTopCustomerByPurchase($from, $to, $limit);
        echo json_encode([
            "success" => true,
            "data" => $topCustomers
        ]);
        break;

    case 'getCustomerOrderDetail':
        $userId = $_POST['userId'] ?? null;
        if (!$userId) {
            echo json_encode(["success" => false, "message" => "Missing user ID"]);
            exit();
        }

        $orders = $orderController->getOrdersByUserId($userId);
        if ($orders === null) {
            echo json_encode([]);
            exit;
        }
        if ($orders instanceof OrderDto) {
            $orders = [$orders];
        }
        $response = [
            "success" => true,
            "orders" => array_map(function ($order) {
                return [
                    'id' => $order->getId(),
                    'user_id' => $order->getUserId(),
                    'user_name' => $order->getUserName(),
                    'total' => $order->getTotalPrice(),
                    'status' => $order->getStatus(),
                    'created_at' => $order->getCreatedAt(),
                    'payment_method' => "COD",
                    'delivery_address' => $order->getDeliveryAddress()
                ];
            }, $orders),
        ];

        echo json_encode($response);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Unknown action"]);
        break;
}
