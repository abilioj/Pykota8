<?php

require './config_json.php';

//variavel 
$sql_tb = '';
$result = null;
$dados = null;
$isOK = false;
$idU = (int) Request::Do_POST('idU', 0);
$idUQ = (int) Request::Do_POST('idUQ', 0);
$idG = (int) Request::Do_POST('idG', 0);
$idP = (int) Request::Do_POST('idP', 0);
$acao = (int) Request::Do_POST('acao', -1);
$arrayWhere = NULL;

//variavel Class
$conn = new Conexao();
$sql = new Sql(null);
$sqlR = new SqlRules();
$objuSer = new Users();
$objuSerQ = new Userpquota(0);
$objP = new Printers();
$daoUser = new DaoUsers();
$daoUQ = new DaoUserpquota();
$daoP = new DaoPrinters();
$daoArray = new DaoArrayGeneric();
$daoGn = new DaoGeneric();

$sqlstn = "";

//array
$ArrayPrinters = $daoGn->printrsUsersArray($idU);

switch ($acao):
    case 1:
        $objuSerQ->setPrinterid($idP);
        $objuSerQ->setUserid($idU);
        $objuSerQ->setSoftlimit(1);
        $objuSerQ->setHardlimit(0);
        $objuSerQ->setPagecounter(0);
        if ($daoUQ->inserir($objuSerQ)):
            $isOK = true;
        endif;
        break;
    case 2:
        $objuSerQ->setId($idUQ);
        $objuSerQ->setUserid($idU);
        $objuSerQ->setPrinterid($idP);
        if ($daoUQ->excluir($objuSerQ)):
            if ($daoUQ->getNumrow() > 0)
                $isOK = true;
        endif;
        break;
    case 3:
        $dadosMultiplos = [];
        $conn->sql = $sqlR->sqlSelectPrinters();
        $printersArray = $conn->fetchArrayCLASSTYPE();

        foreach ($printersArray as $d):
            if (!$daoUQ->fucaoVerificarDefull(array("uq.userid=" . $idU, "uq.printerid=" . $d[2])))
                $dadosMultiplos[] = array((int) $idU, (int) $d[2], (int) 0, (int) 0);
        endforeach;
        $row = count($dadosMultiplos);

        $sql->tabela = "userpquota";
        $sql->camposTabelas = array("userid", "printerid", "softlimit", "hardlimit");
        $sqlstn = $sql->sqlInserirMultiplos($dadosMultiplos);
        $conn->sql = $sqlstn;
        if($conn->QueryStmtUpdate())$isok = true;
        break;
    default :
        break;
endswitch;

//lista de impressora
if ($ArrayPrinters != []):
    foreach ($ArrayPrinters as $v):
        $dados['data'][] = array($v["iduq"], $v["idp"], $v["nome"]);
    endforeach;
else:
    $dados['data'] = null;
endif;
$dados["isOK"][] = array("isOK" => $isOK, "acao" => $acao, 'sql' => $sqlstn);

/*
 */
//echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
