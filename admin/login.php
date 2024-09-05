<?php
ini_set('default_charset', 'UTF-8');
error_reporting(E_STRICT);
session_start();
require_once("../config.php");

//variavel Principal
$msgText = "";
$msg = Request::Do_GET("msg", 0);
$op = Request::Do_GET("op", 0);

//Aviso / Informação
$msgObj = new Menssagem();
$msgText = $msgObj->MenssagemToPAGELogin($msg);
//$usuid = $_SESSION['idusu' . $Service->getNameSESSION() . ''];
//if ($usuid != null):
//   header("location: ./index.php");
//endif;
use _lib\raelgc\view\Template;
$tpl = new Template("view/login.html");
if ($op == 0) {
    $tpl->block("BLOCK_L");
} else {
    $tpl->clear("BLOCK_L");
}
if ($op != 0) {
    $tpl->block("BLOCK_RS");
} else {
    $tpl->clear("BLOCK_RS");
}
$tpl->msg = $msgText;
$tpl->INFO_APP = "" . $Service->getNameSESSION()
        . "<br/> Navegador: " . $ServiceGET->getBrowserName()
        . " " . $ServiceGET->getBrowserVersion() . " "
        . " so: " . $ServiceGET->getSO();
$tpl->show();