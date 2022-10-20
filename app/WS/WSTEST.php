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

//variavel 
$sql_tb = '';
$result = null; 
$dados = null;

//echo json_encode($dados, JSON_PRETTY_PRINT);
//echo '<pre>'.json_encode($dados,JSON_PRETTY_PRINT).'</pre>';
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);