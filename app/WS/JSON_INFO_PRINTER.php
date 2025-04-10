<?php

require './config_json.php';

//Classes de utilização
$Service->Default_charset();
$Service->Error_Reporting();

//variavel Class
$conn = new Conexao();
$dao = new DaoIPPrinter();
$toRede = new ToRede();

//variavel 
$faix_ip1 = "10.1.1.";
$faix_ip = "10.1.0.";
$faix_ip11 = "10.1.11.";
$intTempo = 2000;
$intTemtativa = 3;
$name = "";
$result = null;

$arrayDados = null;
$array = null;
$acao = Request::Do_GET('acao', 'b');

$ids_mibPrintRicoh = array(
    0 => '.1.3.6.1.2.1.43.5.1.1.16.1'
    , 1 => '.1.3.6.1.2.1.43.16.5.1.2.1.1'
    , 2 => '.1.3.6.1.4.1.367.3.2.1.2.24.1.1.5.1'
);
$ids_mibPrintSamsung = array(
    0 => 'iso.3.6.1.2.1.25.3.2.1.3.1'
    , 1 => 'iso.3.6.1.2.1.43.16.5.1.2.1.2'
    , 2 => '.1.3.6.1.4.1.236.11.5.1.1.3.22.0'
    , 3 => '.1.3.6.1.2.1.43.5.1.1.17.1'
);
$ids_mibPrintHP = array(
    0 => '.1.3.6.1.4.1.11.2.4.3.5.44.0'
    , 1 => '.1.3.6.1.4.1.11.2.4.3.1.12.1.2.72'
    , 2 => '.1.3.6.1.2.1.43.11.1.1.9.1.1'
    , 3 => '.1.3.6.1.2.1.43.5.1.1.17.1'
);

for ($i = 1; $i <= 99; $i++) {
    if ($i == 5):
        $ip = (string) $faix_ip . $i;
        $status = $toRede->ping($ip);
        $name = $dao->returnNome($ip);
        try {
            $session = new SNMP(SNMP::VERSION_1, $ip, 'public', $intTempo, $intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                , TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[0]))
                , TrataMsgSMNP::trataStatus(TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[1])))
                , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[2])))
                , $ip
                , ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>'
            );
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', $session->getError(), '', $ip, ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>');
        } finally {
            $session->close();
            unset($session);
        }
    endif;
    if ($i == 21 || $i == 99):
        $ip = (string) $faix_ip11 . $i;
        $status = $toRede->ping($ip);
        $name = ($i == 99) ? 'TI Ricoh' : $dao->returnNome($ip);
        try {
            $session = new SNMP(SNMP::VERSION_1, $ip, 'public', $intTempo, $intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                , TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[0]))
                , TrataMsgSMNP::trataStatus(TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[1])))
                , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[2])))
                , $ip
                , ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>'
            );
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', $session->getError(), '', $ip, ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>');
        } finally {
            $session->close();
            unset($session);
        }
    endif;
    if ($i == 29):
        try {
            $ip = (string) $faix_ip11 . '29';
            $status = $toRede->ping($ip);
            $name = 'TI hp';
            $session = new SNMP(SNMP::VERSION_2c, $ip, 'public', $intTempo, $intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                // , TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintHP[0])) 
                , ToString::TrocarCaracte('STRING:', '', $session->get($ids_mibPrintHP[3]))
                , TrataMsgSMNP::trataStatus($session->get($ids_mibPrintHP[1]))
                , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintHP[2])))
                , $ip
                , ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>'
                );
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', TrataMsgSMNP::trataRetorno($session->getError()), TrataMsgSMNP::BARprogress((0)), $ip, ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>');
        } finally {
            $session->close();
            unset($session);
        }
    endif;
}

for ($i = 1; $i <= 22; $i++) {
    if ($i != 21 && $i != 22):
        try {
            $ip = (string) $faix_ip11 . $i;
            $status = $toRede->ping($ip);
            $name = ($i == 22) ? 'Farmacia SANSUNG' : $dao->returnNome($ip);
            $session = new SNMP(SNMP::VERSION_2c, $ip, 'public', $intTempo, $intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                // , TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintHP[0])) 
                , ToString::TrocarCaracte('STRING:', '', $session->get($ids_mibPrintHP[3]))
                , TrataMsgSMNP::trataStatus($session->get($ids_mibPrintHP[1]))
                , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintHP[2])))
                , $ip
                , ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>'    
                );
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', TrataMsgSMNP::trataRetorno($session->getError()), TrataMsgSMNP::BARprogress((0)), $ip, ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>');
        } finally {
            $session->close();
            unset($session);
        }
    endif;
    if ($i == 22):
        try {
            $ip = (string) $faix_ip11 . $i;
            $status = $toRede->ping($ip);
            $name = ($i == 22) ? 'Farmacia SANSUNG' : $dao->returnNome($ip);
            $session = new SNMP(SNMP::VERSION_2c, $ip, 'public', $intTempo, $intTemtativa);
            $session->exceptions_enabled = SNMP::ERRNO_ANY;
            $arrayDados['data'][] = array(
                $name
                // , TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintHP[0])) 
                , ToString::TrocarCaracte('STRING:', '', $session->get($ids_mibPrintSamsung[3]))
                , TrataMsgSMNP::trataStatusSamsung($session->get($ids_mibPrintSamsung[1]))
                , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno($session->get($ids_mibPrintSamsung[2])))
                , $ip
                , ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>'    
                );
        } catch (Exception $ex) {
            $arrayDados['data'][] = array($name, '', TrataMsgSMNP::trataRetorno($session->getError()), TrataMsgSMNP::BARprogress((0)), $ip, ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>');
        } finally {
            $session->close();
            unset($session);
        }
    endif;
}

try {
    $ip = "";
    $ip = (string) $faix_ip1 . '234';
    $status = $toRede->ping($ip);
    $session = new SNMP(SNMP::VERSION_1, $ip, 'public', $intTempo, $intTemtativa);
    $session->exceptions_enabled = SNMP::ERRNO_ANY;
    $arrayDados['data'][] = array(
        "Tomografia"
        , TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[0]))
        , TrataMsgSMNP::trataStatus(TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[1])))
        , TrataMsgSMNP::BARprogress(TrataMsgSMNP::trataRetorno(@$session->get($ids_mibPrintRicoh[2])))
        , $ip
        , ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>'
    );
} catch (Exception $ex) {
    $arrayDados['data'][] = array($name, '', $session->getError(), '', $ip, ($status) ? '<i class="fa fa-circle" style="color: #00a65a; font-size: 12px;"></i>':'<i class="fa fa-circle" style="color: #dd4b39; font-size: 12px;"></i>');
} finally {
    $session->close();
    unset($session);
}


//echo json_encode($arrayDados, JSON_PRETTY_PRINT);
//echo '<pre>' . json_encode($arrayDados, JSON_PRETTY_PRINT) . '</pre>';
echo json_encode($arrayDados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

// "Substituir unidade de tambor"
// Call Service Center:SC364