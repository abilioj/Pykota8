<?php

/**
 * Description of Billingcodes
 *
 * @author abilio.jose
 */
class Billingcodes {
    
    private $id;
    private $billingcode;
    private $description;
    private $balance;
    private $pagecounter;
    
    function __construct() {        
    }

    function getId() {
        return $this->id;
    }

    function getBillingcode() {
        return $this->billingcode;
    }

    function getDescription() {
        return $this->description;
    }

    function getBalance() {
        return $this->balance;
    }

    function getPagecounter() {
        return $this->pagecounter;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBillingcode($billingcode) {
        $this->billingcode = $billingcode;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setBalance($balance) {
        $this->balance = $balance;
    }

    function setPagecounter($pagecounter) {
        $this->pagecounter = $pagecounter;
    }

}
