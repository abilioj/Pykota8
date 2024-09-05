<?php

require '../../config.php';

//variavel com configurada Principais
$page = "";
$nomeControle = "";
$NamePageview = "Grupos Montados";
$urlAppAdm = "../";
$urlApp = "../../";
$msgText = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//variavel 
$msg = Request::Do_GET("msg", 0);
$acao = Request::Do_GET('acao', null);

If ($msg == 1) {
    $msgText = '<div id="msg"><div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div></div>';
}
if ($msg == 2) {
    $msgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>';
}

//variavel Class
$daoAG = new DaoGeneric();
$daoTG = new DaoTabGeneric();
$daoCU = new DaoCotasUser();

//Arrays
$arrayCotasUser = $daoAG->listContasUserFindAll();

use _lib\raelgc\view\Template;

$tpl = new Template("../view/page/lstGroupMontado.html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
//$tpl->addFile("ModalOpcoes_Grupo", "../view/partsHTML/modal/ModalOpcoes_Grupo.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

foreach ($arrayCotasUser as $row):
    $tpl->idg = $row["idg"];
    $tpl->idu = $row["idu"];
    $tpl->grupo = $row["grupo"];
    $tpl->usuario = $row["usuario"];
    $tpl->LimiteSetor = $row["LimiteSetor"];
    $tpl->block("BLOCK_LISTAS");
endforeach;

/* config pra campos de Datas */
//require './includes/ConfigToData.php';
//$tpl->data = $daoCU->listContasUser();
$tpl->page = $NamePageview;
$tpl->msg = $msgText;
$tpl->show();
