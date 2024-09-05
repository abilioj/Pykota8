<?php

require '../config.php';
//home_painel

/* variavel com configurada Principais */
$urlAppAdm = "./";
$urlApp = "../";

/* variavel */
$msg = Request::Do_GET("msg", "&nbsp; &nbsp; &nbsp;");
$acao = Request::Do_GET('acao', null);

/* variavel Class */
//$daoAG = new DaoArrayGeneric();
//$daoTG = new DaoTabGeneric();

use _lib\raelgc\view\Template;

$tpl = new Template("./view/home_painel.html");

// $tpl->caminho = $urlAppAdm;
// $tpl->caminhos = $urlApp;

$tpl->show();
