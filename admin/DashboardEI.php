<?php

//DashboardEI
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

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

/* variavel */
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$acao = Request::Do_GET('acao', null);

/* variavel Class */
$daoAG = new DaoArrayGeneric();
$daoTG = new DaoTabGeneric();
$dadosArray = new DadosArray();

use _lib\raelgc\view\Template;

$tpl = new Template("./view/DashboardEI.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT_CHAR", "./view/Include/script_char.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");
//partsFormDashboard
$tpl->addFile("PARTSFORMDASHBOARD", "./view/partsHTML/parts/partsFormDashboardEI.html");


$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

//array
$ArrayUser = $daoAG->Array_Responsavel();
$arrayDadosData = $dadosArray->ArrayAnos(2015);
//krsort($arrayDadosData);

foreach ($arrayDadosData as $n) {//
    $tpl->IDd = $n["id"];
    $tpl->VALUEd = $n["value"];
    $tpl->block("BLOCK_ANO");
}

$tpl->show();
