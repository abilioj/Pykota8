<?php

//FRMPADEDEFAULT or frm/frmUsuario -- script_FrmUsuarios
require_once("../../config.php");

//class
$MSGobg = new Menssagem();

//class a ser utilizardas
$dao = new DaoUsuario();
$daoUI = new DaoUsuario_Interno();

//variavel com configurada Principais
$nomeControle = "Usuario";
$nomePage = "Usuário";
$tagTab = "frm/frmUsuario";
$urlApp = "../../";
$urlAppAdm = "../";
$msgText = "";
$msg = Request::Do_GET("msg", 0);

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

use _lib\raelgc\view\Template;

$tpl = new Template("../view/" . $tagTab . ".html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FORm", "../view/partsHTML/frms/frm_UsuarioSC.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
//$tpl->addFile("SCRIPT_FRM", "../view/Include/script_FrmUsuarios.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
/* valida dizendo que o nivel 4 e 5 pode acessa */
//$nivelR = array(0 => "4", 1 => "5");
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';


//variaveis
$disabled = '';
$op = Request::Do_GET("op", 0);
//$id = Request::Do_GET("id", 0);
//$tpl->id = $id;

/**/
if ($op == 5) {
    $tpl->block("BLOCK_AI");
} else {
    $tpl->clear("BLOCK_AI");
}
if ($op == 4) {
    $tpl->block("BLOCK_AS");
} else {
    $tpl->clear("BLOCK_AS");
}

$page = $PHTML->OPNamePage($op, $nomePage, 'f');
$disabled = $PHTML->getImputDisabled();

$msgText = $MSGobg->MenssagemToPAGESuaConta($msg);
$tpl->msg = $msgText;
$tpl->info = "<h6><strong class='text-blue'> <i class='text-red'> -> </i> Em Contrução </strong></h6>";
$tpl->page = $page;
$tpl->nomeControle = $nomeControle;
$tpl->show();

