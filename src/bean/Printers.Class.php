<?php
/**
 * Description of Printers
 *
 * @author abilio.jose
 */
class Printers {
    
    private $id;
    private $printername;
    private $description;
    private $priceperpage;
    private $priceperjob;
    private $passthrough;
    private $maxjobsize; 
    
    function __construct() {
        $this->id = 0;
        $this->passthrough = false;
        $this->maxjobsize = 0;
    }
    
    function getId() : int {
        return (int) $this->id;
    }

    function getPrintername() : string {
        return (string) $this->printername;
    }

    function getDescription() : string {
        return (string) $this->description;
    }

    function getPriceperpage() : float {
        return (float) $this->priceperpage;
    }

    function getPriceperjob() : float {
        return (float) $this->priceperjob;
    }

    function getPassthrough() : bool {
        return (bool) $this->passthrough;
    }

    function getMaxjobsize() : int {
        return (int) $this->maxjobsize;
    }

    function setId(int $id) {
        $this->id = $id;
    }

    function setPrintername(string $printername) {
        $this->printername = $printername;
    }

    function setDescription(string $description) {
        $this->description = $description;
    }

    function setPriceperpage(float $priceperpage) {
        $this->priceperpage = $priceperpage;
    }

    function setPriceperjob(float $priceperjob) {
        $this->priceperjob = $priceperjob;
    }

    function setPassthrough(bool $passthrough) {
        $this->passthrough = $passthrough;
    }

    function setMaxjobsize(int $maxjobsize) {
        $this->maxjobsize = $maxjobsize;
    }

}
