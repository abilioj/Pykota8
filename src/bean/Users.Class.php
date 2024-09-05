<?php
/**
 * Description of Users
 *
 * @author abilio.jose
 */
class Users {
    
    private $id;
    private $username;
    private $email;
    private $balance;
    private $lifetimepaid;
    private $limitby;
    private $description;
    private $overcharge;
    private $limitmonth;

    function __construct() {        
    }
   
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getLifetimepaid() {
        return $this->lifetimepaid;
    }

    public function getLimitby() {
        return $this->limitby;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getOvercharge() {
        return $this->overcharge;
    }

    public function getLimitmonth() {
        return $this->limitmonth;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setBalance($balance): void {
        $this->balance = $balance;
    }

    public function setLifetimepaid($lifetimepaid): void {
        $this->lifetimepaid = $lifetimepaid;
    }

    public function setLimitby($limitby): void {
        $this->limitby = $limitby;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setOvercharge($overcharge): void {
        $this->overcharge = $overcharge;
    }

    public function setLimitmonth($limitmonth): void {
        $this->limitmonth = $limitmonth;
    }

}
