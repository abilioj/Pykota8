<?php
/**
 * Description of DaoGrouppquota
 *
 * @author abilio.jose
 */
class DaoGrouppquota {
    
    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    //grouppquota -  "id", "groupid", "printerid", "softlimit", "hardlimit", "datelimit"
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "grouppquota";
    }

    public function inserir(Grouppquota $obj) {
        $dado = array();
        $coluna = null; //array();
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = array("g.id", "g.groupid", "g.printerid", "g.softlimit", "g.hardlimit", "g.datelimit");
        $nomeTabelas = array("g" => "grouppquota");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
//            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;;
            return $obMontaDados->deListar(2, "../../controle/cad_OBJ.php", 7);
        } else {
            return null;
        }
    }

    public function selecionar(Grouppquota $obj) {
        $camposTabelas = array("g.id", "g.groupid", "g.printerid", "g.softlimit", "g.hardlimit", "g.datelimit");
        $nomeTabelas = array("g" => "grouppquota");
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
        $nomeTabelas = array("g" => "grouppquota");
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

    public function alterar(Grouppquota $obj) {
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
        $this->dao->arrayTable = array("g" => "grouppquota");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Grouppquota $obj) {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
