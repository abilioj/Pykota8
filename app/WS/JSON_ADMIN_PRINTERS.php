<?php
require './config_json.php';

//variavel Class
$daoIp = new DaoIPPrinter();

//variavel 
$sql_tb = '';
$result = null; 
$dados = null;
$isOk = false;
$id = Request::Do_POST("id", 0);
$ip = Request::Do_POST("ip", "");
$acao = Request::Do_POST('acao', null);

if($id >=1 && $ip !== ""):
    if($daoIp->fucaoVerificarDefull(array("ipp.id_printer=" . $id . ""))):
        $dadosArray = array($id ,$ip);
        $campoArray = array("id_printer","ip");
        $where = "id_printer=" . $id . "";
        $dados[] = array('isOK' => $daoIp->fucaoAtualizarDefull($dadosArray, $campoArray, $where));
    else:
        $objIP = new IPPrinter($id, $ip);
        $dados[] = array('isOK' => $daoIp->inserir($objIP));
    endif;
endif;

/*
*/
//echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);