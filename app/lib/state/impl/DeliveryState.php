<?php 
require_once(dirname(__DIR__) . "/../staticOrderStatus.php");
require_once(dirname(__DIR__) . "/OrderStatusContext.php");
class DeliveryState implements OrderStatusState {
    public function getStatus(): string {
        return OrderStatus::Delivering;
    }
    public function cancel(OrderStatusContext $context): void {
        $context->setState(new CancelledState());
    }
    public function next(OrderStatusContext $context): void {
        $context->setState(new CompletedState());
    }
}
?>