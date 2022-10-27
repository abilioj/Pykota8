<?php
/**
 * Description of DaoUserpquota
 *
 * @author abilio.jose
 */
class DaoUserpquota {

    private $numrow;
    private $isOK;
    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;
    
    //userpquota - "id", "userid", "printerid", "lifepagecounter", "pagecounter", "softlimit", "hardlimit", "datelimit", "maxjobsize", "warncount"
    function __construct() {
        $this->numrow = 0;
        $this->dao = new DaoFull();
        $this->dao->table = "userpquota";
        $this->colunas = array("userid", "printerid", "softlimit", "hardlimit");
    }

    public function inserir(Userpquota $obj) {
        $dado = array($obj->getUserid(),$obj->getPrinterid()
                ,$obj->getSoftlimit(),$obj->getHardlimit());
//        $dado = array($obj->getUserid(),$obj->getPrinterid(),$obj->getLifepagecounter(),$obj->getPagecounter()
//                ,$obj->getSoftlimit(),$obj->getHardlimit(),$obj->getDatelimit(),$obj->getMaxjobsize(),$obj->getWarncount());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = array("uq.id", "uq.userid", "uq.printerid", "uq.lifepagecounter", "uq.pagecounter"
            , "uq.softlimit", "uq.hardlimit", "uq.datelimit", "uq.maxjobsize", "uq.warncount");
        $nomeTabelas = array("uq" => "userpquota");
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

    public function selecionar(Userpquota $obj) {
        $camposTabelas = array("uq.id", "uq.userid", "uq.printerid", "uq.lifepagecounter", "uq.pagecounter"
            , "uq.softlimit", "uq.hardlimit", "uq.datelimit", "uq.maxjobsize", "uq.warncount");
        $nomeTabelas = array("uq" => "userpquota");
        $condicoes = array("");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj = new Userpquota();
            $obj->setId($d->dado[0]);
            $obj->setUserid($d->dado[1]);
            $obj->setPrinterid($d->dado[2]);
            $obj->setLifepagecounter($d->dado[3]);
            $obj->setPagecounter($d->dado[4]);
            $obj->setSoftlimit($d->dado[5]);
            $obj->setHardlimit($d->dado[6]);
            $obj->setDatelimit($d->dado[7]);
            $obj->setMaxjobsize($d->dado[8]);
            $obj->setWarncount($d->dado[9]);
        } else {

        }
        return $ob;
    }

    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array("uq" => "userpquota");
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

    public function alterar(Userpquota $obj) {
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

    public function fucaoVerificarDefull($where) {
        $this->dao->arrayTable = array("uq" => "userpquota");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Userpquota $obj) {
        $where = array("id = {$obj->getId()}");
        if ($this->dao->excluir($where, null)) {
            $this->isOK = true;
        } else {
            $this->isOK = false;
        }
        $this->numrow = $this->dao->getNumrows();
        return $this->isOK;
    }

    function getNumrow() {
        return $this->numrow;
    }

}
