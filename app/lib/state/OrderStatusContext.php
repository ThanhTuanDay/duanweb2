<?php 
require_once(dirname(__DIR__) . "/state/IOrderStatusState.php");
class OrderStatusContext {
    private ?OrderStatusState $state;
 
    public function __construct(OrderStatusState $state = null) {
        $this->state = $state;
    }

    public function setState(OrderStatusState $state) {
        $this->state = $state;
    }

    public function getState(): OrderStatusState {
        return $this->state;
    }

    public function next() {
        $this->state->next($this);
    }

    public function cancel() {
        $this->state->cancel($this);
    }
}

?>