<?php

/**
 * Description of TrataMsgSMNP
 * Trata mensagem de retorno do protocolo SNMP
 * @author abilio.jose
* @version 0.1 
* @copyright  GPL © 2022, HEANA. 
* @access public  
* @package app/Rules
 */
class TrataMsgSMNP {
    
    private static function trataHeadString($stn): string {
        $stn = preg_replace('/\n/', "", $stn);
        $stn = preg_replace('/\"/', "", $stn);
        $stn = ToString::TrocarCaracte('STRING:', '', $stn);
        $stn = str_replace(['\n','\r'], '', $stn);
        return $stn;
    }

    public static function trataRetorno($stn): string {
        $stn = ToString::TrocarCaracte('"', '', $stn);
        $stn = ToString::TrocarCaracte('STRING:', '', $stn);
        $stn = ToString::TrocarCaracte('INTEGER:', '', $stn);
        $stn = ToString::TrocarCaracte('Ready', 'Preparar', $stn);
        $stn = ToString::TrocarCaracte('Not Detected: Input Tray', 'Não detectado: bandeja de entrada', $stn);
        $stn = ToString::TrocarCaracte('No Paper: Tray 1', 'Sem papel: Bandeja 1', $stn);
        $stn = ToString::TrocarCaracte('No Paper: Tray 2', 'Sem papel: Bandeja 2', $stn);
        $stn = ToString::TrocarCaracte('Low: Toner', 'Baixo: Toner', $stn);
        $stn = ToString::TrocarCaracte('Not Detected: Tray 1', 'Não detectado: Bandeja 1', $stn);
        $stn = ToString::TrocarCaracte('Not Detected: Tray 2', 'Não detectado: Bandeja 2', $stn);
        $stn = ToString::TrocarCaracte('Energy Saver Mode', 'Modo de economia', $stn);
        $stn = ToString::TrocarCaracte('Paper Misfeed: Input Tray', 'Encravamento de papel: Bandeja de entrada', $stn);
        $stn = ToString::TrocarCaracte('Nearly Full: Waste Toner', 'Quase cheio: Resíduos de toner', $stn);
        $stn = ToString::TrocarCaracte('Printing', 'A impressão está a ser processada.', $stn);
        $stn = ToString::TrocarCaracte('Modo de economia de energia', 'Modo de economia', $stn);
        $stn = ToString::TrocarCaracte('panel off mode', 'modo de painel desligado', $stn);
        $stn = ToString::TrocarCaracte('Toner de fornecedor independente', 'Toner não reconhcido', $stn);
        $stn = ToString::TrocarCaracte('Near Replacing: Drum Unit', 'Quase a substituir: unidade de tambor', $stn);
        $stn = ToString::TrocarCaracte('No response from', 'Sem resposta de', $stn);
        $stn = ToString::TrocarCaracte('Empty: Cyan Toner', 'Toner ciano Vazio', $stn);
        $stn = ToString::TrocarCaracte('Warming Up...', 'Aquecendo', $stn);
        // $stn = ToString::TrocarCaracte('','',$stn);
        return (string) trim($stn);
    }

    public static function trataRetornoNivelToner($stn): string {
        $stn = ToString::TrocarCaracte(' ', '', $stn);
        $stn = ToString::TrocarCaracte('"', '', $stn);
        $stn = ToString::TrocarCaracte('STRING:', '', $stn);
        $stn = ToString::TrocarCaracte('INTEGER:', '', $stn);
        $stn = ((int) $stn < 0) ? 0 : $stn;
        return (string) $stn;
    }

    public static function trataRetornoLINKpRINTE($stn): string {
        $stn = ToString::TrocarCaracte(' ', '', $stn);
        $stn = ToString::TrocarCaracte('"', '', $stn);
        $stn = ToString::TrocarCaracte('STRING:', '', $stn);
        $stn = ToString::TrocarCaracte('INTEGER:', '', $stn);
        $stn = ToString::TrocarCaracte('/System/joblog', '', $stn);
        $stn = ((int) $stn < 0) ? 0 : $stn;
        return (string) $stn;
    }

    public static function trataStatus($stn): string {
        $stn = preg_replace('/\n/', "", $stn);
        $stn = preg_replace('/\"/', "", $stn);
        $stn = ToString::TrocarCaracte('STRING:', '', $stn);
        $stnRet = "";
        $class = "text";
        switch ($stn):
            case 'Hex- 4D 6F 64 6F 20 64 65 20 50 6F 75 70 61 6E E7 61 20 64 65 20 45 6E 65 72 67 69 61':
                $stnRet = "Modo de economia";
                break;
            case '4D 6F 64 6F 20 64 65 20 50 6F 75 70 61 6E E7 61 20 64 65 20 45 6E 65 72 67 69 61':
                $stnRet = "Modo de economia";
                break;
            case 'Hex- 46 61 6C 68 61 20 64 65 20 61 6C 69 6D 65 6E 74 61 E7 E3 6F 20 64 65 20 70 61 70 65 6C 3A 20 55 6E 69 64 61 64 65 20 64 75 70 6C 65 78':
                $stnRet = "Falha de alimentação de papel: Unidade duplex";
                break;
            case 'Hex- 50 72 F3 78 69 6D 6F 20 64 65 20 73 75 62 73 74 69 74 75 69 E7 E3 6F 3A 20 55 6E 69 64 61 64 65 20 64 65 20 74 61 6D 62 6F 72':
                $stnRet = "Próximo de substituição: Unidade de tambor";
                break;
            case 'Hex- 46 61 6C 68 61 20 64 65 20 61 6C 69 6D 65 6E 74 61 E7 E3 6F 20 64 65 20 70 61 70 65 6C 3A 20 49 6E 74 65 72 6E 61 2F 53 61 ED 64 61':
                $stnRet = "Falha de alimentação de papel: Interna/Saída";
                break;
            case 'Hex- 46 61 6C 68 61 20 64 65 20 61 6C 69 6D 65 6E 74 61 E7 E3 6F 20 64':
                $stnRet = "Falha de alimentação de papel: Interna/Saída";
                break;
            case 'Hex- 4E E3 6F 20 64 65 74 65 63 74 61 64 6F 3A 20 42 61 6E 64 65 6A 61 20 31':
                $stnRet = "Não detectado: Bandeja 1";
                break;
            case 'Hex- 43 68 61 6D 61 72 20 63 65 6E 74 72 6F 20 64 65 20 6D 61 6E 75 74 65 6E E7 E3 6F 3A 53 43 35 34 32 2D 31':
                $stnRet = "Chamar centro de manutençao: SC542-1";
                break;
            case 'Hex- 43 68 61 6D 61 72 20 63 65 6E 74 72 6F 20 64 65 20 6D 61 6E 75 74 65 6E E7 E3 6F 3A 53 43 33 36 34':
                $stnRet = "Chamar centro de manutençao: SC364";
                break;
            case 'Hex- 4E E3 6F 20 64 65 74 65 63 74 61 64 6F 3A 20 42 61 6E 64 65 6A 61 20 64 65 20 65 6E 74 72 61 64 61':
                $stnRet = "Não detectado: Bandeja de entrada";
                break;
            case 'Hex- 4E E3 6F 20 63 6F 72 72 65 73 70 6F 6E 64 65 6E 74 65 3A 20 54 69 70 6F 20 64 65 20 70 61 70 65 6C':
                $stnRet = "Não correspondente: Tipo de papel";
                break;
            case 'Hex- 4E E3 6F 20 64 65 74 65 63 74 61 64 6F 3A 20 54 6F 6E 65 72 20 70 72 65 74 6F':
                $stnRet = "Não detectado: Toner preto";
                break;
            case 'Hex- 43 68 65 69 6F 3A 20 42 61 6E 64 65 6A 61 20 70 61 64 72 E3 6F':
                $stnRet = "Cheio: Bandeja padrão";
                break;
            case 'Hex- 43 68 61 6D 61 72 20 63 65 6E 74 72 6F 20 64 65 20 6D 61 6E 75 74 65 6E E7 E3 6F 3A 53 43 35 35 31':
                $stnRet = "Chamar centro de manutenção:SC551";
                break;
            case 'Hex- 4E E3 6F 20 64 65 74 65 63 74 61 64 6F 3A 20 55 6E 69 64 61 64 65 20 64 65 20 66 75 73 E3 6F':
                $stnRet = "Não detectado: Unidade de fusão";
                break;
            case 'Hex- 4D 6F 64 6F 20 61 68 6F 72 72 6F 20 64 65 20 65 6E 65 72 67 ED 61':
                $stnRet = "Modo de economia de energia";
                break;
            default :
                $stnRet = $stn;
                break;
        endswitch;

        return (string) $stnRet;
    }

    public static function trataStatusSamsung($stn): string {
        $stn = preg_replace('/\n/', "", $stn);
        $stn = preg_replace('/\"/', "", $stn);
        $stn = ToString::TrocarCaracte('STRING:', '', trim($stn));
        $stnRet = "";
        $class = "text";
        switch ($stn):
            case 'Hex- 50 61 70 65 6C 20 65 73 74 C3 A1 20 76 61 7A 69 6F 20 6E 61 20 62 61 6E 64 65 6A 61 20 31 2E 20 43 61 72 72 65 67 75 65 20 70 61 70 65 6C 2E':
                $stnRet = 'Não detectado: Bandeja 1';
                break;
            case 'Hex- 47 61 76 65 74 61 20 64 61 20 62 61 6E 64 65 6A 61 20 31 20 65 73 74 C3 A1 20 70 75 78 61 64 61 2E 20 49 6E 73 69 72 61 2E':
                $stnRet = 'Não detectado: Bandeja 1';
                break;
            case 'Hex- 50 61 70 65 6C 20 65 73 74 C3 A1 20 76 61 7A 69 6F 20 6E 61 20 62 61 6E 64 65 6A 61 20 32 2E 20 43 61 72 72 65 67 75 65 20 70 61 70 65 6C 2E':
                $stnRet = 'Sem papel: Bandeja 2.';
                break;
            case 'Hex- 47 61 76 65 74 61 20 64 61 20 62 61 6E 64 65 6A 61 20 32 20 65 73 74 C3 A1 20 70 75 78 61 64 61 2E 20 49 6E 73 69 72 61 2E':
                $stnRet = 'Gaveta da bandeja 2 está puxada';
                break;
            case 'Hex- 42 61 6E 64 65 6A 61 20 6D 75 6C 74 69 66 75 6E 63 69 6F 6E 61 6C 20 73 65 6D 20 70 61 70 65 6C 20 64 75 72 61 6E 74 65 20 61 20 69 6D 70 72 65 73 73 C3 A3 6F':
                $stnRet = 'Bandeja multifuncional sem papel durante a impressão';
                break;
            case 'Hex- 4F 20 66 75 73 6F 72 20 61 74 69 6E 67 69 75 20 73 75 61 20 76 69 64 61 20 C3 BA 74 69 6C 2E 20 53 75 62 73 74 2E 20 61 20 75 6E 69 64 2E 20 70 61 72 61 20 67 61 72 61 6E 74 69 72 20 61 20 71 75 61 6C 69 64 61 64 65 20 64 65 20 69 6D 70 72 2E':
                $stnRet = 'Fusor atingiu sua vida útil';
                break;
            default :
                $stnRet = $stn;
                break;
        endswitch;
        return $stnRet;
    }

    public static function BARprogress(int $int): string {
        $intF = $int == 0 ? 0 : $int;
        $StatusEmCor = "";
        $intFTEXT = "";
        if ($intF <= 0):
            $StatusEmCor = "progress-bar-cinsa cor-blue";
        endif;
        if ($intF > 0 && $intF <= 30):
            $StatusEmCor = "progress-bar-danger";
        endif;
        if ($intF >= 60):
            $StatusEmCor = "progress-bar-warning";
        endif;
        if ($intF > 79):
            $StatusEmCor = "progress-bar-info";
        endif;
        if ($intF >= 90):
            $StatusEmCor = "progress-bar-success";
        endif;

        // Completo se for 100
        $intFTEXT = ($intF == 100) ? "100% Completo" : $intF . "%";
        $stn = "<div class='progress'> <div class='progress-bar " . $StatusEmCor . " progress-bar-striped active' role='progressbar' ";
        $stn .= "aria-valuenow='" . $intF
                . "' aria-valuemin='0' aria-valuemax='100' style='width: "
                . $intF . "%;'>" . $intFTEXT . " </div></div>";
        return $stn;
    }

    public function atencaoStatus(string $status): string {
        return "<b class='danger'>" . $status . "</b>";
    }

    public static function trataStatusBD(string $stn) : string {
        $stn = TrataMsgSMNP::trataHeadString($stn);
        $stn = TrataMsgSMNP::trataRetorno($stn);
        $stn = (string) ToSNMP::getCod_error_hex_SNMP($stn);
        return $stn;
    }
}
