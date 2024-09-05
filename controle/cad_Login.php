<?php
require_once '../config.php';

// lstLogin.php frmLogin.php       controle/cad_Login.php

$acao = Request::Do_REQUEST("acao", "");
$id = Request::Do_REQUEST("id", 0);

//class
$obj = new Login();
$dao = new DaoLogin();

switch ($acao):
    case "n":
        header("location:../admin/frm/frmLogin.php?id=" . $id . "&op=0");
        break;
    case "s":
        $objLogin = null;
        break;
    case "a":
        header("location:../admin/frm/frmLogin.php?id=" . $id . "&op=1");
        break;
    case "v":
        header("location:../admin/frm/frmLogin.php?id=" . $id . "&op=2");
        break;
    case "l":
        header("location:../admin/lst/lstLogin.php");
        break;
    case "d":
        if (TRUE) {
            header("location:../admin/lst/lstLogin.php?msg=1");
        } else {
            header("location:../admin/lst/lstLogin.php?msg=2");
        }
        break;
    case "e":
        if (TRUE) {
            header("location:../admin/lst/lstLogin.php?msg=1");
        } else {
            header("location:../admin/lst/lstLogin.php?msg=2");
        }
        break;
    case "logar":
        error_reporting(E_STRICT);
        //abre o buffer para inicializar os cookies
        ob_start();
        //inicializa a sessao
        session_start();
        $obj = new Login();
        $objn = new Login();
        $dao = new DaoLogin();
        $login = Request::Do_POST("login", "");
        $senha = Request::Do_POST("senha", "");
        $obj->setLogin($login);
        $obj->setSenha(ToString::criptografaMD5($senha));
        $usuL = $dao->login($obj);
        if ($usuL->getLogin() == $obj->getLogin()):
            if ($usuL->getSenha() == $obj->getSenha()):
                $_SESSION['idusu' . $Service->getNameSESSION() . ''] = $usuL->getId();
                header('location: ../index.php');
            else:
                header('location: ../admin/login.php?msg=2');
            endif;
        else:
            header('location: ../Admin/login.php?msg=1');
        endif;
        break;
    default :
        session_destroy();
        header('location: ../index.php'); //../login.php?msg=5
        break;
endswitch;
