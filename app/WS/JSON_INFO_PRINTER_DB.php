<?php

require './config_json.php';

//Classes de utilização
$Service->Default_charset();
$Service->Error_Reporting();

//variavel Class
$conn = new Conexao();
$dao = new DaoIPPrinter();
$toSNMP = new ToSNMP();

//variavel 
$faix_ip = "10.1.0.";
$intTempo = 2000;
$intTemtativa = 2;
$name = "";
$typePrint = 0;
$result = null;

$arrayDados = null;
$array = null;
$acao = Request::Do_GET('acao', 'b');

for ($i = 1; $i <= 19; $i++) {
    $ip = (string) $faix_ip . $i;
    $name = $dao->returnNome($ip);
    if ($i != 1 && $i != 12 && $i != 15 && $i != 16 && $i != 9 && $i != 2):
        try {
            $session = new SNMP(SNMP::VERSION_1, $ip, 'public',$intTempo,$intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                , TrataMsgSMNP::trataRetorno(@$session->get($toSNMP->getOIDS_SNMP("modelo", 1)))
                , TrataMsgSMNP::trataStatusBD(@$session->get($toSNMP->getOIDS_SNMP("status", 1)))
                , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno(@$session->get($toSNMP->getOIDS_SNMP("toner", 1))))
                , '10.1.0.' . $i . ''
            );
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', $session->getError(), '', $ip);
        } finally {
            $session->close();
            unset($session);
        }
    endif;
    if ($i == 2 || $i == 9 || $i == 16):
        try {
            $session = new SNMP(SNMP::VERSION_1, $ip, 'public',$intTempo,$intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                    , TrataMsgSMNP::trataRetorno($session->get($toSNMP->getOIDS_SNMP("modelo", 2)))
                    , TrataMsgSMNP::trataStatusBD($session->get($toSNMP->getOIDS_SNMP("status", 2)))
                    , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno($session->get($toSNMP->getOIDS_SNMP("toner", 2))))
                    , $ip);
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', TrataMsgSMNP::trataRetorno($session->getError()), '', $ip);
        } finally {
            $session->close();
            unset($session);
        }
    endif;
}
//echo json_encode($arrayDados, JSON_PRETTY_PRINT);
//echo '<pre>' . json_encode($arrayDados, JSON_PRETTY_PRINT) . '</pre>';
echo json_encode($arrayDados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
