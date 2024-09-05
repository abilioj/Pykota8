<?php

//relatorios
require '../config.php';

/* variavel com configurada Principais */
$page = "";
$nomeControle = "relatorios";
$NamePageview = "Relatórios";
$tagTab = "";
$modalTab = "";
$urlAppAdm = "./";
$urlApp = "../";
$msgText = "";
$disabledPrinters = "";

/* sessao */
$link = $urlAppAdm;
require '' . $urlAppAdm . 'includes/Validasesao.php';

/* variavel */
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$acao = Request::Do_GET('acao', null);

/* variavel Class */
$daoG = new DaoGeneric();
$daoAG = new DaoArrayGeneric();
$daoTG = new DaoTabGeneric();

use _lib\raelgc\view\Template;

$tpl = new Template("./view/relatorios.html");
$tpl->addFile("HEAD", "./view/Include/head.html");
$tpl->addFile("HRADER_MENU", "./view/Include/header_menu.html");
$tpl->addFile("FOOTER", "./view/Include/footer.html");
$tpl->addFile("SCRIPT_UTIL", "./view/Include/script_Util.html");
$tpl->addFile("SCRIPT", "./view/Include/script.html");

$tpl->caminho = $urlAppAdm;
$tpl->caminhos = $urlApp;

/* ConfigHTML */
require '' . $urlAppAdm . 'includes/ConfigHtml.php';
require '' . $urlAppAdm . 'includes/InfoUserLogado.php';

$tpl->addFile("TABLE", "./view/partsHTML/parts/TABRelatorios.html");
$tpl->addFile("PARTSFORM", "./view/partsHTML/parts/partsFormRelatorios.html");

//$arrayHistoricoUsuario = $daoG->listHistoricoUsuario(null);
/*if (is_array($arrayHistoricoUsuario)):
    foreach ($arrayHistoricoUsuario as $row):
        $tpl->nome = $row["nome"];
        $tpl->impressora = $row["impressora"];
        $tpl->arquivo = $row["arquivo"];
        $tpl->qtd_paginas = $row["qtd_paginas"];
        $tpl->block("BLOCK_LISTAS");
    endforeach;
endif;*/

$tpl->show();
