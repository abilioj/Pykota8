<?php

/**
 * Description of Billingcodes
 *
 * @author abilio.jose
 */
class Billingcodes {
        
    function __construct(
        private int $id,
        private string $billingcode,
        private string $description,
        private float $balance,
        private int $pagecounter) {        
    }

    function getId(): int {
        return $this->id;
    }

    function getBillingcode(): string {
        return $this->billingcode;
    }

    function getDescription(): string {
        return $this->description;
    }

    function getBalance(): float {
        return $this->balance;
    }

    function getPagecounter(): int {
        return $this->pagecounter;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setBillingcode(string $billingcode): void {
        $this->billingcode = $billingcode;
    }

    function setDescription(string $description): void {
        $this->description = $description;
    }

    function setBalance(float $balance): void {
        $this->balance = $balance;
    }

    function setPagecounter(int $pagecounter): void {
        $this->pagecounter = $pagecounter;
    }

}
