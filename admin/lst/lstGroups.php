<?php
require '../../config.php';

//class
$dao = new DaoGroups();

//variavel de configuraçao
$page = "";
$nomeControle = "";
$NamePageview = "";
$tagTab = "";
$urlAppAdm = "../";
$urlApp = "../../";
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$dados = $dao->Listar();

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

use _lib\raelgc\view\Template;
$tpl = new Template("../view/lst/lstGroups.html");
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

/* config pra campos de Datas*/
//require './includes/ConfigToData.php';
$tpl->data = $dados;
$tpl->show();