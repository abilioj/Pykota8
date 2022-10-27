<?php

/**
 * Description of Login
 *
 * @author abilio.jose
 */
class Login {
    
    private $id;
    private $login;
    private $senha;
    private $email;
    private $cpf;
    private $nivel;
    private $pkgroup;
    private $status;
    
    function __construct() {        
    }

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getPkgroup() {
        return $this->pkgroup;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setPkgroup($pkgroup) {
        $this->pkgroup = $pkgroup;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
