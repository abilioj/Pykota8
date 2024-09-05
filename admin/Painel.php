<?php

//impressoraPainel

require '../config.php';
$url = "./";
$url_adm = "./";
$title = "";
$content = "";

$pege = Request::Do_GET("p", 0);

use _lib\raelgc\view\Template;

$tpl = new Template("./view/Painel.html");
$tpl->addFile("ModalVERPrinter", "./view/partsHTML/modal/ModalVERPrinter.html");

switch ($pege):
    case 0 :
        $title = "Status das Impressoras";
        $tpl->addFile("content", "./view/partsHTML/pPrinters.html");
        $tpl->addFile("scriptPF", "./view/Include/script_print.html");
        break;
    case 1 :
        $title = "Ramais";
        $tpl->addFile("content", "./view/partsHTML/pFone.html");
        $tpl->addFile("scriptPFn", "./view/Include/script_fone.html");
        break;
    case 2 :
        $title = "ips";
        $tpl->addFile("content", "./view/partsHTML/pIPS.html");
        $tpl->addFile("scriptPFips", "./view/Include/script_ips.html");
        break;
    default :
        $title = "";
        $tpl->addFile("content", "./view/partsHTML/OFNULL.html");
        break;
endswitch;

$tpl->title = "Painel - " . $title;
$tpl->url_adm = $url_adm;
$tpl->show();
