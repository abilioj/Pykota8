<?php

require './config_json.php';

//Classes de utilização e Config 
$contWS = new ControleWS();
$conn = new Conexao();
$sqlR = new SqlRules();

//variavel 
$sql_tb = '';
$row = 0;
$IsOK = false;
$arrayWhere = null;
$result = null;
$data = null;
$dados = null; //&idg=6&du-264&idp=16
$acao = Request::Do_REQUEST("acao", $result);
$idu = (int) Request::Do_REQUEST("idu", 0);
$softlimit = (int) Request::Do_REQUEST('softlimit', 0);

switch ($acao):
    case 's':
        break;
    case 'a':
        $sql_tb = $sqlR->sqlAlterarCotarUserBalance($softlimit, $idu);
        $conn->sql = $sql_tb;
        if ($conn->updateQuery()):
            $row = $conn->getNumrows();
            $IsOK = true;
        else:
            $IsOK = false;
        endif;
        break;
    case 'b':
        break;
    default :
        break;
endswitch;

$dados["response"][] = array('row' => $row, 'isOK' => $IsOK);
//echo json_encode($data, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($data,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
