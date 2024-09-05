<?php
/**
* Biblioteca SNMP que adiciona um nível de abstração à biblioteca nativa SNMP.
* Adiciona funcionalidade para trabalhar com o módulo PicoIP. Com esta biblioteca você pode:
* 1. Pino definido para ativar / desativar;
* 2. Obtenha o status de todos os pinos.
*
* Ao fazer uma instância, você deve passar para a palavra-chave do construtor que irá
* fazer a biblioteca criar um objeto com as permissões de acesso e as propriedades necessárias.
*
* As propriedades privadas definem algumas das configurações:
* Host é o endereço IP do divece que iremos comandar.
* Duas senhas são definidas para leitura e escrita.
* A versão do protocolo snmp que usaremos é a versão 1.
*
* @author Radoslav Madjev
* @year 2016
* @ versão 1.0 beta
*
*
*/
class snmp_lib {

    private $snmpInstance;
    private $VERSION = SNMP::VERSION_1;
    private $HOST = '10.1.1.201';
    private $passwordRead = '';
    private $passwordWrite = 'private';
    private $releys = array(1 => '1.3.6.1.2.1.1.5.0', 2 => '1.3.6.1.2.1.1.4.0');
    private $allPorts = array('3' => '1.3.6.1.2.1.1.1.0');

    /**
      * Criar instância de classe nativa SNMP, com base nas ações que iremos
      * executar.
      *
      * @param string $ action
     */
    public function __construct($action) {
        if (in_array($action, array('read', 'write'))) {
            if (strcmp($action, 'read') === 0) {
                $this->_read();
            } else {
                $this->_write();
            }
        }
    }

    /**
     * Crie uma instância com permissões de leitura.
     */
    private function _read() {
        $this->snmpInstance = new SNMP($this->VERSION, $this->HOST, $this->passwordRead);
    }

    /**
     * Crie uma instância com permissões de gravação.
     */
    private function _write() {
        $this->snmpInstance = new SNMP($this->VERSION, $this->HOST, $this->passwordWrite);
    }

    /**
     * Feche a sessão SNMP.
     *
     * @return boolean
     */
    public function closeSession() {
        return $this->snmpInstance->close();
    }

    /**
     * Defina o inteiro 1 como valor do pino definido.
     */
    public function activate($relay) {
        $this->snmpInstance->set($this->releys[$relay], 'i', '1');
    }

    /**
     * Defina o inteiro 0 como o valor do pino definido.
     */
    public function deactivate($relay) {
        $this->snmpInstance->set($this->releys[$relay], 'i', '0');
    }

    /**
     * Obtenha o status do pino de todas as portas do módulo.
     *
     * @return array
     */
    public function getAllPortsStatus() {
        $allPins = array();
        foreach ($this->allPorts as $number => $port) {
            //get active pins as 8-bit integer of defined port
            $getbits = $this->snmpInstance->get($port);
            $bits = str_replace('INTEGER: ', '', $getbits);
            //get pins status
            $pinsStatus = $this->_getActivePins($bits);
            $allPins[$number] = $pinsStatus;
        }
        return $allPins;
    }

    /**
     * Faça uma operação bit a bit que determinará,
     * que são pinos ativos.
     *
     * @param int $bits
     * @return array
     */
    private function _getActivePins($bits) {
        $bitMapping = array(
            1 => 1,
            2 => 2,
            3 => 4,
            4 => 8,
            5 => 16,
            6 => 32,
            7 => 64,
            8 => 128
        );
        $pinsStatus = array();
        foreach ($bitMapping as $int => $bit) {
            if (($bits & $bit) == $bit) {
                $pinsStatus[$int] = true;
                continue;
            }
            $pinsStatus[$int] = false;
        }

        return $pinsStatus;
    }
}
/*
    - USO
 
Eu tenho um módulo que recebe solicitação SNMP e envia um comando para relés. Além disso
, estes são scripts de exemplo que usam esta lib:
Ativar script:
<?php
require_once 'snmp_lib.php';

$snmp = new snmp_lib('write');
$snmp->activate($getRelayNumber);
$snmp->closeSession();
?>

Desative o script:
<?php
require_once 'snmp_lib.php';

$snmp = new snmp_lib('write');
$snmp->deactivate($getRelayNumber);
$snmp->closeSession();
?>

Script que obtém o status de todas as portas:
<?php
require_once 'snmp_lib.php';

$snmp = new snmp_lib('read');
$getActive = $snmp->getAllPortsStatus();
?>
*/