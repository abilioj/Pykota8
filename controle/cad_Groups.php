<?php
require_once '../vendor/autoload.php';
//groups
// lstGroups.php frmGroups.php       controle/cad_Groups.php
$service = new ConfigServerPHP();
$service->Error_ReportingLogin();
$service->Date_timezone_set();
$data = new Data();

// var e class ]
$objG = new Groups();
$daoG = new DaoGroups();
$acao = Request::Do_REQUEST("acao", "");
$id = Request::Do_REQUEST("id", 0);

switch ($acao):
    case "n":
        header("location:../admin/frm/frmGroups.php?id=" . $id . "&op=0");
        break;
    case "s":
        $objG->setId($id);
        $objG->setGroupname(Request::Do_POST_STRIMGcaracesp("groupname",""));
        $objG->setDescription(Request::Do_POST_STRIMGcaracesp("description", ""));
        $objG->setLimitby(Request::Do_POST("limitby", 0));
        if ($objG->getId() == 0):
            if ($daoG->inserir($objG)) {
                header("location:../admin/lst/lstGroups.php?msg=1");
            } else {
                header("location:../admin/lst/lstGroups.php?msg=2");
            }
        else:
            if ($daoG->alterar($objG)) {
                header("location:../admin/lst/lstGroups.php?msg=1");
            } else {
                header("location:../admin/lst/lstGroups.php?msg=2");
            }
        endif;
        break;
    case "a":
        header("location:../admin/frm/frmGroups.php?id=" . $id . "&op=1");
        break;
    case "v":
        header("location:../admin/frm/frmGroups.php?id=" . $id . "&op=2");
        break;
    case "l":
        header("location:../admin/lst/lstGroups.php");
        break;
    case "d":
        if (TRUE) {
            header("location:../admin/lst/lstGroups.php?msg=1");
        } else {
            header("location:../admin/lst/lstGroups.php?msg=2");
        }
        break;
    case "e":
        if (TRUE) {
            header("location:../admin/lst/lstGroups.php?msg=1");
        } else {
            header("location:../admin/lst/lstGroups.php?msg=2");
        }
        break;
    default :
        session_destroy();
        header('location: ../index.php'); //../login.php?msg=5
        break;
endswitch;
