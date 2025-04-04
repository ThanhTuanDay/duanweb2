<?php
include(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__DIR__) . "../models/order.model.php");
require_once(dirname(__DIR__) . "../models/momo-payment.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/order.dto.php');
?>
<?php
class PaymentController{
    private $db;
    private $momoPayment;
    private $orderModel;
    public function __construct() {
        $this->db = new Database();
        $this->momoPayment = new MomoPaymentModel();
        $this->orderModel = new OrderModel($this->db);
    }

    public function createMomoPayment($deliveryAddressId,$user_id,$amount, $orderId,$items,$deliveryInfo,$userInfo, $orderInfo){

        $orderDto= new OrderDto(null,$user_id,$amount,OrderStatus::Pending,"ee70a51b-0c45-11f0-ab99-6ef87da1f643",null,$deliveryAddressId,$items);
        $orderCreatedId =  $this->preCreateOrder($orderDto);
        
        if($orderCreatedId==null){
           return json_encode(['error' => 'Failed to create order']);
        }


        return $this->momoPayment->createPayment($orderCreatedId,$amount,$items,  $deliveryInfo,$userInfo,$orderInfo);
    }

    public function handlePaymentResponse($orderId,$status){
        return $this->orderModel->updateOrderStatus($orderId, $status);
    }
    private function preCreateOrder($orderDto) {
        return $this->orderModel->createOrder($orderDto);
    }

    public function getOrderById($orderId) {
        return $this->orderModel->getOrderWithAddressById($orderId);
    }
}

