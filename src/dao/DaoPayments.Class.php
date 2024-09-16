<?php
/**
 * Description of DaoPayments
 *
 * @author abilio.jose
 */
class DaoPayments {

    private $dao;
    
    //payments - "id", "userid", "amount", "description", "date"
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->arrayTable = "payments";
    }

    public function inserir(Payments $obj) {
        $dado = array();
        $coluna = null; //array();
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = NULL;
        $nomeTabelas = array("p" => "payments");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            //$obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;;
            return $obMontaDados->deListar(1, "../../controle/cad_OBJ.php", 7, "");
        } else {
            return null;
        }
    }

    public function selecionar(Payments $obj) {
        $camposTabelas = array();
        $nomeTabelas = array("p" => "payments");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj->setId($d->dado[0]);
        } else {

        }
        return $obj;
    }

    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array("p" => "payments");
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

    public function alterar(Payments $obj) {
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
        $this->dao->arrayTable = array("p" => "payments");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Payments $obj) {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
