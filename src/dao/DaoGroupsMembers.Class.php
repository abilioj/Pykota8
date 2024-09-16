<?php

/**
 * Description of GroupsMembers
 *
 * @author abilio.jose
 */
class DaoGroupsMembers {
    
    //groupsmembers - 'groupid', 'userid'
    private $dao;
    private $colunas;
    private $colunasAS;

    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "groupsmembers";
        $this->colunas = array('groupid', 'userid');
        $this->colunasAS = array('gm.groupid', 'gm.userid');
    }

    public function inserir(GroupsMembers $obj) : bool {
        $dado = array($obj->getGroupid(),$obj->getUserid());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function selecionar(GroupsMembers $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array('gm' => "groupsmembers");
        $condicoes = array('gm.userid = ' . $obj->getUserid() . '');
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj = new GroupsMembers($d->dado[0],$d->dado[1]);
        } else {
            $obj = new GroupsMembers(0, 0);
        }
        return $obj;
    }

    public function alterar(GroupsMembers $obj,int $idGroup) : bool {
        $this->dao->arrayTable = "groupsmembers";
        $dado = array($idGroup);
        $camposTabelas = array('groupid');
        $where = "userid = " . $obj->getUserid() . " AND groupid = " . $obj->getGroupid() . " ";
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
        $this->dao->arrayTable = array("gm" => "groupsmembers");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(GroupsMembers $obj) {
        $where = array("groupid = {$obj->getGroupid()}", "userid = {$obj->getUserid()}");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
