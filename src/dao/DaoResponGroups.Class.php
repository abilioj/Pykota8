<?php

/**
 * Description of DaoResponGroups
 *
 * @author abilio.jose
 */
class DaoResponGroups {

    private $dao;
    private $colunas;
    private $colunasAS;

    // respongroups - 'id_user', 'id_user_res', 'id_group'
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "respongroups";
        $this->dao->arrayTable = array("r" => "respongroups");
        $this->colunas = array('id_user', 'id_user_res', 'id_group');
        $this->colunasAS = array('r.id_user', 'r.id_user_res', 'r.id_group');
    }

    public function inserir(ResponGroups $obj) {
        $dado = array($obj->getId_user(), $obj->getId_user_res(), $obj->getId_group());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar(int $idU, int $idg) {
        $camposTabelas = array("u.username", "r.id_user");
        $nomeTabelas = array("r" => "respongroups"); //, "u" => "users"
        $condicoes = ($idg > 0) ? array("r.id_group = " . $idg . "", "r.id_user_res = " . $idU . "") : null;
        $this->dao->arrayTable = $nomeTabelas;
        $this->dao->conditionsLeftJoin = array("left join users u on r.id_user=u.id", "left join groups g on r.id_group=g.id", "left join \"Cotas_User\" cu on r.id_group = cu.pkgroup");
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
//            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(1, "../../Controle/.php", 0, "");
        } else {
            return null;
        }
    }

    public function selecionar(ResponGroups $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("r" => "respongroups");
        $condicoes = array("id_user = " . $obj->getId_user(), "id_group = " . $obj->getId_group());
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj = new ResponGroups($d->dado[0], $d->dado[1], $d->dado[0]);
        } else {
            $obj = new ResponGroups(0, 0, 0);
        }
        return $obj;
    }

    public function buscarResponsavel(ResponGroups $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("r" => "respongroups");
        $condicoes = array("id_user = " . $obj->getId_user());
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "r.id_user", "DESC", 1, null, null);
        if ($d != null) {
            $obj = new ResponGroups($d->dado[0], $d->dado[1], $d->dado[0]);
        } else {
            $obj = new ResponGroups(0, 0, 0);
        }
        return $obj;
    }

    /* public function PegarUltimoId() {
      $camposTabelas = array();
      $nomeTabelas = array();
      $condicoes = NULL;
      $this->dao->table = $nomeTabelas;
      //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
      $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
      if ($d != null) {
      $Id = $d->dado[0];
      } else {
      $Id = 0;
      }
      return $Id;
      } */

    /* public function alterar(ResponGroups $obj) {
      $dado = array();
      $camposTabelas = array();
      $where = "";
      if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
      return true;
      } else {
      return false;
      }
      } */

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) {
        $this->dao->table = array("r" => "respongroups");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(ResponGroups $obj): bool {
        $where = array("id_user = " . $obj->getId_user() . " and id_group = " . $obj->getId_group() . "");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
