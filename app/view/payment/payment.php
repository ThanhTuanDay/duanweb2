<?php
require(dirname(__DIR__) . "../../controller/payment.controller.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['amount'])) {
        echo json_encode(['error' => 'Missing amount']);
        exit;
    }
    $paymentMethod = $data['paymentMethod'] ?? null;
    $amount = (int) $data['amount'];
    $user_id = $data['userId'] ?? null;
    $deliveryAddressId = $data['deliveryAddressId'] ?? null;
    $cartItems = $data['cartItems'] ?? [];
    $addressInfo = $data['addressInfo'] ?? null;
    $userInfo = $data['userInfo'] ?? null;
    $orderId = uniqid();
    $orderInfo = "Thanh toán đơn hàng #$orderId";
    $taxFee = $data['taxFee'] ?? 0;
    $deliveryFee = $data['deliveryFee'] ?? 0;
    $taxRate = $data['taxRate'] ?? 0;
    $discountAmount = $data['discountAmount'] ?? 0;

    $paymentController = new PaymentController();



   if($paymentMethod == "momo"){
        $response = $paymentController->createMomoPayment($deliveryAddressId,$user_id,$amount, $orderId,$cartItems,$addressInfo,$userInfo, $orderInfo);
    }else if($paymentMethod == "cod"){
        $response = $paymentController->codPayment($deliveryAddressId,$user_id,$amount, $orderId,$cartItems,$addressInfo,$userInfo, $orderInfo, $taxFee, $deliveryFee, $taxRate, $discountAmount);
    }
    echo json_encode($response);
    exit;
}