<?php

/**
 * Description of IPPrinter
 *
 * @author abilio.jose
 */
class IPPrinter {
    
    private $id_printer;
    private $ip;
    private $nome;//nao a no banco
    private $tipo;
    
    public function __construct($id_printer, $ip) {
        $this->id_printer = $id_printer;
        $this->ip = $ip;
        $this->tipo = 1;
    }

    public function getId_printer() {
        return $this->id_printer;
    }

    public function getIp() {
        return $this->ip;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId_printer($id_printer): void {
        $this->id_printer = $id_printer;
    }

    public function setIp($ip): void {
        $this->ip = $ip;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

}
