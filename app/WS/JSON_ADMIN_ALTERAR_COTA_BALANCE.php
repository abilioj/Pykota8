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
$LimiteAtual = (int) Request::Do_POST("LimiteAtual", 0);
$limite_disponivel = (int) Request::Do_POST("limite_disponivel", 0);
$LimiteMensalNew = (int) Request::Do_POST("LimiteMensalNew", 0);
$LimiteMensal = (int) Request::Do_POST("LimiteMensal", 0);
$acao = (string) Request::Do_POST('acao', null);

switch ($acao) {
    case "reset":
        break;
    case "z":
        $IsOK = false;
        $sqlN = "UPDATE users SET balance = 0 WHERE id = {$pku};";
        $conn = new Conexao();
        $conn->sql = $sqlN;
        if ($conn->updateQuery()) :
            $IsOK = true;
        endif;
        break;
    case "a":
        if ($idUQ >= 1) :
            $IsOK = false;
            $resutado = ($LimiteAtual > 0) ? $LimiteAtual + $LimiteNAdd : $LimiteNAdd; //idu
            $resutadoII = (int) $limite_disponivel - $LimiteNAdd; //iduq
            $utilFunc = new functionUtil();
            $sqlArray = array(
                0 => "UPDATE users SET balance = {$resutado} WHERE id = {$pku};"
                , 1 => "UPDATE users SET balance = {$resutadoII} WHERE id = {$idUQ};"
            );
            $IsOK = $utilFunc->updateQuery2Array($sqlArray);
        else :
            $IsOK = false;
            $resutado = (int) $LimiteAtual + $LimiteNAdd;
            $sqlN = "UPDATE users SET balance = {$resutado} WHERE id = {$pku};";
            $conn = new Conexao();
            $conn->sql = $sqlN;
            if ($conn->updateQuery()) :
                $IsOK = true;
            endif;
        endif;
        break;
    case "b":
        //buscar limite de cota usuario selecionado
        if ($idUQ > 0) :
            $conn->sql = $sqlR->sqlVerLimiteUsuarioBalance($idUQ);
        else :
            $conn->sql = $sqlR->sqlVerLimiteGrupoBalance($idG);
        endif;
        $ArrayUser = $conn->fetchArrayAssoc();
        foreach ($ArrayUser as $v) :
            $dados['userLimite'][] = ["balance" => (int) $v["balance"]];
        endforeach;
        break;
    case "r":
        $IsOK = false;
        $sqlArray = array(
            0 => "UPDATE users SET balance = 0 WHERE id = {$pku};"
            , 1 => "DELETE FROM groupsmembers WHERE groupid = {$idG} and userid = {$pku};"
        );
        $utilFunc = new functionUtil();
        $IsOK = $utilFunc->updateQuery2Array($sqlArray);
        break;
    case "alm":
        $IsOK = false;
        $sqlN = "UPDATE users SET limitmonth = {$LimiteMensalNew} WHERE id = {$pku};";
        $conn = new Conexao();
        $conn->sql = $sqlN;
        if ($conn->updateQuery()) :
            $IsOK = true;
        endif;
        break;
    case "rl":
        $IsOK = false;
        $sqlN = "UPDATE users SET balance = {$LimiteMensal} WHERE id = {$pku};";
        $conn = new Conexao();
        $conn->sql = $sqlN;
        if ($conn->updateQuery()) :
            $IsOK = true;
        endif;
        break;
    default:
        break;
}

$dados['info'] = [
    'row' => $row, 'idU' => $idU, 'idUQ' => $idUQ, 'idG' => $idG, 'limiteNAdd' => $LimiteNAdd, 'LimiteAtual' => $LimiteAtual, 'isok' => $IsOK, 'resutado' => $resutado
];
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
