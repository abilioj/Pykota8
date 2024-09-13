<?php

/**
 * Description of logWSapp
 *
 * @author abilio.jose
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class logWSapp {

    private $objLog;
    private $textTitulo;
    private $innfConn;
    private $urlDir;

    function __construct($ptextTitulo, $purlDir) {
        $conn = new ConfigBDClass();
        $this->innfConn = false;
        $this->textTitulo = ($ptextTitulo == null) ? 
                "DB: " . $conn->getServidor() . ":" . $conn->getBancoDeDados() . " - channel-main"
                :
                "DB://" . $conn->getServidor() . ":"  . $conn->getBancoDeDados() . " - channel-" . $ptextTitulo;
        $this->urlDir = ($purlDir == null || $purlDir == "") ? $this->urlDir = "" . __DIR__ . "" : $this->urlDir = $purlDir;
        $this->objLog = new Logger($this->textTitulo);
        $this->objLog->pushHandler(new StreamHandler($this->urlDir . '/app.log', Logger::DEBUG));
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

    public function setUrlDir(string $urlDir): void {
        $this->urlDir = $urlDir;
    }
}
