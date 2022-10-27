<?php
/**
 * Description of Payments
 *
 * @author abilio.jose
 */
class Payments {
    
    private $id;
    private $userid;
    private $amount;
    private $description;
    private $date;
    
    function __construct() {        
    }

    function getId() {
        return $this->id;
    }

    function getUserid() {
        return $this->userid;
    }

    function getAmount() {
        return $this->amount;
    }

    function getDescription() {
        return $this->description;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDate($date) {
        $this->date = $date;
    }

}
