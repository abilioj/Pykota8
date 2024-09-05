<?php
require_once '../config.php';

// lstPrinters.php frmPrinters.php       controle/cad_Printers.php?acao=
//Printers
$acao = Request::Do_REQUEST("acao", "");
$id = Request::Do_REQUEST("id", 0);
$objP = null;
$daoPrin = null;
$resuDefat = null;

switch ($acao):
    case "n":
        header("location:../admin/frm/frmPrinters.php?id=" . $id . "&op=0");
        break;
    case "s":
        $objP = new Printers();
        $daoPrin = new DaoPrinters();
        $objP->setId($id);
        $objP->setPrintername(Request::Do_POST("printername", ''));
        $objP->setDescription(Request::Do_POST("description", ''));
        $objP->setPriceperpage(Request::Do_POST("priceperpage", 0.0));
        $objP->setPriceperjob(Request::Do_POST("priceperjob", 0.0));
        $objP->setPassthrough(Request::Do_POST("passthrough", false));
        $objP->setMaxjobsize(Request::Do_POST("maxjobsize", 0));
        if ($objP->getId() == 0):
            if ($daoPrin->inserir($objP)):
                header("location:../admin/lst/lstPrinters.php?msg=1");
            else:
                header("location:../admin/lst/lstPrinters.php?msg=2");
            endif;
        else:
            if ($daoPrin->alterar($objP)):
                header("location:../admin/lst/lstPrinters.php?msg=1");
            else:
                header("location:../admin/lst/lstPrinters.php?msg=2");
            endif;
        endif;
        break;
    case "a":
        header("location:../admin/frm/frmPrinters.php?id=" . $id . "&op=1");
        break;
    case "v":
        header("location:../admin/frm/frmPrinters.php?id=" . $id . "&op=2");
        break;
    case "l":
        header("location:../admin/lst/lstPrinters.php");
        break;
    case "d":
        break;
    case "e":
        if (TRUE):
            header("location:../admin/lst/lstPrinters.php?msg=1");
        else:
            header("location:../admin/lst/lstPrinters.php?msg=2");
        endif;
        break;
    default :
        header('location: www.php'); //../login.php?msg=5
        break;
endswitch;
