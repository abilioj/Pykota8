<?php

class Usuario
{

    public function __construct(
        private int $id = 0,
        private string $nome = '',
        private string $login = '',
        private string $senha = '',
        private string $telefone = '',
        private string $email = '',
        private string $datacadastro = '',
        private string $dataalteracao = '',
        private string $dataultimologin = '',
        private string $foto = '',
        private int $nivel = 0,
        private int $status = 0,
        private int $tipo = 0,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDatacadastro(): string
    {
        return $this->datacadastro;
    }

    public function getDataalteracao(): string
    {
        return $this->dataalteracao;
    }

    public function getDataultimologin(): string
    {
        return $this->dataultimologin;
    }

    public function getFoto(): string
    {
        return $this->foto;
    }

    public function getNivel(): int
    {
        return $this->nivel;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setDatacadastro(string $datacadastro): void
    {
        $this->datacadastro = $datacadastro;
    }

    public function setDataalteracao(string $dataalteracao): void
    {
        $this->dataalteracao = $dataalteracao;
    }

    public function setDataultimologin(string $dataultimologin): void
    {
        $this->dataultimologin = $dataultimologin;
    }

    public function setFoto(string $foto): void
    {
        $this->foto = $foto;
    }

    public function setNivel(int $nivel): void
    {
        $this->nivel = $nivel;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setTipo(int $tipo): void
    {
        $this->tipo = $tipo;
    }

}

?>
