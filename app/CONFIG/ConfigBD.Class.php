<?php

/**
 * Description of ConfigBDClass
 * Cofigurar as configurações de conexão co o banco de dados
 * @author abilio.jose
 * @version 0.1 
 * @copyright  GPL © 2022, HEANA. 
 * @access public  
 * @package app/Rules
 */
class ConfigBDClass {

    function __construct(
            private string $bancoDeDados = '',
            private string $usuario = '',
            private string $servidor = '',
            private string $senha = '',
            private string $porta = '',
            private string $charset = '',
            private string $prefixoBD = '',
            private string $drivers = '',
            private string $dsn = '',
            private mixed $options = null,
            private string $optDB = '') {
        $this->prefixoBD = "";
        $this->charset = "utf8";
        $this->drivers = "pgsql"; // drivers - "mysql"  "pgsql" "sqlite" "sqlsrv"
        $this->optDB = 0; //desenvolvimento: 0 :: Valor de produção: 1
//    ------------------usado para testes local------------------
        if ($this->optDB == 0):
            $this->prefixoBD = "app_";
            $this->servidor = "localhost";
            $this->bancoDeDados = $this->prefixoBD . "pykota";
            $this->usuario = "postgres";
            $this->senha = "123123";
            $this->porta = "5432";
        endif;
//  ------------------ usado POSTGRE para PRODUÇAO------------------
        if ($this->optDB == 1):
            $this->prefixoBD = "PP";
            $this->servidor = "";
            $this->bancoDeDados = $this->prefixoBD . "";
            $this->usuario = "";
            $this->senha = "";
            $this->porta = "5432";
        endif;
//  -----------------------------------------------------------------
        $this->dsn = "" . $this->drivers . ":host=" . $this->servidor . ";port=" . $this->porta . ";dbname=" . $this->bancoDeDados . "";
        $this->options = array(PDO::ATTR_PERSISTENT => true);
    }

    public function getBancoDeDados() {
        return $this->bancoDeDados;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getServidor() {
        return $this->servidor;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getPorta() {
        return $this->porta;
    }

    public function getPrefixoBD() {
        return $this->prefixoBD;
    }

    public function getDrivers() {
        return $this->drivers;
    }

    public function getDsn() {
        return $this->dsn;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getOptDB() {
        return $this->optDB;
    }

    public function setBancoDeDados(string $parambancoDeDados) {
        $this->bancoDeDados = $parambancoDeDados;
    }

    public function setOptions(mixed $options) {
        $this->options = $options;
    }

    public function setOptDB($optDB) {
        $this->optDB = $optDB;
    }

}
