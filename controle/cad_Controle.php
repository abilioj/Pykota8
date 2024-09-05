<?php

require '../config.php';

/* Class */
$objUser = null;
$daoUE = new DaoUsuario_Interno();

//variaveis
$IsOK = false;
$acao = Request::Do_REQUEST("acao", "");
$id = Request::Do_REQUEST("id", 0);

switch ($acao):
    case "vicular":
        $user = Request::Do_POST("user", 0);
        $useracess = Request::Do_POST("useracess", 0);
        $objUser = new Usuario_Interno($useracess, $user);
        if ($objUser->getID_USERS() != 0 && $objUser->getID_USUARIO() != 0):
            $where = array("ui.id_usuario={$objUser->getID_USUARIO()}", "ui.id_users={$objUser->getID_USERS()}");
            $isOk = $daoUE->fucaoVerificarDefull($where);
            if ($daoUE->getNumrows() <= 0):
                if ($daoUE->inserir($objUser)):
                    header("location:../admin/vicular.php?msg=1");
                else:
                    header("location:../admin/vicular.php?msg=2");
                endif;
            else:
                header("location:../admin/vicular.php?msg=3");
            endif;
        else:
            header("location:../admin/vicular.php?msg=2");
        endif;
        break;
    case "lmontando":
        header("location:../admin/page/");
        break;
    case "a":
        break;
    case "v":
        break;
    case "vg":
        $idg = Request::Do_GET("idg", 0);
        $idu = Request::Do_GET("idu", 0);
        header("location:../admin/verGroupMontado.php?idg={$idg}&idu={$idu}");
        break;
    case "l":
        break;
    case "d":
        break;
    case "e":
        break;
    default :
        break;
endswitch;
