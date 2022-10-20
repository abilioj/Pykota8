<?php

//abre o buffer para inicializar os cookies
ob_start();
//inicializa a sessao
session_start();

$ServiceGET->GETNavegadorSO();

//variaveis
$sql = "";
$conn = new Conexao();
$nivel = (int) 0;
$niveis = (array) null;
$IsOK = (bool) false;

$usuid = Request::Do_SESSION("idusu" . $Service->getNameSESSION() . "", 0);
$UrlLink = "" . $link . "login.php?msg=9";

// Verifica se existe os dados da sessão de login
if ($usuid == 0):
    header("Location: " . $UrlLink . "");
    exit;
else:

    /* class */
    $usu = new Usuario();
    $UI = new Usuario_Interno($usuid, 0);
    $CU = new CotasUser(0, 0, 0);
    $daoU = new DaoUsuario();
    $daoUI = new DaoUsuario_Interno();
    $daoArrayG = new DaoArrayGeneric();
    $daoCU = new DaoCotasUser();

    $usu->setId($usuid);
    $USUlogado = $daoU->selecionar($usu);
    
    $nivel = $USUlogado->getNivel();
    $fotoUsulog = $USUlogado->getFoto();
    $niveis = $daoArrayG->Array_Nivel();
    
    $ui = $daoUI->selecionar($USUlogado);

    if ($ui->getID_USERS() == 0 && $USUlogado->getNivel() <= 3):
        header("Location:" . $link . "login.php?msg=11");
        exit;
    endif;
    
endif;


