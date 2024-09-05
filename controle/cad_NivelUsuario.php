<?php
require '../config.php';
//frmNivelUsuario lstNivelUsuario

//class
$obj = null;
$dao = new DaoNivelUsuario();

$acao = Request::Do_REQUEST("acao", "");
$id = Request::Do_REQUEST("id", 0);

switch ($acao):
    case "n": 
        header("location:../admin/frm/frmNivelUsuario.php?id=" . $id . "&op=0");
        break;
    case "s":
        $obj = new NivelUsuario($id, Request::Do_POST("nome", ""));
        if($obj->getId() == 0):
        if ($dao->inserir($obj)) {
            header("location:../admin/lst/lstNivelUsuario.php?msg=1");
        } else {
            header("location:../admin/lst/lstNivelUsuario.php?msg=2");
        }    
        else:
            if ($dao->alterar($obj)) {
            header("location:../admin/lst/lstNivelUsuario.php?msg=1");
        } else {
            header("location:../admin/lst/lstNivelUsuario.php?msg=2");
        }
        endif;
        break;
    case "a":
        header("location:../admin/frm/frmNivelUsuario.php?id=" . $id . "&op=1");
        break;
    case "v":
        header("location:../admin/frm/frmNivelUsuario.php?id=" . $id . "&op=2");
        break;
    case "l":
            header("location:../admin/lst/lstNivelUsuario.php");
        break;
    case "d":
        if (TRUE) {
            header("location:../admin/lst/lstNivelUsuario.php?msg=1");
        } else {
            header("location:../admin/lst/lstNivelUsuario.php?msg=2");
        }
        break;
    case "e":
        if (TRUE) {
            header("location:../admin/lst/lstNivelUsuario.php?msg=1");
        } else {
            header("location:../admin/lst/lstNivelUsuario.php?msg=2");
        }
        break;
    default :
        session_destroy();
        header('location: ../index.php'); //../login.php?msg=5
        break;
endswitch;
 