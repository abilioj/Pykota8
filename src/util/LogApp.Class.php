<?php

/**
 * Description of logWSapp
 *
 * @author abilio.jose
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class logApp {

    private $objLog;
    private $textTitulo;
    private $innfConn;
    private $nameFile;

    function __construct($pnameFile, $ptextTitulo, $purlDir) {
        $conn = new ConfigBDClass();
        $this->innfConn = false;
        $this->nameFile = ($pnameFile == null || $pnameFile == '')? 'appMain' : $pnameFile;
        $this->textTitulo = ($ptextTitulo == null) ? 
                "DB: " . $conn->getServidor() . ":" . $conn->getBancoDeDados() . " - channel-main"
                :
                "DB://" . $conn->getServidor() . ":"  . $conn->getBancoDeDados() . " - channel-" . $ptextTitulo;
        $this->urlDir = ($purlDir == null || $purlDir == "") ? $this->urlDir = "" . __DIR__ . "" : $this->urlDir = $purlDir;
        $this->objLog = new Logger($this->textTitulo);
        $this->objLog->pushHandler(new StreamHandler($this->urlDir . '/'+$this->nameFile+'.log', Logger::DEBUG));
    }

    public function setInnfConn($innfConn) {
        $this->innfConn = $innfConn;
    }

    public function runInfo($pMsg) {
        $this->objLog->info($pMsg);
    }

    public function runWarning($pMsg) {
        $this->objLog->warning($pMsg);
    }

    public function runError($pMsg) {
        $this->objLog->error($pMsg);
    }

}
