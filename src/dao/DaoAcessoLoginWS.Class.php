<?php

/**
 * Description of DaoAcessoLoginWS
 *
 * @author Abílio José
 */
class DaoAcessoLoginWS {
    //put your code here

    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "";
        $this->colunas = array();
        $this->colunasAS = array();
    }

    public function inserir(AcessoLoginWS $obj) {
        $dado = array();
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = array();
        $nomeTabelas = array();
        $condicoes = array();
        $campoData = array(0 => "");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->CampoData = $campoData;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(2, "../../controle/**.php", 8, "");
        } else {
            return null;
        }
    }

    public function selecionar(AcessoLoginWS $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("" => "");
        $condicoes = array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj->setId($d->dado[0]);
        } else {
            $obj->setId(0);
        }
        return $obj;
    }

    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array("" => "");
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

    public function alterar(AcessoLoginWS $obj) {
        $dado = array();
        $camposTabelas = array();
        $where = "";
        $this->dao->arrayTable = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        $this->dao->table = "";
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) {
        $this->dao->arrayTable = array("" => "");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(AcessoLoginWS $obj) {
        $where = array();
        $this->dao->table = "";
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
