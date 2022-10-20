<?php

require '../config.php';

/* variavel com configurada Principais */
$page = "";
$nomeControle = "Home";
$NamePageview = "Home";
$tagTab = "";
$modalTab = "";
$urlAppAdm = "./";
$urlApp = "../";
$msgText = "";
$disabledPrinters = "";
$quotaOUbalance = (string) "_Balance";
$opQB = (int) 0;

/* sessao */
$link = $urlAppAdm;
//require '' . $urlAppAdm . 'includes/Validasesao.php';

/* variavel */
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$acao = Request::Do_GET('acao', null);

/* variavel Class */
$daoAG = new DaoArrayGeneric();
$daoTG = new DaoTabGeneric();

use _lib\raelgc\view\Template;

$tpl = new Template("./view/home.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
//require '' . $urlAppAdm . 'includes/ConfigHtml.php';
//require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

$quotaOUbalance = "Balance";

//valida s table Home
// parts/TABhome_Adm  || mOfNULL
//$modalTab = "ModalUpdateConta";
$modalTab = "ModalHome" . $quotaOUbalance;
//if ($USUlogado->getNivel() == 4 || $USUlogado->getNivel() == 5):
//    $tagTab = "_Adm";
//    $tpl->addFile("TABLE", "./view/partsHTML/parts/TABhome{$tagTab}.html");
//    $tpl->addFile("INFOCOTAHOME", "./view/partsHTML/parts/InfoCotaHome.html");
//elseif ($USUlogado->getNivel() == 3):
//    $tagTab = "";
//    $quotaOUbalance = "";
//    $disabledPrinters = "disabled";
//    $tpl->addFile("TABLE", "./view/partsHTML/parts/TABhome_Adm.html");
//else:
//    $tpl->addFile("TABLE", "./view/partsHTML/parts/OfNULL.html");
//endif;
//$tpl->addFile("PARTSFORMHOME", "./view/partsHTML/parts/partsFormHOME{$tagTab}{$quotaOUbalance}.html");
//$tpl->addFile("ModalHome", "./view/partsHTML/modal/{$modalTab}.html");

/* config pra campos de Datas */
//require './includes/ConfigToData.php';
//$tpl->disabled = $disabledPrinters;
//$tpl->quotaOUbalance = "_".$quotaOUbalance;
//$tpl->tagTab = $tagTab;
$tpl->show();
