<?php
//lstUsuario
require_once("../../config.php");

//variavel com configurada Principais
$page="";
$nomeControle = "";
$NamePageView = "";
$caminho = "../";
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");

/* sessao */
$link = $caminho;
require '' . $caminho . 'includes/Validasesao.php';

use _lib\raelgc\view\Template;

$tpl = new Template("../view/lst/lstUsuario.html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
$tpl->addFile("ModalOpcoes", "../view/partsHTML/modal/ModalOpcoes.html");

$tpl->caminho = $caminho;
$tpl->caminhos = "../../";

/* ConfigHTML */
require '' . $caminho . 'includes/ConfigHtml.php';

/* valida dizendo que sao o nivel 4 pode acessa */
$nivelR = array(0 => 4, 1 => 5);
require '' . $caminho . 'includes/InfoUserLogado.php';

/* class a ser utilizardas da page */
$dao = new DaoUsuario;

//variavel Principal
$op = Request::Do_GET("op", 0);

If ($msg == 1) {
    $msgText = '<div id="msg"><div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div></div>';
}
if ($msg == 2) {
    $msgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>';
}
if ($msg == 502) {
    $msgText = '<div id="msg"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Estamos implementando essa Operação.</div></div>';
}

if ($op == 0):
    $tpl->clear("ModalOpcoes");
    $tpl->dados = $dao->Listar();
else:
    $tpl->nomeControle = "Usuario";
    $tpl->TIPO = 0;
    $tpl->dados = $dao->ListarToFone();
endif;

//Lista Usuários
$page="Lista de Usuários";
$tpl->OP = $op;
$tpl->page = $page;
$tpl->msg = $msgText;
$tpl->show();

