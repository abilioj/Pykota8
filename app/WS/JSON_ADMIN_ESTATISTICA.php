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

if ($result != null):
    foreach ($result as $r):
        $dados["data"][] = array('jan'=>$r['janeiro'],'fev'=>$r['fevereiro'],'mar'=>$r['marco'],'abr'=>$r['abril']
        ,'mai'=>$r['maio'],'jun'=>$r["junho"],'jul'=>$r['julho'],'ago'=>$r['agosto']
        ,'set'=>$r['setembro'],'out'=>$r['outubro'],'nov'=>$r['novembro'],'dez'=>$r['dezembro']);
        $row++;//linhas pesquisadas
    endforeach;
else:
    $dados["data"] = null;
endif;
$dados['info'] = ['row' => $row, 'isOK' => $IsOK];

//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
