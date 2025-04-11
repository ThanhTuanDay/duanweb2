<?php 
require_once(dirname(__DIR__) . "/../staticOrderStatus.php");
require_once(dirname(__DIR__) . "/OrderStatusContext.php");
class PendingState implements OrderStatusState {
    public function getStatus(): string {
        return OrderStatus::Pending;
    }
    public function cancel(OrderStatusContext $context): void {
        throw new Exception("Đơn hàng đã hoàn thành không thể hủy.");
    }

    public function next(OrderStatusContext $context): void {
        $context->setState(new DeliveryState());
    }
}
?>