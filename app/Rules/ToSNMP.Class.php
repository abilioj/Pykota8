<?php

/**
 * Description of ToString
 *
 * @author abilio.jose
 */
class ToSNMP {

    private $version;
    private $host;
    private $cummunity;
    private $passwordRead;
    private $passwordWride;
    private $intTempo;
    private $intTemtativa;
    private $exceptions_enabled;
    private $instance;
    private $arrayDados;

    public function __construct() {
        
    }

    public static function getOIDS_SNMP($campo, $tipo) : string {
        $conn = new Conexao();
        $sql = new Sql("oids_snmp");
        $sql->arrayTable = array('o' => 'oids_snmp');
        $camposTabelas = array('o.snmp_oid');
        $sql->camposTabelas = $camposTabelas;
        $sql->condicoesTabela = array('o.type=' . $tipo . '', "o.name = '" . $campo . "' ");
        $conn->sql = $sql->sqlPesquisar();
        $arrayDados = $conn->montaArrayPesquisa();
        $d = new Dados();
        if ($arrayDados != null) {
            $objmonta = new MontaDados();
            $objmonta->colunas = $camposTabelas;
            $objmonta->dados = $arrayDados;
            $d = $objmonta->pegaDados();
            $d = (string) $d->dado[0];
        } else {
            $d = '';
        }
        return $d;
    }
    
    public static function getCod_error_hex_SNMP($cod)  : string {
        $conn = new Conexao();
        $sql = new Sql("");
        $sql->arrayTable = array('ceh' => 'cod_error_hexadecimal');
        $camposTabelas = array('ceh.name');
        $sql->camposTabelas = $camposTabelas;
        $sql->condicoesTabela = array("ceh.cod_error_hex='" . $cod . "' ");
        $conn->sql = $sql->sqlPesquisar();
        $arrayDados = $conn->montaArrayPesquisa();
        $d = new Dados();
        if ($arrayDados != null) {
            $objmonta = new MontaDados();
            $objmonta->colunas = $camposTabelas;
            $objmonta->dados = $arrayDados;
            $d = $objmonta->pegaDados();
            $d = (string) $d->dado[0];
        } else {
            $d = $cod;
        }
        return $d;
    }
}
