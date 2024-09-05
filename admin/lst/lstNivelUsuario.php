<?php

require '../../config.php';

//class
$dao = new DaoNivelUsuario();

//variavel de configuraçao
$page = "Listar Nivel de Usuário";
$nomeControle = "NivelUsuario";
$NamePageview = "";
$tagTab = "";
$urlAppAdm = "../";
$urlApp = "../../";
$msgText = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//variavel Principal
$op = Request::Do_GET("op", 0);
$msg = Request::Do_GET("msg", 0);

if ($msg == 1) {
    $msgText = '<div id="msg"><div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div></div>';
}
if ($msg == 2) {
    $msgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>';
}
if ($msg == 502) {
    $msgText = '<div id="msg"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Estamos implementando essa Operação.</div></div>';
}

use _lib\raelgc\view\Template;
$tpl = new Template("../view/lst/lstNivelUsuario.html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
$tpl->addFile("ModalOpcoes", "../view/partsHTML/modal/ModalOpcoes.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';
if ($op == 0):
    $tpl->clear("ModalOpcoes");
    $tpl->dados = $dao->Listar();
else:
    $tpl->nomeControle = $nomeControle;
    $tpl->dados = $dao->ListarToFone();
endif;

$tpl->OP = $op;
$tpl->page = $page;
$tpl->msg = $msgText;
$tpl->show();

