<?php 
require_once(dirname(__DIR__) . "/staticOrderStatus.php");
require_once(dirname(__DIR__) . "/state/impl/PendingState.php");
require_once(dirname(__DIR__) . "/state/impl/DeliveryState.php");
require_once(dirname(__DIR__) . "/state/impl/CompletedState.php");
require_once(dirname(__DIR__) . "/state/impl/CancelledState.php");
class OrderStateFactory {
    public static function fromString(string $status): OrderStatusState {
        switch ($status) {
            case OrderStatus::Pending:
                return new PendingState();
            case OrderStatus::Delivering:
                return new DeliveryState();
            case OrderStatus::Completed:
                return new CompletedState();
            case OrderStatus::Cancelled:
                return new CancelledState();
            default:
                throw new InvalidArgumentException("Invalid order status: $status");
        }
    }
}
?>