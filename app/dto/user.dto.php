
<?php 
class UserDto {
    private ?string $id;
    private ?string $name;
    private ?string $email;
    private ?string $phone;
    private ?string $address;
    private ?string $password;
    private ?string $role;
    private ?string $created_at;

    private ?string $verifyToken;

    private ?int $isVerified;

    public function __construct(
        ?string $id=null,
       ?string $name=null,
        ?string $email=null,
        ?string $phone = null,
        ?string $address = null,
        ?string $password=null,
        ?string $role = null,
        ?string $created_at = null,
        ?string $verifyToken = null,
        ?bool $isVerified = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->password = $password; // Không hash mật khẩu
        $this->role = $role;
        $this->created_at = $created_at;
        $this->verifyToken = $verifyToken;
        $this->isVerified  = $isVerified ?? 0;
    }

    // Getters
    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function getRole(): ?string {
        return $this->role;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }
    public function getPassword():?string {
        return $this->password;
    }

    public function getVerifyToken(): ?string {
        return $this->verifyToken;
    }

    public function isVerified(): bool {
        return $this->isVerified;
    }

    // Setters
    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPhone(?string $phone): void {
        $this->phone = $phone;
    }

    public function setAddress(?string $address): void {
        $this->address = $address;
    }

    public function setRole(?string $role): void {
        $this->role = $role;
    }

    public function setCreatedAt(?string $created_at): void {
        $this->created_at = $created_at;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setVerifyToken(?string $verify_token): void {
        $this->verifyToken = $verify_token;
    }

    public function setIsVerified(bool $is_verified): void {
        $this->isVerified = $is_verified;
    }
}





?>