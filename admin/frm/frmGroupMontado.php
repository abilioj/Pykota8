<?php

require '../../config.php';

//variavel com configurada Principais
$page = "";
$nomeControle = "ContasUser";
$NamePageview = "Montar Grupo";
$urlAppAdm = "../";
$urlApp = "../../";
$msgText = "";
$disabled = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

//variavel 
$idU = Request::Do_GET('idu', 0);
$idG = Request::Do_GET('idg', 0);
$op = Request::Do_GET('op', 0);
$msg = Request::Do_GET("msg", null);

$page = $PHTML->OPNamePage($op, $NamePageview, "f");
$disabled = $PHTML->getImputDisabled();
$acaoFunc = null;

//variavel Class
$objCU = new CotasUser((int)$idU, (int) 0, (int)$idG);
$dao = new DaoCotasUser();
$daoAG = new DaoArrayGeneric();
$daoTG = new DaoTabGeneric();
$daoGN = new DaoGeneric();

//Arrays pra campos Select
$userArray = $daoAG->Array_User(0);
$groupsArray = $daoAG->Array_Groups(0,0);

if ($objCU->getPkgroup() > 0 && $objCU->getPkuser() > 0):
    $objCU = $dao->selecionar($objCU);
    $acaoFunc = 1;
else:
    $objCU = new CotasUser(0, 0, 0);
    $acaoFunc = 0;
endif;

use _lib\raelgc\view\Template;
$tpl = new Template("../view/page/frmGroupMontado.html");
$tpl->addFile("HEAD", "../view/Include/head.html");
$tpl->addFile("HRADER_MENU", "../view/Include/header_menu.html");
$tpl->addFile("FOOTER", "../view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "../view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "../view/Include/script.html");
$tpl->addFile("BTN_FORNFULL", "../view/partsHTML/btn/BTN_FORNFULL.html");
$tpl->block("" . $PHTML->getBlock() . "");
$tpl->clear("" . $PHTML->getClear() . "");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

/* config pra campos de Datas */
//require './includes/ConfigToData.php';

foreach ($groupsArray as $n) :
    $tpl->IDG = $n["id"];
    $tpl->VALUEG = $n["value"];
    // Vendo se a opção atual deve ter o atributo "selected"
    if ($idG == $n["id"]):
        // Caso esta não seja a opção atual, limpamos o valor da variável SELECTED
        $tpl->SELECTEDG = "selected";
    else:
        $tpl->clear("SELECTEDG");
    endif;
    $tpl->block("BLOCK_G");
endforeach;

foreach ($userArray as $n) :
    $tpl->IDU = $n["id"];
    $tpl->VALUEU = $n["value"];
    // Vendo se a opção atual deve ter o atributo "selected"
    if ($idU == $n["id"]):
        // Caso esta não seja a opção atual, limpamos o valor da variável SELECTED
        $tpl->SELECTEDU = "selected";
    else:
        $tpl->clear("SELECTEDU");
    endif;
    $tpl->block("BLOCK_U");
endforeach;

$tpl->page = $NamePageview;
$tpl->nomeControle = $nomeControle;
//$tpl->msg = $msgText;
//$tpl->OP = $op;
$tpl->acaoFunc = $acaoFunc;
$tpl->O = $objCU;
$tpl->disabled = $disabled;
$tpl->show();
