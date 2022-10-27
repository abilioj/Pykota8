<?php
/**
 * Description of ADUser
 *
 * @author Abílio José
 */
class ADUser {
    
    private $fullName;
    private $name;
    private $lastName;
    private $initials;
    private $nameAuth;
    private $groups;
    private $mail;
    private $tel;
    
    public function __construct() {        
    }
    
    public function getFullName() {
        return $this->fullName;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getInitials() {
        return $this->initials;
    }

    public function getNameAuth() {
        return $this->nameAuth;
    }

    public function getGroups() {
        return $this->groups;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setInitials($initials) {
        $this->initials = $initials;
    }

    public function setNameAuth($nameAuth) {
        $this->nameAuth = $nameAuth;
    }

    public function setGroups($groups) {
        $this->groups = $groups;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }


}
