<?php

/**
 * Description of DaoBillingcodes
 *
 * @author abilio.jose
 */
class DaoBillingcodes {

    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    //billingcodes - 'id', 'billingcode', 'description', 'balance', 'pagecounter'

    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "billingcodes";
    }

    public function inserir(Billingcodes $obj) {
        $dado = array();
        $coluna = null; //array();
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = array('b.id', 'b.billingcode', 'b.description', 'b.balance', 'b.pagecounter');
        $nomeTabelas = array("b" => "billingcodes");
        $condicoes = array();
        $this->dao->arrayTable = $nomeTabelas;
    //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
//            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(1, "../../controle/cad_OBJ.php", 7,"");
        } else {
            return null;
        }
    }

    public function selecionar(Billingcodes $obj) {
        $camposTabelas = array();
        $nomeTabelas = array("b" => "billingcodes");
        $condicoes = array();
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $ob->setId($d->dado[0]);
        } else {
            
        }
        return $ob;
    }

    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array();
        $condicoes = NULL;
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
        if ($d != null) {
            $Id = $d->dado[0];
        } else {
            $Id = 0;
        }
        return $Id;
    }

    public function alterar(Billingcodes $obj) {
        $dado = array();
        $camposTabelas = array();
        $where = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) {
        $this->dao->arrayTable = array("b" => "billingcodes");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Billingcodes $obj) {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
