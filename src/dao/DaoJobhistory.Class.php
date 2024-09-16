<?php
/**
 * Description of DaoJobhistory
 *
 * @author abilio.jose
 */
class DaoJobhistory {

    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    //jobhistory -  "id", "jobid", "userid", "printerid", "pagecounter", "jobsizebytes", "jobsize", "jobprice", "action", "filename", "title", "copies", "options", "hostname", "md5sum", "pages", "billingcode", "precomputedjobsize", "precomputedjobprice", "jobdate"
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "jobhistory";
    }

    public function inserir(Jobhistory $obj) : bool {
        $dado = array();
        $coluna = null; //array();
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() : string|null {
        $camposTabelas = array("j.id", "j.jobid", "j.userid", "j.printerid", "j.pagecounter", "j.jobsizebytes", "j.jobsize", 
            "j.jobprice", "j.action", "j.filename", "j.title", "j.copies", "j.options", "j.hostname", "j.md5sum", "j.pages", 
            "j.billingcode", "j.precomputedjobsize", "j.precomputedjobprice", "j.jobdate");
        $nomeTabelas = array("j" => "jobhistory");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;;
            return $obMontaDados->deListar(2, "../../controle/cad_OBJ.php", 7, "");
        } else {
            return null;
        }
    }

    public function selecionar(Jobhistory $obj) : Jobhistory {
        $camposTabelas = array();
        $nomeTabelas = array("j" => "jobhistory");
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

    public function PegarUltimoId(): int {
        $camposTabelas = array();
        $nomeTabelas = array("j" => "jobhistory");
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

    public function alterar(Jobhistory $obj): bool {
        $dado = array();
        $camposTabelas = array();
        $where = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) : bool {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) : bool {
        $this->dao->arrayTable = array("j" => "jobhistory");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Jobhistory $obj): bool {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
