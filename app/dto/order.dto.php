<?php
require("order-item.dto.php");
class OrderDto
{
    private ?string $id;
    private ?string $user_id;
    private ?float $total_price;
    private ?string $status;
    private ?string $store_id;
    private ?string $created_at;
    private ?string $deliveryAddressId;
    private ?string $deliveryAddress;
    private array $orderItems;
    public function __construct(
        ?string $id = null,
        ?string $user_id = null,
        ?float $total_price = null,
        ?string $status = 'pending',
        ?string $store_id = null,
        ?string $created_at = null,
        ?string $deliveryAddressId = null,
        ?array $orderItems = null,
        ?string $deliveryAddress = null
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->total_price = $total_price;
        $this->status = $status;
        $this->store_id = $store_id;
        $this->created_at = $created_at;
        $this->deliveryAddressId = $deliveryAddressId; 
        $this->orderItems = $orderItems ?? [] ;
        $this->deliveryAddress = $deliveryAddress;
    }

    // Getters
    public function getId(): ?string
    {
        return $this->id;
    }
    public function getUserId(): ?string
    {
        return $this->user_id;
    }
    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function getStoreId(): ?string
    {
        return $this->store_id;
    }
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getDeliveryAddressId(): ?string
    {
        return $this->deliveryAddressId;
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    // Setters
    public function setId(string $id): void
    {
        $this->id = $id;
    }
    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function setTotalPrice(float $total_price): void
    {
        $this->total_price = $total_price;
    }
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    public function setStoreId(string $store_id): void
    {
        $this->store_id = $store_id;
    }
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
    public function setDeliveryAddressId(string $deliveryAddressId): void
    {
        $this->deliveryAddressId = $deliveryAddressId;
    }

    public function setOrderItems(array $orderItems): void
    {
        $this->orderItems = $orderItems;
    }
    public function setDeliveryAddress(string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }
}
