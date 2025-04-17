<?php
include(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__DIR__) . "../models/order.model.php");
require_once(dirname(__DIR__) . "../models/product.model.php");
require_once(dirname(__DIR__) . "../models/momo-payment.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/order.dto.php');
?>
<?php
class OrderController{
    private $db;
    private $momoPayment;
    private $orderModel;
    private $productModel;
    public function __construct() {
        $this->db = new Database();
        $this->orderModel = new OrderModel($this->db);
    }

    public function preCreateOrder($orderDto) {
        return $this->orderModel->createOrder($orderDto);
    }

    public function getOrderById($orderId) {
        return $this->orderModel->getOrderWithAddressById($orderId);
    }

    public function getOrderTimeLine($orderId){
        return $this->orderModel->getOrderTimeline($orderId);
    }

    public function getOrderItemsByOrderId($orderId) {
        return $this->orderModel->getOrderItemsWithProductInfoByOrderId($orderId);
    }
    public function getOrdersByUserId($userId) {
        return $this->orderModel->getOrdersByUserId($userId);
    }

    public function getAllOrders(){
        return $this->orderModel->getAllOrders();
    }

    public function deleteOrder($orderId){
        return $this->orderModel->deleteOrder($orderId);
    }

    public function updateOrderStatus($orderId,$status,$description = null){
        return $this->orderModel->updateOrderStatus($orderId,$status,$description);
    }

    public function getRecentOrderStatus($limit =5){
        return $this->orderModel->getRecentOrderStatuses($limit);
    }


    public function getSalesByDate($startDate, $endDate,$period) {
        return $this->orderModel->getSalesByDate($startDate, $endDate, $period);
    }

    public function getProductStats($productId){
        return $this->orderModel->getProductStats($productId);
    }
}

