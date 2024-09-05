<?php

require '../config.php';

//variavel com configurada Principais
$page = "";
$nomeControle = "";
$NamePageview = "Grupos ";
$urlAppAdm = "./";
$urlApp = "../";
$msgText = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

/* variavel */
$quotaOUbalance = (string) "";
$opQB = (int) 0;
$disabled = "disabled";
$idg = (int) Request::Do_GET("idg", 0);
$idu = (int) Request::Do_GET("idu", 0);
$msg = Request::Do_GET("msg", 0);
$acao = Request::Do_GET('acao', null);
$Dados = null;

if ($msg == 1) {
    $msgText = '<div id="msg"><div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div></div>';
}
if ($msg == 2) {
    $msgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>';
}

//variavel Class
$daoAG = new DaoGeneric();
$daoTG = new DaoTabGeneric();
$daoCU = new DaoCotasUser();
$daoRU = new DaoResponGroups();
$objCUR = new CotasUser($idu, 0, $idg); // 112 0 86
$objG = new objGeneric(); // obj de informação view
$objGdata = new objGeneric(); // obj de informação de rules 
//Arrays / dados
$objCU = $daoCU->selecionar($objCUR);
$arrayDadosCotaG = $daoAG->getLimiteDisponivelCotasBalance($objCUR->getPkgroup(), 0);

//informacao geral do grupo
if (!empty($arrayDadosCotaG)):
    $objG->setId($arrayDadosCotaG['id']);
    $objG->setCampoI($arrayDadosCotaG['grupo']);
    $objG->setCampoII($arrayDadosCotaG['reponsavel']);
    $objG->setCampoIII(ToNumber::inteiro($arrayDadosCotaG['limite']));
    $objG->setCampoIV(ToNumber::inteiro($arrayDadosCotaG['consumido']));
    $objG->setCampoV(ToNumber::inteiro($arrayDadosCotaG['disponivel']));
    $objGdata->setCampoV($arrayDadosCotaG['disponivel']);
    $objG->setCampoVI(ToNumber::inteiro($arrayDadosCotaG['limitesetoratual']));
    $objGdata->setCampoVI($arrayDadosCotaG['limitesetoratual']);
    $objG->setCampoVII(ToNumber::inteiro($arrayDadosCotaG['disponivelgeral']));
    $objGdata->setCampoVII($arrayDadosCotaG['disponivelgeral']);
else:
    $msgText = "não ao dados validos.";
endif;

use _lib\raelgc\view\Template;

$tpl = new Template("./view/page/verGroupMontado.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");
$tpl->addFile("ModalVUsersResp", "./view/partsHTML/modal/ModalVUsersResp.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

//ativa a regra de balance nas cota de Usuario, onde a cota não é por impressorar 
$quotaOUbalance = "Balance";
if ($quotaOUbalance == "Balance"):
    $opQB = 3;
else:
    $opQB = 1;
endif;

/* TABs Padrões - e regra de acesso de adm e usuario */
$tpl->addFile("PRESENTATIONI", "./view/partsHTML/TABs/verGroupMontado/PRESENTATION/presentationI.html");
$tpl->addFile("TABPANELI", "./view/partsHTML/TABs/verGroupMontado/TABPANEL/tabpanelI{$quotaOUbalance}.html");

$tpl->addFile("ModalUpdateConta", "./view/partsHTML/modal/ModalUpdateConta{$quotaOUbalance}.html");
if ($IDGroupResp == 0 && $USUlogado->getNivel() > 3):
    $tpl->addFile("PRESENTATIONII", "./view/partsHTML/TABs/verGroupMontado/PRESENTATION/presentationII.html");
    $tpl->addFile("TABPANELII", "./view/partsHTML/TABs/verGroupMontado/TABPANEL/tabpanelII.html");
    $tpl->DADOS = $daoRU->Listar($idu, $idg);
    $tpl->block("BLOCK_BTN_AD");
    $arrayCotasUser = $daoAG->listContasUserFindIDGroup($objCUR, $opQB);
else:
    $tpl->clear("BLOCK_BTN_AD");
    $arrayCotasUser = $daoAG->listContasUserFindIDGroupBalance($objCUR->getPkgroup());
endif;

// tabela de usuarios do grupo
if (!empty($arrayCotasUser)):
    if ($opQB <= 2):
        foreach ($arrayCotasUser as $row):
            $tpl->id = $row["id"];
            $tpl->idu = $row["idu"];
            $tpl->idi = $row["idi"];
            $tpl->usuario = $row["usuario"];
            $tpl->limite = $row["limite"];
            $tpl->consumido = $row["consumido"];
            $tpl->disponivel = $row["disponivel"];
            $tpl->impressora = ($row["impressora"]) ? $row["impressora"] : "Geral";
            $tpl->block("BLOCK_LISTAS");
        endforeach;
    else:
        foreach ($arrayCotasUser as $row):
            $tpl->idu = $row["idu"];
            $tpl->usuario = $row["usuario"];
            $tpl->limite = $row["balance"];
            $tpl->consumido = $row["consumido"];
            $tpl->limmiteMensal = $row["limitmonth"];
            $tpl->block("BLOCK_LISTAS");
        endforeach;
    endif;
endif;

$tpl->page = $NamePageview;
$tpl->IDRESPONSAVEL = $objCU->getPkuser();
$tpl->B = $objG;
$tpl->BR = $objGdata;
$tpl->msg = $msgText;
$tpl->quotaOUbalance = $quotaOUbalance;
$tpl->show();
