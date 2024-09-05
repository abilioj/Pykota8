<?php
require './config_json.php';

//variavel Class
$sqlR = new SqlRules();
$connConf = new ConfigBDClass();
$conn = new Conexao();
$daoAG = new DaoArrayGeneric();
$daoG = new DaoGeneric();

//variavel
$resutado = 0;
$resutadoII = 0;
$sql_tb = '';
$row = 0;
$IsOK = false;
$IsOKI = false;
$IsOKII = false;
$arrayWhere = null;
$result = null;
$data = null;
$dados = null;
$idUQ = (int) Request::Do_POST("iduq", 0); // usuarios que disponisbilizar as cotas
$idU = (int) Request::Do_POST("idu", 0); //usuario a receber as cotas
$pku = (int) Request::Do_POST("pku", 0);
$idG = (int) Request::Do_POST("idg", 0);
$LimiteNAdd = (int) Request::Do_POST("LimiteNAdd", 0);
$limiteA = (int) Request::Do_POST("limiteA", 0);
$limite_disponivel = (int) Request::Do_POST("limite_disponivel", 0);
$acao = (string) Request::Do_POST('acao', null);

switch ($acao) {
    case "z":
        $IsOK = false;
        $sqlN = "UPDATE userpquota SET softlimit = 0 WHERE id = {$idU};";
        $conn = new Conexao();
        $conn->sql = $sqlN;
        if ($conn->updateQuery()):
            $IsOK = true;
        endif;
        break;
    case "a":
        if ($idUQ >= 1):
            $IsOK = false;
            $resutado = ($limiteA > 0) ? $limiteA + $LimiteNAdd : $LimiteNAdd; //idu
            $resutadoII = (int) $limite_disponivel - $LimiteNAdd; //iduq
            $utilFunc = new functionUtil();
            $sqlArray = array(
                0 => "UPDATE userpquota SET softlimit = {$resutado} WHERE id = {$idU};"
                , 1 => "UPDATE userpquota SET softlimit = {$resutadoII} WHERE id = {$idUQ};"
            );
            $IsOK = $utilFunc->updateQuery2Array($sqlArray);
        else:
            $IsOK = false;
            $resutado = (int) $limiteA + $LimiteNAdd;
            $sqlN = "UPDATE userpquota SET softlimit = {$resutado} WHERE id = {$idU};";
            $conn = new Conexao();
            $conn->sql = $sqlN;
            if ($conn->updateQuery()):
                $IsOK = true;
            endif;
        endif;
        break;
    case "b":
        //buscar limite de cota usuario selecionado
        if ($idUQ > 0):
            $conn->sql = $sqlR->sqlVerLimiteUsuario($idUQ);
        else:
            $conn->sql = $sqlR->sqlVerLimiteGrupo($idG);
        endif;
        $ArrayUser = $conn->montaArrayPesquisa();
        foreach ($ArrayUser as $v):
            $dados['userLimite'][] = ["limite" => (int) $v["limite"]];
        endforeach;
        break;
    case "r":
            $IsOK = false;
            $utilFunc = new functionUtil();
            $sqlArray = array(
                0 => "UPDATE userpquota SET softlimit = 0 WHERE userid = {$pku};"
                , 1 => "DELETE FROM groupsmembers WHERE groupid = {$idG} and userid = {$pku};"
            );
            $IsOK = $utilFunc->updateQuery2Array($sqlArray);
        break;
    default:
        break;
}

$dados['info'] = ['row' => $row, 'idU' => $idU, 'idUQ' => $idUQ, 'idG' => $idG
    , 'limiteNAdd' => $LimiteNAdd, 'limiteA' => $limiteA, 'isok' => $IsOK
    , 'resutado' => $resutado
];
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
