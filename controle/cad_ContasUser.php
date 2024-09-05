<?php

// lst/lstGroupMontado.php frm/frmGroupMontado.php       controle/cad_ContasUser.php
require '../config.php';


//variaveis
$acao = Request::Do_REQUEST("acao", "");
$acaoFunc = Request::Do_POST("acaoFunc", null);
$idU = Request::Do_GET('idu', 0);
$idG = Request::Do_GET('idg', 0);

/* Class */
$obj = new CotasUser(0, 0, 0);
$dao = new DaoCotasUser();


switch ($acao):
    case "n":
        header("location:../admin/frm/frmGroupMontado.php?id=0&op=0");
        break;
    case "s":
        $obj = new CotasUser(Request::Do_POST("idU", 0), Request::Do_POST("limit", 0), Request::Do_POST("idG", 0));
        if ($acaoFunc == 0):
            if ($dao->inserir($obj)):
                header("location:../admin/lst/lstGroupMontado.php?msg=1");
            else:
                header("location:../admin/lst/lstGroupMontado.php?msg=2");
            endif;
        else:
            $idAtual = Request::Do_POST("idAtual", 0);
            if ($idAtual == $obj->getPkuser()):
                if ($dao->alterar($obj)):
                    header("location:../admin/lst/lstGroupMontado.php?msg=1");
                else:
                    header("location:../admin/lst/lstGroupMontado.php?msg=2");
                endif;
            else:
                if ($dao->alterarUsu($obj, $idAtual)):
                    header("location:../admin/lst/lstGroupMontado.php?msg=1");
                else:
                    header("location:../admin/lst/lstGroupMontado.php?msg=2");
                endif;
            endif;
        endif;
        break;
    case "sv":
        if (TRUE) {
            header("location:../admin/lst/lstGroupMontado.php?msg=1");
        } else {
            header("location:../admin/lst/lstGroupMontado.php?msg=2");
        }
        break;
    case "a":
        $idU = Request::Do_GET('idu', 0);
        $idG = Request::Do_GET('idg', 0);
        header("location:../admin/frm/frmGroupMontado.php?idg=" . $idG . "&idu=" . $idU . "&op=1");
        break;
    case "v":
        header("location:../admin/frm/frmGroupMontado.php?id=" . $id . "&op=2");
        break;
    case "l":
        header("location:../admin/lst/lstGroupMontado.php");
        break;
    case "d":
        if (TRUE) {
            header("location:../admin/lst/lstGroupMontado.php?msg=1");
        } else {
            header("location:../admin/lst/lstGroupMontado.php?msg=2");
        }
        break;
    case "e":
        $idU = Request::Do_GET('idu', 0);
        $idG = Request::Do_GET('idg', 0);
        $obj = new CotasUser($idU, 0, $idG);
        if ($dao->excluir($obj)) {
            header("location:../admin/lst/lstGroupMontado.php?msg=1");
        } else {
            header("location:../admin/lst/lstGroupMontado.php?msg=2");
        }
        break;
    default:
        header('location: ../admin/index.php'); //../admin/login.php?msg=5
        break;
endswitch;
