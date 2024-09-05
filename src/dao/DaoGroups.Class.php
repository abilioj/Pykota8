<?php
/**
 * Description of DaoGroups
 *
 * @author abilio.jose
 */
class DaoGroups {
    
    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;
    
    //groups - "id", "groupname", "description", "limitby"
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "groups";
        $this->colunas = array("groupname", "description", "limitby");
        $this->colunasAS = array("g.groupname", "g.description", "g.limitby", "g.id");
        $this->colunasAS_Lista = array("g.groupname", "g.description", "g.limitby","g.id");
    }

    public function inserir(Groups $obj) {
        $dado = array($obj->getGroupname(),$obj->getDescription(),$obj->getLimitby());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = $this->colunasAS_Lista;
        $nomeTabelas = array("g" => "groups");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(2, "../../controle/cad_Groups.php", 2,"");
        } else {
            return null;
        }
    }

    public function selecionar(Groups $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("g" => "groups");
        $condicoes = array("g.id = " . $obj->getId());
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
//            $obj->setId((int)$d->dado[0]);
            $obj->setGroupname((string)$d->dado[0]);
            $obj->setDescription((string)$d->dado[1]);
            $obj->setLimitby((string)$d->dado[2]);
        } else {
            $obj->setId(0);
        }
        return $obj;
    }
    
    public function PegarUltimoId() {
        $camposTabelas = array("u.id");
        $nomeTabelas = array("g" => "groups");
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

    public function alterar(Groups $obj) {
        $dado = array($obj->getGroupname(),$obj->getDescription(),$obj->getLimitby());
        $camposTabelas = array("groupname", "description", "limitby");
        $where = "id = " . $obj->getId() . ""; 
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
        $this->dao->table = array("g" => "groups");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Groups $obj) {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }
}
