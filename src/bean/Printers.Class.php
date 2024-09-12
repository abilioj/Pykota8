<?php
/**
 * Description of Printers
 *
 * @author abilio.jose
 */
class Printers {

    public function __construct(
        private int $id = 0,
        private string $printername = '',
        private string $description = '',
        private float $priceperpage = 0.0,
        private float $priceperjob = 0.0,
        private bool $passthrough = false,
        private int $maxjobsize = 0,
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getPrintername(): string {
        return $this->printername;
    }

    public function setPrintername(string $printername): void {
        $this->printername = $printername;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getPriceperpage(): float {
        return $this->priceperpage;
    }

    public function setPriceperpage(float $priceperpage): void {
        $this->priceperpage = $priceperpage;
    }

    public function getPriceperjob(): float {
        return $this->priceperjob;
    }

    public function setPriceperjob(float $priceperjob): void {
        $this->priceperjob = $priceperjob;
    }

    public function getPassthrough(): bool {
        return $this->passthrough;
    }

    public function setPassthrough(bool $passthrough): void {
        $this->passthrough = $passthrough;
    }

    public function getMaxjobsize(): int {
        return $this->maxjobsize;
    }

    public function setMaxjobsize(int $maxjobsize): void {
        $this->maxjobsize = $maxjobsize;
    }
}

