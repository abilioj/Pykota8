<?php

/**
 * Description of Inf_Settings
 *
 * @author Abílio
 */
class GetInfoSettings {

    private $IdBrowser;
    private $BrowserID;
    private $BrowserName;
    private $BrowserVersion;
    private $ArrayBrowser;
    private $Ip;
    private $SO;
    private $INFString;

    function __construct() {
        
    }

    public function GETNavegadorSO() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->Ip = $ip;

        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform ?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
        }

        $bname = "Não Identificado";
        $this->BrowserID = 0;

        // Em seguida, obter o nome do useragent sim separadamente e por boas razões
        if (preg_match('/MSIE/i', $u_agent)) {// && !preg_match('/Opera/i', $u_agent)
            $bname = "MSIE";
            $this->BrowserID = 1;
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = "Firefox";
            $this->BrowserID = 2;
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = "Chrome";
            $this->BrowserID = 6;
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = "Safari";
            $this->BrowserID = 5;
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = "Opera";
            $this->BrowserID = 3;
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = "Netscape";
            $this->BrowserID = 7;
        }

        // Finalmente obter o número de versão correta
        $known = array('Version', $bname, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // Não temos número correspondente apenas continue
        }

        // Ver quantos temos
        $i = count($matches['browser']);
        if ($i != 1) {
            //Teremos dois, já que não estamos usando o argumento "outro" ainda
            //Verifique se a versão é antes ou depois do nome
            if (strripos($u_agent, "Version") < strripos($u_agent, $bname)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // Verifique se temos um número
        if ($version == null || $version == "") {
            $version = "?";
        }

        if ($ip == "::1")
            $ip = "127.0.0.1";

        $Browser = array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern,
            'ip' => $ip
        );

        $this->BrowserName = $Browser['name'];
        $this->BrowserVersion = $Browser['version'];
        $this->SO = $Browser['platform'];
        $this->ArrayBrowser = $Browser;

        $navegador = "Navegador: " . $Browser['name'] . " " . $Browser['version'];
        $so = $Browser['platform'];

        /* Para finalizar coloquei aqui o meu insert para salvar na base de dados... Não fiz nada para mostrar em tela, pois só uso para fins de log do sistema  */
        $this->INFString = "Seu Server: '" . $ip . "'<br/>" . $navegador . "<br/> " . "SO: " . $so;
        return;
    }

    public function GETNavegador() {

        $this->BrowserID = 0;
        $this->BrowserName = "Não Identificado";

        $MSIE = strpos($_SERVER['HTTP_USER_AGENT'], "MSIE");
        $Firefox = strpos($_SERVER['HTTP_USER_AGENT'], "Firefox");
        $Mozilla = strpos($_SERVER['HTTP_USER_AGENT'], "Mozilla");
        $Chrome = strpos($_SERVER['HTTP_USER_AGENT'], "Chrome");
        $Chromium = strpos($_SERVER['HTTP_USER_AGENT'], "Chromium");
        $Safari = strpos($_SERVER['HTTP_USER_AGENT'], "Safari");
        $Opera = strpos($_SERVER['HTTP_USER_AGENT'], "Opera");
        $Netscape = strpos($_SERVER['HTTP_USER_AGENT'], "Netscape");

        if ($MSIE == true) {
            $this->BrowserName = "IE";
            $this->BrowserID = 1;
        } if ($Firefox == true) {
            $this->BrowserName = "Firefox";
            $this->BrowserID = 2;
        } if ($Opera == true) {
            $this->BrowserName = "Opera";
            $this->BrowserID = 3;
        } if ($Chromium == true) {
            $this->BrowserName = "Chromium";
            $this->BrowserID = 4;
        } if ($Safari == true) {
            $this->BrowserName = "Safari";
            $this->BrowserID = 5;
        } if ($Chrome == true) {
            $this->BrowserName = "Chrome";
            $this->BrowserID = 6;
        } if ($Netscape == true) {
            $this->BrowserName = "Netscape";
            $this->BrowserID = 7;
        }
        return;
    }

//    public function GetNavegadorNew() {
//    }[

    function getIdBrowser() {
        return $this->IdBrowser;
    }

    function getBrowserID() {
        return $this->BrowserID;
    }

    function getBrowserName() {
        return $this->BrowserName;
    }

    function getBrowserVersion() {
        return $this->BrowserVersion;
    }

    function getArrayBrowser() {
        return $this->ArrayBrowser;
    }

    function getIp() {
        return $this->Ip;
    }

    function getSO() {
        return $this->SO;
    }

    function getINFString() {
        return $this->INFString;
    }

}
