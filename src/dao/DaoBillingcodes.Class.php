<?php

/**
 * Description of DaoBillingcodes
 *
 * @author abilio.jose
 */
class DaoBillingcodes {

    private DaoFull $dao;

    //billingcodes - 'id', 'billingcode', 'description', 'balance', 'pagecounter'

    public function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "billingcodes";
    }

    public function inserir(Billingcodes $obj): bool {
        $dado = array();
        $coluna = array(); //array();
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar(): string|null {
        $camposTabelas = array('b.id', 'b.billingcode', 'b.description', 'b.balance', 'b.pagecounter');
        $nomeTabelas = array("b" => "billingcodes");
        $condicoes = array();
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados !== null) {
            $obMontaDados = new MontaDados;
//            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(1, "../../controle/cad_OBJ.php", 7,"");
        } else {
            return null;
        }
    }

    public function selecionar(Billingcodes $obj): Billingcodes {
        $camposTabelas = array();
        $nomeTabelas = array("b" => "billingcodes");
        $condicoes = array();
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d !== null) {
            $obj->setId($d->dado[0]);
        } else {
            
        }
        return $obj;
    }

    public function PegarUltimoId(): int {
        $camposTabelas = array();
        $nomeTabelas = array();
        $condicoes = NULL;
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
        if ($d !== null) {
            $Id = $d->dado[0];
        } else {
            $Id = 0;
        }
        return $Id;
    }

    public function alterar(Billingcodes $obj): bool {
        $dado = array();
        $camposTabelas = array();
        $where = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull(array $dado, array $camposTabelas, string $where): bool {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull(string $where): bool {
        $this->dao->arrayTable = array("b" => "billingcodes");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Billingcodes $obj): bool {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
