<?php
require './config_json.php';

//Classes de utilização
$Service->Default_charset();
$Service->Error_Reporting();

//variavel Class
$sqlR = new SqlRules();
$connConf = new ConfigBDClass();
$conn = new Conexao();
$daoAG = new DaoArrayGeneric();
$daoG = new DaoGeneric();
$daoRU = new DaoResponGroups();

//variavel
$string = '';
$sql_tb = '';
$row = 0;
$IsOK = false;
$arrayWhere = null;
$result = null;
$data = null;
$dados = null;
$idUr = (int) Request::Do_POST("idur", 0); // usuarios
$idU = (int) Request::Do_POST("idu", 0); //usuario
$idG = (int) Request::Do_POST("idg", 0);
$acao = (string) Request::Do_POST('acao', null);

$objRU = new ResponGroups($idU, $idUr, $idG);
switch ($acao) {
    case "a":
        $IsOK = $daoRU->inserir($objRU);
        break;
    case "e":
        $IsOK = $daoRU->excluir($objRU);
        break;
    default:
        break;
}

$dados['info'] = ['row' => $row, 'string' => $string, 'isOK' => $IsOK];
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
