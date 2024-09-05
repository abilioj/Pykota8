<?php

require '../../config.php';
//-NivelUsuario
//variavel de configuraçao
$page = "";
$nomeControle = "NivelUsuario";
$NamePageview = "Nivel de Usuário";
$urlAppAdm = "../";
$urlApp = "../../";

/* class */
$array = new DadosArray();
$obj = null;
$Dao = new DaoNivelUsuario();

//variaveis
$disabled = '';
$op = Request::Do_GET("op", 0);
$id = Request::Do_GET("id", 0);
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$arraySel = $array->ArrayFlag();

$page = $PHTML->OPNamePage($op, $NamePageview, "f");
$disabled = $PHTML->getImputDisabled();

if ($id > 0):
    $objnew = new NivelUsuario($id,null);
    $obj = $Dao->selecionar($objnew);
else:
    $obj = new NivelUsuario(0, '');
endif;

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

use _lib\raelgc\view\Template;
$tpl = new Template("../view/frm/frmNivelUsuario.html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
$tpl->addFile("BTN_FORNFULL", "../view/partsHTML/btn/BTN_FORNFULL.html");

$tpl->block("" . $PHTML->getBlock() . "");
$tpl->clear("" . $PHTML->getClear() . "");

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

$tpl->N = $obj;
$tpl->disabled = $disabled;
$tpl->page = $page;
$tpl->nomeControle = $nomeControle;
$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;
$tpl->show();
