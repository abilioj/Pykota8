<?php

require '../../config.php';

//variavel de configuraçao
$page = "";
$nomeContView = "Printers";
$NamePageview = "Impressora";
$urlAppAdm = "../";
$urlApp = "../../";

/* class */
$array = new DadosArray();
$objP = new Printers();
$DaoP = new DaoPrinters();
$DaoIp = new DaoIPPrinter();

//variaveis
$disabled = '';
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$op = Request::Do_GET("op", 0);
$id = Request::Do_GET("id", 0);
$ip = '0.0.0.0';
$arraySel = $array->ArrayFlag();

$page = $PHTML->OPNamePage($op, $NamePageview, "f");
$disabled = $PHTML->getImputDisabled();

if ($id > 0):
    $objPnew = new Printers();
    $objPnew->setId($id);
    $objP = $DaoP->selecionar($objPnew);
    $ip = $DaoIp->getIpPorIdPrintrer($id);
else:
    $objP = new Printers();
    $objP->setId(0);
endif;

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

use _lib\raelgc\view\Template;
$tpl = new Template("../view/frm/frm" . $nomeContView . ".html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");

//Botões
$tpl->addFile("BTN_FORNFULL", "../view/partsHTML/btn/BTN_FORNFULL.html");
$tpl->block("" . $PHTML->getBlock() . "");
$tpl->clear("" . $PHTML->getClear() . "");

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

$tpl->ip = $ip;
$tpl->P = $objP;
$tpl->disabled = $disabled;
$tpl->page = $page;
$tpl->nomeControle = $nomeContView;
$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;
$tpl->show();
