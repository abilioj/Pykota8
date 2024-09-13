<?php

//Install_Printers
require '../../config.php';

//class
$conn = new Conexao();
$sqlR = new SqlRules();

//variavel de configuraçao
$page = "";
$nomeControle = "";
$NamePageview = "";
$tagTab = "";
$urlAppAdm = "../";
$urlApp = "../../";
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$arrayDados = null;
$dados = null; //$dao->Listar();

$conn->sql = $sqlR->sqlSelectPrinters();
$arrayDados = $conn->fetchArrayAssoc();


/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

use _lib\raelgc\view\Template;

$tpl = new Template("../view/page/Install_Printers.html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

foreach ($arrayDados as $r):
    $tpl->printername = $r["printername"]; 
    $tpl->LinkIpPrinters = "http://10.1.1.223:631/printers/".$r["printername"];
    $tpl->block("BLOCK_LISTAS");
endforeach;


/* config pra campos de Datas */
//require './includes/ConfigToData.php';
//$tpl->data = $dados;
$tpl->show();
