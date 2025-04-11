<?php 
require_once(dirname(__DIR__) . "/../staticOrderStatus.php");
require_once(dirname(__DIR__) . "/OrderStatusContext.php");
class CompletedState implements OrderStatusState {
    public function getStatus(): string {
        return OrderStatus::Completed;
    }
    public function cancel(OrderStatusContext $context): void {
        $context->setState(new CancelledState());
    }
    public function next(OrderStatusContext $context): void {
        throw new Exception("Completed is a final state. Cannot proceed further.");
    }
}

?>