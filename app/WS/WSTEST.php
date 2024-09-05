<?php

require '../../vendor/autoload.php';

header("Content-Type: application/json; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
//Accept, Content-Type, X-Request-With, X-Requested-By or Content-Type, Authorization, X-Requested-With
header('Access-Control-Allow-Headers: Accept, Content-Type, X-Request-With, X-Requested-By');
header('Access-Control-Allow-Credentials: true');

//variavel Class
$daoAG = new DaoArrayGeneric();

//variavel 
$sql_tb = '';
$idUA = Request::Do_POST("idUA", 0);
$idU = Request::Do_POST("idU", 0);
$idG = Request::Do_POST("idg", 0);
$opS = Request::Do_POST("op", 0);
$result = null; 
$dados = null;
$acao = Request::Do_GET('acao', null);

$ArrayUser = (array) $daoAG->Array_User();
$ArrayPrinters = (array) $daoAG->Array_Printers();
$ArrayGroup = (array) $daoAG->Array_Groups($idU, $opS);
$ArrayUsuarioDeAcesso = (array) $daoAG->Array_UsuarioDeAcesso();

foreach ($ArrayGroup as $v):
    $dados['group'][]=["id" => $v["id"],"text" => $v["value"]];
endforeach;

foreach ($ArrayPrinters as $v):
    $dados['printers'][]=["id" => $v["id"],"text" => $v["value"]."<".$v["desc"].">"];
endforeach;

foreach ($ArrayUser as $v):
    $dados['users'][]=["id" => $v["id"],"text" => $v["value"]];
endforeach;

foreach ($ArrayUsuarioDeAcesso as $v):
    $dados['useracess'][]=["id" => $v["id"],"text" => $v["value"]];
endforeach;

/*
*/
//echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);