<?php

class OrderItemDto
{
    private ?string $id;
    private ?string $order_id;
    private ?string $product_id;
    private ?int $quantity;
    private ?float $price;

    public function __construct(
        ?string $id = null,
        ?string $order_id = null,
        ?string $product_id = null,
        ?int $quantity = null,
        ?float $price = null
    ) {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    // Getters
    public function getId(): ?string
    {
        return $this->id;
    }
    public function getOrderId(): ?string
    {
        return $this->order_id;
    }
    public function getProductId(): ?string
    {
        return $this->product_id;
    }
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    public function getPrice(): ?float
    {
        return $this->price;
    }

    // Setters
    public function setId(string $id): void
    {
        $this->id = $id;
    }
    public function setOrderId(string $order_id): void
    {
        $this->order_id = $order_id;
    }
    public function setProductId(string $product_id): void
    {
        $this->product_id = $product_id;
    }
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
