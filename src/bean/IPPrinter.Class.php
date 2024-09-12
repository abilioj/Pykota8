<?php

/**
 * Description of IPPrinter
 *
 * @author abilio.jose
 */
class IPPrinter {
    
    public function __construct(
        public int $id_printer,
        public string $ip,
        public string $nome = '',
        public int $tipo = 1,
    ) {}

    public function getId_printer(): int {
        return $this->id_printer;
    }

    public function getIp(): string {
        return $this->ip;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getTipo(): int {
        return $this->tipo;
    }

    public function setId_printer(int $id_printer): void {
        $this->id_printer = $id_printer;
    }

    public function setIp(string $ip): void {
        $this->ip = $ip;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setTipo(int $tipo): void {
        $this->tipo = $tipo;
    }

}
