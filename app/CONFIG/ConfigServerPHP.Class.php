<?php

/**
 * Description of ConfigServerPHP
 *
 * @author Abílio José Gomes Ferreira
 */
class ConfigServerPHP {

    private $NameApp;
    private $NameSESSION;
    private $date_default_timezone_set;
    private $error_reporting;
    private $display_errors;
    private $log_errors;
    private $default_charset;
    private $oCpDP;

    function __construct() {
        $confiBD = new ConfigBDClass();
        $this->NameApp = "pykota";
        if ($confiBD->getOptDB() == 0):$this->NameSESSION = "App" . $this->NameApp . "DEV";
        endif;
        if ($confiBD->getOptDB() == 1):$this->NameSESSION = "App" . $this->NameApp . "";
        endif;
//        Valor padrão: E_ALL & ~ E_NOTICE & ~ E_STRICT & ~ E_DEPRECATED
//        Valor de desenvolvimento: E_ALL ou E_ALL & ~ E_NOTICE"
//        Valor da Produção: E_ALL & ~ E_DEPRECATED & ~ E_STRICT ou E_ALL & ~ E_NOTICE"
        $this->error_reporting = "E_ALL & ~ E_DEPRECATED & ~ E_STRICT";
//        $this->error_reporting = "E_ALL";
        $this->date_default_timezone_set = "America/Sao_Paulo";
        //Valor de desenvolvimento: 1 - On :: Valor de produção: 0 - Off
        $this->display_errors = (int) 0;
        $this->log_errors = (int) 0;
        $this->default_charset = "UTF-8";
        $this->oCpDP = 1; //desenvolvimento: 0 :: Valor de produção: 1
    }

    public function Date_timezone_set() {
        date_default_timezone_set($this->date_default_timezone_set);
    }

    public function Default_charset() {
        ini_set('default_charset', $this->default_charset);
    }

    public function Display_errors() {
        Ini_set('display_errors', $this->display_errors);
    }

    /* 
     * deprec
     */
    public function Error_Reporting() {
        error_reporting($this->error_reporting);
    }

    public function Error_ReportingLogin() {
        error_reporting("E_STRICT");
    }

    public function Head_ApplicationJson() {
        header("Content-Type: application/json");
    }

    public function Head_TextPlain() {
        header("Content-Type: " . "text/plain");
    }

    public function Head_Cache() {
        header("Pragma: no-cache");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-cache, cachehack=" . time());
        header("Cache-Control: no-store, must-revalidate");
        header("Cache-Control: post-check=-1, pre-check=-1", false);
    }

    public function Head_JSON() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: *");
    }

    public function HeadContent_type() {
        header('Content-type: text/html; charset=utf-8');
    }

    public function Log_errors() {
        ini_set('log_errors', $this->log_errors);
    }

    public function HeadSetLocale_Lang() {
        setlocale(LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
    }

    function getDate_default_timezone_set() {
        return $this->date_default_timezone_set;
    }

    public function getNameApp() {
        return $this->NameApp;
    }

    function getNameSESSION() {
        return $this->NameSESSION;
    }

    public function getOCpDP() {
        return $this->oCpDP;
    }

    public function setOCpDP($oCpDP): void {
        $this->oCpDP = $oCpDP;
    }
    
    public function setDate_default_timezone_set($date_default_timezone_set): void {
        $this->date_default_timezone_set = $date_default_timezone_set;
    }

    public function setError_reporting($error_reporting): void {
        $this->error_reporting = $error_reporting;
    }

    public function setDisplay_errors($display_errors): void {
        $this->display_errors = $display_errors;
    }

    public function setLog_errors($log_errors): void {
        $this->log_errors = $log_errors;
    }

    public function setDefault_charset($default_charset): void {
        $this->default_charset = $default_charset;
    }


}
