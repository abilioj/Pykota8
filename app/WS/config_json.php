<?php
header("Content-Type: application/json; charset=utf-8");
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/Pykota/');

define('ROOT_FILE', dirname(__FILE__).'/');
define('ROOT_ADMIN', ROOT.'Admin');
require ROOT.'vendor/autoload.php';

//Classes de utilização
/* Class Padrao */
$Service = new ConfigServerPHP();
$ServiceGET = new GetInfoSettings();

/*CONFIG*/
$Service->Default_charset();
$Service->Date_timezone_set();

$data = new Data();