<?php
/**
 * Description of DaoPrinters
 *
 * @author abilio.jose
 */
class DaoPrinters {

    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    //printers - "id", "printername", "description", "priceperpage", "priceperjob", "passthrough", "maxjobsize"
    /*
    printername  description priceperpage  priceperjob passthrough maxjobsize
     */
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "printers";
        $this->colunas = array("printername", "description", "priceperpage", "priceperjob", "passthrough", "maxjobsize");
        $this->colunasAS = array("p.id", "p.printername", "p.description", "p.priceperpage", "p.priceperjob", "p.passthrough", "p.maxjobsize");
        $this->colunasAS_Lista = array("p.printername", "p.description", "p.id");
    }

    public function inserir(Printers $obj): bool {
        $dado = array($obj->getPrintername(), $obj->getDescription(), $obj->getPriceperpage()
                , $obj->getPriceperjob(), $obj->getPassthrough(), $obj->getMaxjobsize());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar(): MontaDados|string {
        $camposTabelas = $this->colunasAS_Lista;
        $nomeTabelas = array("p" => "printers");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            //$obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(2, "../../controle/cad_Printers.php", 2, "");
        } else {
            return '';
        }
    }

    public function selecionar(Printers $obj): Printers {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("p" => "printers");
        $condicoes = array("p.id = " . $obj->getId());
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, NULL, NULL, null, null, false);
        if ($d != null) {
            $obj->setId($d->dado[0]);
            $obj->setPrintername($d->dado[1]);
            $obj->setDescription((string) $d->dado[2]);
            $obj->setPriceperpage($d->dado[3]);
            $obj->setPriceperjob($d->dado[4]);
            $obj->setPassthrough($d->dado[5]);
            $obj->setMaxjobsize($d->dado[6]);
        } else {
            $obj->setId(0);
        }
        return $obj;
    }

    public function PegarUltimoId(): int {
        $camposTabelas = array("p.id");
        $nomeTabelas = array("p" => "printers");
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

    public function alterar(Printers $obj) : bool {// , "passthrough" , $obj->getPassthrough()
        $dado = array($obj->getPrintername(), $obj->getDescription(), $obj->getPriceperpage()
                , $obj->getPriceperjob(), $obj->getMaxjobsize());//, "passthrough", $obj->getPassthrough()
        $camposTabelas = array("printername", "description", "priceperpage", "priceperjob", "maxjobsize");
        $where = "id = " . $obj->getId() . "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) : bool {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where): bool {
        $this->dao->arrayTable = array("p" => "printers");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Printers $obj): bool {
        $where = array("id = " . $obj->getId() . "");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
