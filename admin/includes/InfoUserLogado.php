<?php

/*
 * include de informação de usuario logado
 */

/* Var */
$IDusarioResp = 0;
$IDGroupResp = 0;
$nivelUse = null;

foreach ($niveis as $n):
    if ($nivel == $n["id"]):
        $nivelUse = $n["value"];
    endif;
endforeach;

//PARA MENU
$nivelADM = array(0 => 4, 1 => 5);
//aqui validar o acesse a funções do menu Adm
if ($nivel == $nivelADM[0] || $nivel == $nivelADM[1]):
    $tpl->block("BLOCK_ADMIN");
else:
    $tpl->clear("BLOCK_ADMIN");
    //se ouver responsabilidade em algum grupo
    $daoRU = new DaoResponGroups();
    if($daoRU->fucaoVerificarDefull(array("r.id_user = " . $ui->getID_USERS() . ""),false)):
        $obj = new ResponGroups($ui->getID_USERS(), 0, 0);
        $objRU = $daoRU->buscarResponsavel($obj);
        $IDusarioResp = $objRU->getId_user_res();
        $IDGroupResp = $objRU->getId_group();
    endif;/**/
endif;
 
//aqui começa a validação da pagina
if (isset($nivelR)):
    if (empty($nivelR)):
    else:
        $linkParametro = "{$link}index.php?msg=505";
        $validarPage = new ValidarAcesso();
        $validarPage->validarAcessoPage($nivelR, $linkParametro, $nivel);
    endif;
endif;
    
$tpl->idUse = $USUlogado->getId();
$tpl->idUsePykota = $ui->getID_USERS();
$tpl->nomeUse = $USUlogado->getNome();
$tpl->nivelUseID = $USUlogado->getNivel();
$tpl->nivelUse = $nivelUse;

//Validar foto do USER LOGADO
if (file_exists($link . "assets/images/user/t1_" . $fotoUsulog) && file_exists($link . "assets/images/user/t2_" . $fotoUsulog)):
    $tpl->fotoUse = $fotoUsulog;
else:
    $tpl->fotoUse = "user.png";
endif;