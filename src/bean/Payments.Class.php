<?php
/**
 * Description of Payments
 *
 * @author abilio.jose
 */
class Payments {
    
    public function __construct(
        private int $id = 0,
        private int $userid = 0,
        private float $amount = 0.0,
        private string $description = '',
        private DateTime $date = new DateTime()
    ) {
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUserid(): int {
        return $this->userid;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUserid(int $userid): void {
        $this->userid = $userid;
    }

    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }
}

