<?php
/**
 * Description of Users
 *
 * @author abilio.jose
 */
class Users {
    
    public function __construct(
        private int $id = 0,
        private string $username = '',
        private string $email = '',
        private float $balance = 0.0,
        private float $lifetimepaid = 0.0,
        private int $limitby = 0,
        private string $description = '',
        private float $overcharge = 0.0,
        private int $limitmonth = 0,
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function getLifetimepaid(): float {
        return $this->lifetimepaid;
    }

    public function getLimitby(): int {
        return $this->limitby;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getOvercharge(): float {
        return $this->overcharge;
    }

    public function getLimitmonth(): int {
        return $this->limitmonth;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setBalance(float $balance): void {
        $this->balance = $balance;
    }

    public function setLifetimepaid(float $lifetimepaid): void {
        $this->lifetimepaid = $lifetimepaid;
    }

    public function setLimitby(int|string $limitby): void {
        $this->limitby = (int)$limitby;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setOvercharge(float $overcharge): void {
        $this->overcharge = $overcharge;
    }

    public function setLimitmonth(int $limitmonth): void {
        $this->limitmonth = $limitmonth;
    }

}

