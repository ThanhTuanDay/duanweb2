<?php

class CategoryDto {
    private ?string $id;
    private ?string $name;
    private ?string $description;
    private ?string $created_at;

    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?string $description = null,
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): ?string {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    // Setters
    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }
}