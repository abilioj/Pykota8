<?php

//FRMPADEDEFAULT or frm/frmUsuario -- script_FrmUsuarios
require_once("../../config.php");

//variavel com configurada Principais
$nomeControle = "Usuario";
$nomePage = "Usuário";
$tagTab = "frm/frmUsuario";
$urlApp = "../../";
$urlAppAdm = "../";
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//if ($nivel == $obj->getNivel() || $nivel == 5):
//    $PERMIT = true;
//endif;
//if (!$PERMIT): header("Location: ../lst/lstUsuario.php?msg=403");
//endif;
//variaveis
$disabled = '';
$op = Request::Do_GET("op", 0);
$idOP = $op > 2 ? $usuid : 0;
$id = Request::Do_GET("id", $idOP);

use _lib\raelgc\view\Template;

$tpl = new Template("../view/" . $tagTab . ".html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FORm", "../view/partsHTML/frms/frm_Usuario.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
//$tpl->addFile("SCRIPT_FRM", "../view/Include/script_FrmUsuarios.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';

/* valida dizendo que o nivel 4 e 5 pode acessa */
$nivelR = array(0 => 4, 1 => 5);
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

//class a ser utilizardas
$dao = new DaoUsuario();
$daoUI = new DaoUsuario_Interno();

$DaoArray = new DaoArrayGeneric();
//Arrays pra campos Select
$users = $DaoArray->Array_User();
$niveis = $DaoArray->Array_Nivel();

$obj = new Usuario();
if ($id >= 1):
    $obj->setId($id);
    $obj = $dao->selecionar($obj);
    $tpl->U = $obj;
//    $UI = $daoUI->selecionarPeloUser($obj);
else:
    $tpl->U = $obj;
endif;

foreach ($niveis as $n) {//
    $tpl->IDNN = $n["id"];
    $tpl->VALUENN = $n["value"];
    // Vendo se a opção atual deve ter o atributo "selected"
    if ($obj->getNivel() == $n["id"]):
        // Caso esta não seja a opção atual, limpamos o valor da variável SELECTED
        $tpl->SELECTEDNN = "selected";
    else:
        $tpl->clear("SELECTEDNN");
    endif;
    $tpl->block("BLOCK_N");
}

foreach ($users as $u) {//
    $tpl->IDNU = $u["value"];//id
    $tpl->VALUENU = $u["value"];
    
    // Vendo se a opção atual deve ter o atributo "selected"
    if ($obj->getLogin() == $n["value"]):
        // Caso esta não seja a opção atual, limpamos o valor da variável SELECTED
        $tpl->SELECTEDNU = "selected";
    else:
        $tpl->clear("SELECTEDNN");
    endif;
    
    $tpl->block("BLOCK_U");
}

//regra da pagina cadastrar Usuarios
if ($op == 0):
    $tpl->block("CAMPOSENHA");
    $tpl->block("BLOCK_NOVO");
    $tpl->clear("BLOCK_ALTERAR");
else:
    $tpl->clear("BLOCK_NOVO");
    $tpl->clear("CAMPOSENHA");
    $tpl->block("BLOCK_ALTERAR");
endif;

if ($op <= 2):
    $tpl->addFile("BTN_FORNFULL", "../view/partsHTML/btn/BTN_FORNFULL.html");
else:
    $id = $usuid;
    $tpl->addFile("BTN_FORNFULL", "../view/partsHTML/btn/BTN_FORNYourAccount.html");
endif;

//$tpl->id = $id;
/* CRIANDO UM OBEJTO usuariointerno */
$UI = new Usuario_Interno(0, 0, 0);

$page = $PHTML->OPNamePage($op, $nomePage, 'f');
$disabled = $PHTML->getImputDisabled();

//Bloco de butões
$tpl->block("" . $PHTML->getBlock() . "");
$tpl->clear("" . $PHTML->getClear() . "");

$tpl->page = $page;
$tpl->msg = $msgText;
$tpl->info = "";
$tpl->nomeControle = $nomeControle;
$tpl->disabled = $disabled;
$tpl->show();
