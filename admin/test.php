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

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

/* variavel */
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$acao = Request::Do_GET('acao', null);

/* variavel Class */
$daoAG = new DaoArrayGeneric();
$daoTG = new DaoTabGeneric();

use _lib\raelgc\view\Template;

$tpl = new Template("./view/homeTest.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

$tpl->show();
