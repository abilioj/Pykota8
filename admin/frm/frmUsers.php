<?php

//frmUsers
require_once("../../config.php");

//variavel com configurada Principais
$nomeControle = "Users";
$nomePage = "Usuário";
$namepage = "frm/frmUsers";
$urlApp = "../../";
$urlAppAdm = "../";
$msgText = "";
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//Class
$objuSer = new Users();
$objGM = null;
$daoUser = new DaoUsers();
$daoGM = new DaoGroupsMembers();
$daoArray = new DaoArrayGeneric();
$DadosArray = new DadosArray();

//variaveis
$groupsArray = null;
$tipoLimeteArray = null;
$printersArray = null;
$disabled = '';
$disabledQuota = '';
$quotaOUbalance = '';
$op = Request::Do_GET("op", 0);
$idOP = $op > 2 ? $usuid : 0;
$id = Request::Do_GET("id", $idOP);

if ($id >= 1):
    //Array de select 
    $groupsArray = $daoArray->Array_Groups(0, 0);
    $printersArray = $daoArray->Array_Printers();
    //pega o usuarios
    $objuSer->setId($id);
    $objuSer = $daoUser->selecionar($objuSer);
    //pega o grupo
    $objGM = new GroupsMembers(0, $objuSer->getId());
    $objGM = $daoGM->selecionar($objGM);
else:
    $objGM = new GroupsMembers(0, 0);
endif;

//configurar page 
$page = $PHTML->OPNamePage($op, $nomePage, 'f');
$disabled = $PHTML->getImputDisabled();

use _lib\raelgc\view\Template;

$tpl = new Template("../view/" . $namepage . ".html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;
/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';

/* valida dizendo que o nivel 4 e 5 pode acessa */
//$nivelR = array(0 => 4, 1 => 5);
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

/* TABs Padrões */
$tpl->addFile("PRESENTATIONDPs", "../view/partsHTML/TABs/users/PRESENTATION/presentationDPs.html");
$tpl->addFile("TABPANELDPs", "../view/partsHTML/TABs/users/TABPANEL/tabpanelDPs.html");

if ($op > 0):
    //ativa a regra de balance nas cota de Usuario, onde a cota não é por impressorar 
    $quotaOUbalance = "Balance";
    if ($quotaOUbalance == "Balance"):
        $tipoLimeteArray = $DadosArray->ArrayTipoLimite();
    endif;
//    $tpl->addFile("PRESENTATIONDPy", "../view/partsHTML/TABs/users/PRESENTATION/presentationDPy.html");
    $tpl->addFile("TABPANELDPy", "../view/partsHTML/TABs/users/TABPANEL/tabpanelDPy" . $quotaOUbalance . ".html");
else:
    $tpl->addFile("TABPANELDPy", "../view/partsHTML/OfNULL.html");
endif;

//Bloco de butões
$tpl->addFile("BTN_FORNFULL", "../view/partsHTML/btn/BTN_FORNFULL.html");
$tpl->block("" . $PHTML->getBlock() . "");
$tpl->clear("" . $PHTML->getClear() . "");

if (is_array($groupsArray) && $groupsArray != null):
    foreach ($groupsArray as $n):
        $tpl->IDG = $n["id"];
        $tpl->VALUEG = $n["value"];
        if ($objGM->getGroupid() == $n["id"]):
            $tpl->SELECTEDG = "selected";
        else:
            $tpl->clear("SELECTEDG");
        endif;
        $tpl->block("BLOCK_G");
    endforeach;
endif;

if (is_array($printersArray) && $printersArray != null):
    foreach ($printersArray as $n):
        $tpl->IDP = $n["id"];
        $tpl->VALUEP = $n["value"];
        $tpl->block("BLOCK_P");
    endforeach;
endif;

if (is_array($tipoLimeteArray) && $tipoLimeteArray != null):
    foreach ($tipoLimeteArray as $n):
        $tpl->IDTL = $n["id"];
        $tpl->VALUETL = $n["value"];
        if ($objuSer->getLimitby() == $n["value"]):
            $tpl->SELECTEDTL = "selected";
        else:
            $tpl->clear("SELECTEDTL");
        endif;
        $tpl->block("BLOCK_TL");
    endforeach;
endif;

//Var tpl
$tpl->U = $objuSer;
$tpl->GM = $objGM->getGroupid();
$tpl->op = $op;
$tpl->page = $page;
$tpl->msg = $msgText;
$tpl->info = "";
$tpl->nomeControle = $nomeControle;
$tpl->disabled = $disabled;
$tpl->quotaOUbalance = $quotaOUbalance;
$tpl->show();
