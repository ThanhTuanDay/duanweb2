<?php

class CategoryDto {
    private ?string $id;
    private ?string $name;
    private ?string $description;
    private ?string $created_at;
    private ?string $images_url;
    private ?string $status;

    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?string $description = null,
        ?string $created_at = null,
        ?string $images_url=null,
        ?string $status = null,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at;
        $this->images_url = $images_url;
        $this->status=$status;
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

    public function getImage(): ?string
    {
        return $this->images_url;
    }
    public function getStatus(): ?string
    {
        return $this->status;
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
    public function setImage(string $images_url): void{
        $this->images_url= $images_url;
    }
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'images_url'=>$this->images_url,
            
        ];
    }

}