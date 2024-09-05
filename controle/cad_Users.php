<?php

//cad_Users

require '../config.php';

// lstUsers.php frmUsers.php       controle/cad_Users.php

/* class Padrão api */
$opMSG = (int) 0;
$objUsers = new Users();
$objGM = null;
$objGMn = null;
$Dao = new DaoUsers();
$DaoGM = new DaoGroupsMembers();

$acao = Request::Do_REQUEST("acao", "");
$id = (int) Request::Do_REQUEST("id", 0);

switch ($acao):
    case "n":
        header("location:../admin/frm/frmUsers.php?id=" . $id . "&op=0");
        break;
    case "s":
        $objUsers->setId($id);
        $objUsers->setUsername(Request::Do_POST_STRIMGcaracesp("username", ''));
        $objUsers->setEmail(Request::Do_POST_STRIMGcaracesp("email", ''));
        $objUsers->setBalance(0);
        $objUsers->setLifetimepaid(0);
        $objUsers->setDescription(Request::Do_POST_STRIMGcaracesp("description", ''));
        $objUsers->setOvercharge(1);
        $objUsers->setLimitmonth(0);
        $objUsers->setLimitby(Request::Do_POST("limitby", "quota"));
        if ($objUsers->getId() == 0):
            if ($Dao->inserirSQL($objUsers)):
                header("location:../admin/lst/lstUsers.php?msg=1");
            else:
                header("location:../admin/lst/lstUsers.php?msg=2");
            endif;
        else:
            $objUsers->setBalance(Request::Do_POST("balance", 0));
            $objUsers->setLimitmonth(Request::Do_POST("limitmonth", 0));
            if ($Dao->alterar($objUsers)):
                $idGrupsA = (int) Request::Do_POST("groupsA", 0);
                $idGrups = (int) Request::Do_POST("groups", 0);
                $opMSG = 1;
                if ($idGrups > 0):
                    $objGM = new GroupsMembers($idGrups, $id);

                    //verifico se a grupo viculado ao usuario Pykota
                    if ($DaoGM->fucaoVerificarDefull(array("gm.groupid = " . $idGrupsA . " and gm.userid = " . $id . ""))):
                        $objGMn = new GroupsMembers($idGrupsA, $id);
                        $DaoGM->alterar($objGMn, $idGrups); //altera grupo
                    else:
                        $objGMn = new GroupsMembers($idGrups, $id);
                        if (!$DaoGM->inserir($objGMn))://vicula grupo
                            $opMSG = 3;
                        endif;
                    endif;

                endif;
                header("location:../admin/lst/lstUsers.php?msg={$opMSG}");
            else:
                $opMSG = 2;
                header("location:../admin/lst/lstUsers.php?msg={$opMSG}");
            endif;
        endif;
        break;
    case "a":
        header("location:../admin/frm/frmUsers.php?id=" . $id . "&op=1");
        break;
    case "v":
        header("location:../admin/frm/frmUsers.php?id=" . $id . "&op=2");
        break;
    case "l":
        header("location:../admin/lst/lstUsers.php");
        break;
    case "e":
        if (true) {
            header("location:../admin/lst/lstUsers.php?msg=1");
        } else {
            header("location:../admin/lst/lstUsers.php?msg=2");
        }
        break;
    case "sair":
        break;
    default :
        break;
endswitch;
