<?php
include(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__DIR__) . "../models/order.model.php");
require_once(dirname(__DIR__) . "../models/product.model.php");
require_once(dirname(__DIR__) . "../models/momo-payment.model.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../dto/order.dto.php');
?>
<?php
class PaymentController{
    private $db;
    private $momoPayment;
    private $orderModel;
    private $productModel;
    public function __construct() {
        $this->db = new Database();
        $this->momoPayment = new MomoPaymentModel();
        $this->orderModel = new OrderModel($this->db);
        $this->productModel = new ProductModel($this->db);
    }

    public function createMomoPayment($deliveryAddressId,$user_id,$amount, $orderId,$items,$deliveryInfo,$userInfo, $orderInfo){

        $orderDto= new OrderDto(null,$user_id,$amount,OrderStatus::Pending,"ee70a51b-0c45-11f0-ab99-6ef87da1f643",null,$deliveryAddressId,$items);
        
        if(!$this->handleProductSell($items)){
            return json_encode(['error' => 'Failed to sell product']);
        }
        
        
        $orderCreatedId =  $this->preCreateOrder($orderDto);
        
        if($orderCreatedId==null){
           return json_encode(['error' => 'Failed to create order']);
        }


        return $this->momoPayment->createPayment($orderCreatedId,$amount,$items,  $deliveryInfo,$userInfo,$orderInfo);
    }


    private function handleProductSell($items){
        foreach($items as $item){
            $productId = $item['id'];
            $quantity = $item['quantity'];
            if(!$this->productModel->sellProduct($productId, $quantity)){
                return false;
            }
        }
        return true;
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

    public function getOrderItemsByOrderId($orderId) {
        return $this->orderModel->getOrderItemsWithProductInfoByOrderId($orderId);
    }


    public function getOrdersByUserId($userId) {
        return $this->orderModel->getOrdersByUserId($userId);
    }
}

