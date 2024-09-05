<?php

require './config_json.php';

//variavel Class
$conn = new Conexao();
$dao = new DaoIPPrinter();

//variavel 
$faix_ip = "10.1.0.";
$intTempo = 4000;
$intTemtativa = 1;
$name = "";
$result = null;

//$arrayDados = null;
$array = null;
$acao = Request::Do_GET('acao', 'b');
$ip = Request::Do_GET('ip', null);

$ids_mibPrintRicoh = array(
    'modelo' => '.1.3.6.1.2.1.43.5.1.1.16.1'
    , 'status' => '.1.3.6.1.2.1.43.16.5.1.2.1.1'
    , 'ntoner' => '.1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.1'
);
$ids_mibPrintSamsung = array(
    0 => 'iso.3.6.1.2.1.25.3.2.1.3.1'
    , 1 => 'iso.3.6.1.2.1.43.16.5.1.2.1.2'
    , 2 => '.1.3.6.1.4.1.236.11.5.1.1.3.22.0'
);


if ($ip != null):
    $name = $dao->returnNome($ip);
    if ($ip != $faix_ip . '1' && $ip != $faix_ip . '12' && $ip != $faix_ip . '15' && $ip != $faix_ip . '16' && $ip != $faix_ip . '9' && $ip != $faix_ip . '2'):
        try {
            $session = new SNMP(SNMP::VERSION_1, $ip, 'public',$intTempo,$intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados = array(
                'name' => $name
                , 'modelo' => TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh['modelo']))
                , 'status' => TrataMsgSMNP::trataStatus(TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintRicoh['status'])))
                , 'toner' => TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh['ntoner']))
                , 'ip' => $ip
                , 'colour_copier_count' => TrataMsgSMNP::trataRetorno(@$session->get('1.3.6.1.4.1.367.3.2.1.2.19.5.1.9.17'))
                , 'copier_coun' => TrataMsgSMNP::trataRetorno(@$session->get('.1.3.6.1.4.1.367.3.2.1.2.19.5.1.9.3'))
                , 'colour_printer_coun' => TrataMsgSMNP::trataRetorno(@$session->get('1.3.6.1.4.1.367.3.2.1.2.19.5.1.9.60'))
                , 'printer_coun' => TrataMsgSMNP::trataRetorno(@$session->get('.1.3.6.1.4.1.367.3.2.1.2.19.5.1.9.6'))
                , 'error' => TrataMsgSMNP::trataRetorno(@$session->getError() == SNMP::ERRNO_TIMEOUT)
                , 'overall' => TrataMsgSMNP::trataRetorno(@$session->get('.1.3.6.1.4.1.367.3.2.1.2.19.5.1.9.1'))
                , 'cBlack' => TrataMsgSMNP::trataRetorno(@$session->get('1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.1'))
                , 'cCYAN' => 0//TrataMsgSMNP::trataRetorno(@$session->get('1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.2'))
                , 'cMAGENTA' => 0//TrataMsgSMNP::trataRetorno(@$session->get('1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.3'))
                , 'cYELLOW' => 0//TrataMsgSMNP::trataRetorno(@$session->get('1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.4'))
                , 'link' => TrataMsgSMNP::trataRetornoLINKpRINTE(@$session->get('.1.3.6.1.4.1.367.3.2.1.2.25.1.1.2.9'))
                , 'nomeCompleto' => TrataMsgSMNP::trataRetorno(@$session->get('.1.3.6.1.4.1.367.3.2.1.6.1.1.7.1'))
//        , 'C4' => TrataMsgSMNP::trataRetorno(@$session->get(''))
//        , 'C4' => TrataMsgSMNP::trataRetorno(@$session->get(''))
            );
        } catch (Exception $ex) {
            $arrayDados = array(
                'name' => $name
                , 'modelo' => 'sem dados'
                , 'status' => $session->getError()
                , 'toner' => ''
                , 'ip' => $ip
                , 'colour_copier_count' => ''
                , 'copier_coun' => ''
                , 'colour_printer_coun' => ''
                , 'printer_coun' => ''
                , 'error' => ''
                , 'overall' => ''
                , 'cBlack' => ''
                , 'cCYAN' => ''
                , 'cMAGENTA' => ''
                , 'cYELLOW' => ''
                , 'link' => ''
                , 'nomeCompleto' => ''
//        , 'C4' => ''))
//        , 'C4' => ''))
                );
        } finally {
            $session->close();
            unset($session);
        }
    endif;
    if($ip == $faix_ip . '2' || $ip == $faix_ip . '9' || $ip == $faix_ip . '16'):
        try {
            $session = new SNMP(SNMP::VERSION_1, $ip, 'public', $intTempo, $intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados = array(
                'name' => $name
                , 'modelo' => TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintSamsung[0]))
                , 'status' => TrataMsgSMNP::trataStatusSamsung(TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintSamsung[1])))
                , 'toner' => TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintSamsung[2]))
                , 'ip' => $ip
                , 'colour_copier_count' => ''
                , 'copier_coun' => ''
                , 'colour_printer_coun' => ''
                , 'printer_coun' => ''
                , 'error' => ''
                , 'overall' => ''
                , 'cBlack' => ''
                , 'cCYAN' => ''
                , 'cMAGENTA' => ''
                , 'cYELLOW' => ''
                , 'link' => ''
                , 'nomeCompleto' => ''
//        , 'C4' => ''))
//        , 'C4' => ''))
                );
        } catch (Exception $ex) {
            $arrayDados = array(
                'name' => $name
                , 'modelo' => 'sem dados'
                , 'status' => $session->getError()
                , 'toner' => '0'
                , 'ip' => $ip
                , 'colour_copier_count' => ''
                , 'copier_coun' => ''
                , 'colour_printer_coun' => ''
                , 'printer_coun' => ''
                , 'error' => ''
                , 'overall' => ''
                , 'cBlack' => ''
                , 'cCYAN' => ''
                , 'cMAGENTA' => ''
                , 'cYELLOW' => ''
                , 'link' => ''
                , 'nomeCompleto' => ''
//        , 'C4' => ''))
//        , 'C4' => ''))
                );
        } finally {
            $session->close();
            unset($session);
        }

    endif;
endif;

//echo json_encode($arrayDados, JSON_PRETTY_PRINT);
//echo '<pre>' . json_encode($arrayDados, JSON_PRETTY_PRINT) . '</pre>';
echo json_encode($arrayDados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
