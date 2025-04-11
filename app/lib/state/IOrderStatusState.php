<?php 
interface OrderStatusState {
    public function getStatus(): string;
    public function next(OrderStatusContext $context): void;
    public function cancel(OrderStatusContext $context): void;
}

?>