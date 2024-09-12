<?php

/**
 * Description of Login
 *
 * @author abilio.jose
 */
class Login {
    
    public function __construct(
        private int $id,
        private string $login,
        private string $senha,
        private string $email,
        private int $cpf,
        private int $nivel,
        private int $pkgroup,
        private int $status,
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getSenha(): string {
        return $this->senha;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getCpf(): int {
        return $this->cpf;
    }

    public function getNivel(): int {
        return $this->nivel;
    }

    public function getPkgroup(): int {
        return $this->pkgroup;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setLogin(string $login): void {
        $this->login = $login;
    }

    public function setSenha(string $senha): void {
        $this->senha = $senha;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setCpf(int $cpf): void {
        $this->cpf = $cpf;
    }

    public function setNivel(int $nivel): void {
        $this->nivel = $nivel;
    }

    public function setPkgroup(int $pkgroup): void {
        $this->pkgroup = $pkgroup;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }
}
