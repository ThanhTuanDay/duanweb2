<?php 
require_once(dirname(__DIR__) . "/../staticOrderStatus.php");
require_once(dirname(__DIR__) . "/OrderStatusContext.php");
class CancelledState implements OrderStatusState {
    public function next(OrderStatusContext $context): void {
        throw new Exception("Đơn hàng đã bị hủy.");
    }

    public function cancel(OrderStatusContext $context): void {
        throw new Exception("Đơn hàng đã bị hủy rồi.");
    }

    public function getStatus(): string {
        return OrderStatus::Cancelled;
    }
}

?>