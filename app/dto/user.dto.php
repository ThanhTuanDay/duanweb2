<!-- 
 ĐỐI TƯỢNGTƯỢNG 
-->
<?php 
class UserDto {
    private ?int $id;
    private ?string $name;
    private string $email;
    private ?string $phone;
    private ?string $address;
    private string $password;
    private ?string $role;
    private ?string $created_at;

    public function __construct(
        ?int $id=null,
       ?string $name=null,
        string $email,
        ?string $phone = null,
        ?string $address = null,
        string $password,
        ?string $role = null,
        ?string $created_at = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->password = $password; // Không hash mật khẩu
        $this->role = $role;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): int {
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

    // Setters
    public function setId(int $id): void {
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
}





?>