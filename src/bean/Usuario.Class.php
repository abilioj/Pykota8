<?php

class Usuario {

    private $id;
    private $nome;
    private $login;
    private $senha;
    private $telefone;
    private $email;
    private $datacadastro;
    private $dataalteracao;
    private $dataultimologin;
    private $foto;
    private $nivel;
    private $status;
    private $tipo;
    
    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getDatacadastro() {
        return $this->datacadastro;
    }

    function getDataalteracao() {
        return $this->dataalteracao;
    }

    function getDataultimologin() {
        return $this->dataultimologin;
    }

    function getFoto() {
        return $this->foto;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getStatus() {
        return $this->status;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDatacadastro($datacadastro) {
        $this->datacadastro = $datacadastro;
    }

    function setDataalteracao($dataalteracao) {
        $this->dataalteracao = $dataalteracao;
    }

    function setDataultimologin($dataultimologin) {
        $this->dataultimologin = $dataultimologin;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }


}

?>
