<?php

ini_set('default_charset', 'UTF-8');
require '../../vendor/autoload.php';

$conn = new Conexao();

//variavel Class
$sqlR = new SqlRules();

//variavel 
$sql_tb = '';
$row = 0;
$IsOK = 0;
$conditions = null;
$arrayWhere = null;
$resuDefat = '2022';
$dados = null;
$ano = (string) Request::Do_REQUEST('ano', $resuDefat);

$sql_tb = $sqlR->sqlEstatisticaMesal($ano);
$conn->sql = $sql_tb;

$result = $conn->fetchArrayAssoc();
$row = $conn->linhasPesquisadas("select");
if ($result != null):
    foreach ($result as $r):
        $dados["data"][] = array('jan'=>$r[0],'fev'=>$r[1],'mar'=>$r[2],'abr'=>$r[3]
        ,'mai'=>$r[4],'jun'=>$r[5],'jul'=>$r[6],'ago'=>$r[7]
        ,'set'=>$r[8],'out'=>$r[9],'nov'=>$r[10],'dez'=>$r[11]);
    endforeach;
else:
    $dados["data"] = null;
endif;
$dados['info'] = ['row' => $row, 'isOK' => $IsOK];

//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
