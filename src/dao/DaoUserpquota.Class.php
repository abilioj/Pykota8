<?php
/**
 * Description of DaoUserpquota
 *
 * @author abilio.jose
 */

class DaoUserpquota
{

    private int $numrow;
    private bool $isOK;
    private DaoFull $dao;
    private array $colunas;
    
    //userpquota - "id", "userid", "printerid", "lifepagecounter", "pagecounter", "softlimit", "hardlimit", "datelimit", "maxjobsize", "warncount"
    public function __construct()
    {
        $this->numrow = 0;
        $this->dao = new DaoFull();
        $this->dao->table = "userpquota";
        $this->colunas = ["userid", "printerid", "softlimit", "hardlimit"];
    }

    public function inserir(Userpquota $obj): bool
    {
        $dado = [$obj->getUserid(),$obj->getPrinterid(),$obj->getSoftlimit(),$obj->getHardlimit()];
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar(): MontaDados|string
    {
        $camposTabelas = [
            "uq.id", "uq.userid", "uq.printerid", "uq.lifepagecounter", "uq.pagecounter"
            , "uq.softlimit", "uq.hardlimit", "uq.datelimit", "uq.maxjobsize", "uq.warncount"
        ];
        $nomeTabelas = ["uq" => "userpquota"];
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados !== null) {
            $obMontaDados = new MontaDados();
            //$obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(1, "../../controle/cad_OBJ.php", 7, "");
        } else {
            return '';
        }
    }

    public function selecionar(Userpquota $obj): ?Userpquota
    {
        $camposTabelas = [
            "uq.id", "uq.userid", "uq.printerid", "uq.lifepagecounter", "uq.pagecounter"
            , "uq.softlimit", "uq.hardlimit", "uq.datelimit", "uq.maxjobsize", "uq.warncount"
        ];
        $nomeTabelas = ["uq" => "userpquota"];
        $condicoes = [""];
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d !== null) {
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
        return $obj;
    }

    public function PegarUltimoId(): int
    {
        $camposTabelas = [];
        $nomeTabelas = ["uq" => "userpquota"];
        $condicoes = NULL;
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
        if ($d !== null) {
            return $d->dado[0];
        } else {
            return 0;
        }
    }

    public function alterar(Userpquota $obj): bool
    {
        $dado = [];
        $camposTabelas = [];
        $where = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull(array $dado, array $camposTabelas, string $where): bool
    {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull(string $where): bool
    {
        $this->dao->arrayTable = ["uq" => "userpquota"];
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Userpquota $obj): bool
    {
        $where = ["id = {$obj->getId()}"];
        if ($this->dao->excluir($where, null)) {
            $this->isOK = true;
        } else {
            $this->isOK = false;
        }
        $this->numrow = $this->dao->getNumrows();
        return $this->isOK;
    }

    public function getNumrow(): int
    {
        return $this->numrow;
    }

}
