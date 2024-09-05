<?php

require '../config.php';

//variavel com configurada Principais
$page = "";
$nomeControle = "";
$NamePageview = "Grupos Montados";
$urlAppAdm = "./";
$urlApp = "../";
$msgText = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//variavel
//$idUP = Request::Do_REQUEST("", null);
$idU = $ui->getID_USERS();
$msg = Request::Do_GET("msg", 0);
$acao = Request::Do_GET('acao', null);

// inicio
// ver se id de usurio é responsavel por um grupo
// fim

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

use _lib\raelgc\view\Template;

$tpl = new Template("./view/page/lstGorupMontados.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");
$tpl->addFile("ModalOpcoes_Grupo", "./view/partsHTML/modal/ModalOpcoesGrupo.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

$obj = new CotasUser($idU, 0, 0); // 112 0 86
$idU = ($IDusarioResp > 0)? $IDusarioResp : $idU;
//Arrays
if ($nivel == 3):
    if($IDGroupResp > 0):
        $arrayCotasUser = $daoAG->listContasUserFindIDUsersII($idU,1);
    else:
        $arrayCotasUser = $daoAG->listContasUserFindIDUsersII($idU,0);
    endif;
else:
    $arrayCotasUser = $daoAG->listContasUserFindAll();
endif;

if (is_array($arrayCotasUser)):
    foreach ($arrayCotasUser as $row):
        $tpl->idg = $row["idg"];
        $tpl->idu = $row["idu"];
        $tpl->grupo = $row["grupo"];
        $tpl->usuario = $row["usuario"];
        $tpl->LimiteSetor = $row["LimiteSetor"];
        $tpl->block("BLOCK_LISTAS");
    endforeach;
endif;

//$tpl->IDRa = $obj->getPkgroup();
$tpl->page = $NamePageview;
$tpl->msg = $msgText;
$tpl->show();
