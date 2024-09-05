<?php
require './config_json.php';

//Classes de utilização
$Service->Default_charset();
$Service->Error_Reporting();

//variavel Class
$daoAG = new DaoArrayGeneric();
$objADU = new ADauthUser();

//variavel 
$opS = Request::Do_POST("op", 0);
$result = null; 
$dados = null;
$acao = Request::Do_GET('acao', null);

$ArrayUser = (array) $objADU->Users_Authenticate_AD('abilio.jose','ajf*3101');

// var_dump($objADU->Users_Authenticate_AD('abilio.jose','ajf*3101'));

echo json_encode($ArrayUser, JSON_PRETTY_PRINT);
//echo '<pre>' . json_encode($last_line, JSON_PRETTY_PRINT) . '</pre>';
//echo json_encode($last_line, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
