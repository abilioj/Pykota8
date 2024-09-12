<?php
/**
 * Description of Coefficients 
 *
 * @author abilio.jose
 */
class Coefficients {
    
    public function __construct(
        private int $id,
        private int $printerid,
        private string $label,
        private float $coefficient,
    ) {
        $this->id = $id;
        $this->printerid = $printerid;
        $this->label = $label;
        $this->coefficient = $coefficient;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getPrinterid(): int {
        return $this->printerid;
    }

    public function setPrinterid(int $printerid): void {
        $this->printerid = $printerid;
    }

    public function getLabel(): string {
        return $this->label;
    }

    public function setLabel(string $label): void {
        $this->label = $label;
    }

    public function getCoefficient(): float {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): void {
        $this->coefficient = $coefficient;
    }
}
