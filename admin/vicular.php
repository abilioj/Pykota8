<?php

require '../config.php';

//variavel com configurada Principais
$page = "";
$nomeControle = "Controle";
$NamePageview = "";
$urlAppAdm = "./";
$urlApp = "../";
$msgText = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//variavel 
$msg = Request::Do_GET("msg", 0);
$acao = Request::Do_GET('acao', null);
$Dados = null;

//variavel Class
$daoAG = new DaoArrayGeneric();
$daoTG = new DaoTabGeneric();
$daoUE = new DaoUsuario_Interno();

$msgText = $MSGobg->MenssagemToPAGE($msg);
$Dados = $daoUE->ListarDeUsuariosViculado();

use _lib\raelgc\view\Template;
$tpl = new Template("./view/page/frmVicularUser.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");
$tpl->addFile("ModalVicularUser", "./view/partsHTML/modal/ModalVicularUser.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

/* config pra campos de Datas*/
//require './includes/ConfigToData.php';
$tpl->msg = $msgText;
$tpl->nomeControle = $nomeControle;
$tpl->dados = $Dados;
$tpl->show();