<?php

require './config_json.php';

//variavel Class
$daoAG = new DaoArrayGeneric();
$daoG = new DaoGeneric();

//variavel 
$sql_tb = '';
$idU = (int) Request::Do_POST("idu", 0);//id de userpquota
$idG = (int) Request::Do_POST("idg", 0);
$result = null;
$dados = null;
$acao = Request::Do_GET('acao', null);

$objCU = new CotasUser($idU, 0, $idG);
$objUQ = new Userpquota(0);
$objUQ->setUserid($idU);
$objUQ->setPrinterid($idI);

if ($objCU->getPkgroup() > 0):
    $ArrayUser = (array) $daoG->listContasUserFindIDGroup($objCU,1);
    foreach ($ArrayUser as $v):
        if ((int)$v['id'] != $idU):
            $dados['userS'][] = ["id" => $v["id"], "idu" => $v["idu"], "text" => $v["usuario"] . "-" . $v["impressora"]
                , "impressora" => $v["impressora"], "limite" => $v["limite"]];
        endif;
    endforeach;
else:
    $dados['userS'] = null;
endif;

//$dados['test'] = $ArrayUserCota;
//echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
