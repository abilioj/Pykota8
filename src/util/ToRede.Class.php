<?php

/**
 * Description of ToRede
 *
 * @author abilio.jose
 */
class ToRede {

    private $mag;
    private $isOk;
    private $ip;

    public function __construct() {
        $this->ip = '';
        $this->isOk = false;
        $this->mag = '';
    }
    
    public function getMag() {
        return $this->mag;
    }

    public function getIsOk() {
        return $this->isOk;
    }

    public function getIp() {
        return $this->ip;
    }

    public function ping($pIP) {

        $this->ip = $pIP; // IP alvo
        $timeout_segundos = 2; // Tempo máximo de espera em segundos
        // Detecta o sistema operacional
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows: -w (milissegundos)
            $comando = "ping -n 1 -w " . escapeshellarg($timeout_segundos * 1000) . " " . escapeshellarg($this->ip);
        } else {
            // Linux/Mac: -W (segundos)
            $comando = "ping -c 1 -W " . escapeshellarg($timeout_segundos) . " " . escapeshellarg($this->ip);
        }

        exec($comando, $saida, $status);

        if ($status === 0) {
            $this->isOk = true;
            $this->mag = "Dispositivo com IP $this->ip está online!";
        } else {
            $this->isOk = false;
            $this->mag = "Dispositivo com IP $this->ip offline, bloqueado ou não respondeu em $timeout_segundos segundos.";
        }
        return $this->isOk;
    }
}
