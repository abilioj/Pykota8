<?php


ini_set('default_charset', 'UTF-8');
require './config_json.php';

//variavel Class
$daoAG = new DaoArrayGeneric();

//variavel 
$sql_tb = '';
$idUA = Request::Do_POST("idUA", 0);
$idU = Request::Do_POST("idU", 0);
$idG = (int) Request::Do_POST("idg", 0);
$opS = Request::Do_POST("op", 0);
$result = null;
$dados = null;
$acao = Request::Do_GET('acao', null);

$ArrayUser = (array) $daoAG->Array_Users_Modal_Balance($idG);

foreach ($ArrayUser as $v) :
    $dados['userS'][] = ["id" => $v["id"], "text" => $v["value"]];
endforeach;

/*
*/
//echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
