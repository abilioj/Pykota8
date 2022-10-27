<?php

class ConfigBDClass {

    public function __construct(
        private string $hostserver='10.1.1.223',
        private string $database='pykota',
        private string $user='postgres',
        private string $password='juaozinho',
        private string $port='5432',
        private string $charset='utf8',
        private string $prefixoBD='',
        private string $drivers='pgsql',
        private string $dsn='',
        private mixed $options=null,
        private int $optDB=1,
    ) {
        $this->dsn = "" . $drivers . ":host=" . $hostserver . ";port=" . $port . ";dbname=" . $database . ""; //;user=" . $user . ";password=" . $password . "
        $this->options = array(PDO::ATTR_PERSISTENT => true);
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getUser() {
        return $this->user;
    }

    public function getHostServer() {
        return $this->hostserver;
    }

    public function getpassword() {
        return $this->password;
    }

    public function getPort() {
        return $this->port;
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

    public function getOptDB() : int {
        return $this->optDB;
    }

}
