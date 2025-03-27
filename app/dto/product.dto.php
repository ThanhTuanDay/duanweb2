<?php

class ProductDto
{
    private ?string $id;
    private ?string $name;
    private ?string $description;
    private ?float $price;
    private ?string $category_id;
    private ?string $image_url;
    private ?string $store_id;
    private ?int $stock;
    private ?string $created_at;

    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?string $description = null,
        ?float $price = null,
        ?string $category_id = null,
        ?string $image_url = null,
        ?int $stock = null,
        ?string $store_id = null,
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->image_url = $image_url;
        $this->stock = $stock;
        $this->store_id = $store_id;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getCategoryId(): ?string
    {
        return $this->category_id;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function getStock(): ?int
    {
        return $this->stock;
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setCategoryId(string $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
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
