<?php
// header("Content-Type: text/html; charset=UTF-8", true);
ini_set('default_charset', 'UTF-8');
// Configura para que qualquer erro, warning ou notice do PHP seja exibido
ini_set('display_errors', 1);
error_reporting( E_ALL | E_STRICT );
//error_reporting("E_ALL & ~ E_DEPRECATED & ~ E_STRICT ou E_ALL & ~ E_NOTICE");

//define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/Pykota/');
define('ROOT', dirname(__FILE__).'/');
define('ROOT_ADMIN', ROOT.'Admin');

require ROOT.'vendor/autoload.php';

//require ROOT.'autoload.php';

//Classes de utilização
/* Class Padrao */
$Service = new ConfigServerPHP();
$ServiceGET = new GetInfoSettings();
$PHTML = new PageHTML();
$MSGobg  = new Menssagem();

/*CONFIG*/
$Service->Default_charset();
$Service->Display_errors();
//$Service->Error_Reporting();
$Service->HeadContent_type();
$Service->HeadSetLocale_Lang();
$Service->Date_timezone_set();
$ServiceGET->GETNavegadorSO();
$data = new Data();