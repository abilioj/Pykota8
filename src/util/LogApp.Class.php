<?php

/**
 * Description of logWSapp
 *
 * @author abilio.jose
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class LogApp {

    private Logger $objLog;
    private string $textTitulo;
    private bool $innfConn;
    private string $nameFile;
    private string $urlDir;

    public function __construct(string $pnameFile, ?string $ptextTitulo, ?string $purlDir) {
        $conn = new ConfigBDClass();
        $this->innfConn = false;
        $this->nameFile = $pnameFile === '' ? 'appMain' : $pnameFile;
        $this->textTitulo = $ptextTitulo !== null
            ? "DB://{$conn->getServidor()}:{$conn->getBancoDeDados()} - channel-{$ptextTitulo}"
            : "DB: {$conn->getServidor()}:{$conn->getBancoDeDados()} - channel-main";
        $this->urlDir = $purlDir ?? __DIR__;
        $this->objLog = new Logger($this->textTitulo);
        $this->objLog->pushHandler(new StreamHandler("{$this->urlDir}/{$this->nameFile}.log", Logger::DEBUG));
    }

    public function setInnfConn(bool $innfConn): void {
        $this->innfConn = $innfConn;
    }

    public function runInfo(string $pMsg): void {
        $this->objLog->info($pMsg);
    }

    public function runWarning(string $pMsg): void {
        $this->objLog->warning($pMsg);
    }

    public function runError(string $pMsg): void {
        $this->objLog->error($pMsg);
    }

    public function setUrlDir(string $urlDir): void {
        $this->urlDir = $urlDir;
    }
}
