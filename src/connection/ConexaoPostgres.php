<?php

/**
 * Description of ConexaoPostgres
 *
 * @author abilio.jose
 */
class ConexaoPostgres {

    private $conn;
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $port;
    private $stringDSN;
    private $host_info;
    private $result;
    private $toerror;
    private $msgErro;
    private $msgInfo;
    private $numrows;
    private $autocommit;
    private $db_row_autocommit;
    private $beginTransaction;
    private $isOk;
    private $string;
    public $sql;
    
    function __construct() {        
    }

}
