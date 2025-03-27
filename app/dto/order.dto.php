<?php

class OrderDto
{
    private ?string $id;
    private ?string $user_id;
    private ?float $total_price;
    private ?string $status;
    private ?string $store_id;
    private ?string $created_at;

    public function __construct(
        ?string $id = null,
        ?string $user_id = null,
        ?float $total_price = null,
        ?string $status = 'pending',
        ?string $store_id = null,
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->total_price = $total_price;
        $this->status = $status;
        $this->store_id = $store_id;
        $this->created_at = $created_at;
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
}
