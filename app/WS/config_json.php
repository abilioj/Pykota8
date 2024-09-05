<?php
header("Content-Type: application/json; charset=utf-8"); 
require '../../vendor/autoload.php';

//Classes de utilização
/* Class Padrao */
$Service = new ConfigServerPHP();
$ServiceGET = new GetInfoSettings();

/*CONFIG*/
$Service->Default_charset();
$Service->Date_timezone_set();

$data = new Data();