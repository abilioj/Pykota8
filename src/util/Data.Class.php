<?php

/**
 * Description of Data
 *
 * @author Abílio José G Ferreira
 */
class Data {

    private $DataDefat = "2092-01-31"; //0001-01-31 2092-01-31
    private $DataDefatPT_BR = "31/01/2092"; //31/01/0001 31/01/2092
    private $dataNew;
    private $years;
    private $month;
    private $day;
    private $hour;
    private $minute;
    private $second;
    private $fullTime;
    private $diff;
    private $stnMsg;

    function __construct() {
        //$this->dataNew = new DateTime(date('y-m-d H:i:s'));
        $this->day = date('d');
        $this->month = date('m');
        $this->years = date('Y');
        $this->fullTime = date("H:i:s");
        $this->diff = null;
        $this->stnMsg = '';
    }

    //1- Funcao que retorna a data atual no padrao Ingles (DD-MM-YYYY):
    // definindo padrao pt (dd/MM/YYYY)
    function data_atual() {
        $data = "$this->day/$this->month/$this->years";
        return $data;
    }

    //2- Funcao que retorna a data atual no padrao Ingles (YYYY-MM-DD):
    function data_atual_en() {
        $data = "$this->years/$this->month/$this->day";
        return $data;
    }

    function data_atualBD() {
        $data = "$this->years-$this->month-$this->day";
        return $data;
    }

    //definindo padr�o pt (dd/MM/YYYY HH:ii:ss)
    function dataEhora_atual() {
        $data = "$this->day-$this->month-$this->years $this->fullTime";
        return $data;
    }

    // definindo padr�o en (YYYY/MM/dd HH:ii:ss)
    function dataEhora_atual_en() {
        $data = "$this->years-$this->month-$this->day $this->fullTime";
        return $data;
    }

    function hora_atualHM() {
        $hora = date("H:i");
        return $hora;
    }

    function hora_atual_completa() {
        return $this->fullTime;
    }

    function valida_data($data, $tipo = "pt") {
        if ($tipo == 'pt') {
            $d = explode("/", $data);
            $this->day = $d[0];
            $this->month = $d[1];
            $this->years = $d[2];
        } else if ($tipo == 'en') {
            $d = explode("-", $data);
            $this->day = $d[2];
            $this->month = $d[1];
            $this->years = $d[0];
        }
        //usando fun��o checkdate para validar a data
        if (checkdate($this->month, $this->day, $this->years)) {
            $data = $this->years . '/' . $this->month . '/' . $this->day;
            if (
            //verificando se o ano tem 4 d�gitos
                    (strlen($this->years) != '4') ||
                    //verificando se o m�s � menor que zero
                    ($this->month <= '0') ||
                    //verificando se o m�s � maior que 12
                    ($this->month > '12') ||
                    //verificando se o dia � menor que zero
                    ($this->day <= '0') ||
                    //verificando se o dia � maior que 31
                    ($this->day > '31')
            ) {
                return false;
            }
            if (strlen($data) == 10)
                return true;
        } else {
            return false;
        }
    }

    function data_user_para_mysql($y) {
        if ($y == null)
            return $this->DataDefat;
        $data_inverter = explode("/", $y);
        $x = $data_inverter[2] . '-' . $data_inverter[1] . '-' . $data_inverter[0];
        return $x;
    }

    function data_mysql_para_user($y) {
        if ($y != '') {
            if ($y == $this->DataDefat):
                return '';
            else:
                $x = implode("/", array_reverse(explode("-", $y)));
                return $x;
            endif;
        } else {
            return '';
        }
    }

    function validaDataTime($paramData): DateTime {
        $data = null;
        if ($paramData != null):
            $data = new DateTime($paramData);
        else:
            $data = new DateTime($paramData);
        endif;
        return $data;
    }

    function data_to_form($y, $BrowserID) {
        if ($y != '') :
            if ($y == $this->DataDefat):
                return '';
            else:
                if ($BrowserID != 6):
                    return $this->data_mysql_para_user($y);
                else:
                    return $y;
                endif;
            endif;
        else:
            return '';
        endif;
    }

    function data_to_formController($y, $BrowserID, $opIDArrays) {
        if ($y != ''):
            if ($y == $this->DataDefat):
                return '';
            else:
                foreach ($opIDArrays as $n):
                    if ($n == $BrowserID):
                        if ($BrowserID == $n):
                            return $this->data_mysql_para_user($y);
                        else:
                            return $y;
                        endif;
                    endif;
                endforeach;
            endif;
        else:
            return '';
        endif;
    }

    //%y year(s), %m month(s), %d day(s), %H hour(s), %i minute(s) and %s second(s)
    //Parâmetros : $ParDataInial, $ParDataFinal
    function GetHoraDuracaoEntreDateTime($ParDataInial, $ParDataFinal) {
        //%y year(s), %m month(s), %d day(s), %H hour(s), %i minute(s) and %s second(s)
        $dataIn = new DateTime($ParDataInial);
        $dataFi = new DateTime($ParDataFinal);
        $DATA_diff = $dataIn->diff($dataFi);
        $this->hour = $DATA_diff->h;
        $this->minute = $DATA_diff->i;
        return "{$DATA_diff->y} anos, {$DATA_diff->m} meses, {$DATA_diff->d} dias e {$DATA_diff->h} Horas, {$DATA_diff->i} minutos";
    }

    //Parâmetros : $ParDataInial, $ParDataFinal
    function GetDuracaoEntreDateTime($ParDataFinal) {
//        $datatime1 = new DateTime(date('y-m-d H:i:s'));
        $datatime1 = new DateTime(date($this->dataEhora_atual_en()));
        $datatime2 = new DateTime($ParDataFinal);
        $data1 = $datatime1->format('Y-m-d H:i:s');
        $data2 = $datatime2->format('Y-m-d H:i:s');
        $this->diff = $datatime1->diff($datatime2);
        $ad1 = explode("-", $datatime1->format('Y-m-d'));
        $ad2 = explode("-", $datatime2->format('Y-m-d'));
        $ad3 = explode(":", $datatime1->format('H:i:s'));
        $ad4 = explode(":", $datatime2->format('H:i:s'));
        // en - dia 2, mes 1, ano 0 || hora 0 e minuto 1
        if ($this->diff->h > 0)://$ad3[0] <= $ad4[0] && $ad1[2] == $ad2[2] && $ad1[1] == $ad2[1] && $ad1[0] == $ad2[0]
            $this->hour = $this->diff->h + ($this->diff->days * 24);
            $this->minute = $this->diff->i;
        else:
            $this->hour = 0;
            $this->minute = $this->diff->i;
        endif;
        $this->stnMsg = "A diferença de horas entre '{$data1}' e '{$data2}', é {$this->hour} horas, {$this->minute} minuto - h {$ad3[0]}-{$ad4[0]}, M {$ad3[1]}-{$ad4[1]}";
    }

    function TransformaDataBD_ENEmAno($paramDataBD_EN): int {
        $d = explode("-", $paramDataBD_EN);
//        $dia = $d[2];
//        $mes = $d[1];
        $ano = (int) $d[0];
        return $ano;
    }

    public function addHoraData(int $ptempo): string {
        $dataNew = new DateTime($this->dataEhora_atual_en());
        $dataNew->add(new DateInterval('PT' . $ptempo . 'H'));
        return date_format($dataNew, 'Y-m-d H:i:s');
    }

    public function addMinutoData(int $ptempo): string {
        $dataNew = new DateTime($this->dataEhora_atual_en());
        $dataNew->add(new DateInterval('PT' . $ptempo . 'M'));
        return date_format($dataNew, 'Y-m-d H:i:s');
    }

    public function getDataNew() {
        return $this->dataNew;
    }

    public function getDataDefat() {
        return $this->DataDefat;
    }

    public function getDataDefatPT_BR() {
        return $this->DataDefatPT_BR;
    }

    public function getYears() {
        return $this->years;
    }

    public function getMonth() {
        return $this->month;
    }

    public function getDay() {
        return $this->day;
    }

    public function getHour() {
        return $this->hour;
    }

    public function getMinute() {
        return $this->minute;
    }

    public function getSecond() {
        return $this->second;
    }

    public function getFullTime() {
        return $this->fullTime;
    }

    public function getStnMsg() {
        return $this->stnMsg;
    }

    function getDiff() {
        return $this->diff;
    }

}
