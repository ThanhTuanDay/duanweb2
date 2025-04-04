<?php
require(dirname(__DIR__) . "../../controller/payment.controller.php");
require(dirname(__DIR__) . "../../lib/staticOrderStatus.php");
$body = file_get_contents("php://input");
file_put_contents("momo_ipn_log.txt", $body . PHP_EOL, FILE_APPEND);


$data = json_decode($body, true);

if (!$data || !isset($data['orderId']) || !isset($data['resultCode'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid data']);
    exit;
}


$orderId = $data['orderId'];
$resultCode = $data['resultCode']; 
$amount = $data['amount'];
$transId = $data['transId'] ?? null;
$paymentController = new PaymentController();
if ($resultCode == 0) {
    // thành công
    $paymentController->handlePaymentResponse($orderId, OrderStatus::Processing);

} else {
    // thất bại
    $paymentController->handlePaymentResponse($orderId, OrderStatus::Cancelled);
}


echo json_encode(['message' => 'IPN received successfully']);
