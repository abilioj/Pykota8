<?php

/**
 * Description of DaoCotasUser
 *
 * @author abilio.jose
 */
class DaoCotasUser {

    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    //Cotas_User - "pkuser", "\"LimiteSetor\"", "pkgroup" 
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "\"Cotas_User\"";
        $this->colunas = array("pkuser", "\"LimiteSetor\"", "pkgroup");
        $this->colunasAS = array("co.pkuser", "\"co.LimiteSetor\"", "co.pkgroup");
    }

    public function inserir(CotasUser $obj) {
        $dado = array($obj->getPkuser(),$obj->getLimiteSetor(),$obj->getPkgroup());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = array("co.pkuser", "\"co.LimiteSetor\"", "co.pkgroup");
        $nomeTabelas = array("co" => "\"Cotas_User\"");
        $condicoes = null; //
        // array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(2, "../../controle/cad_OBJ.php", 7, "");
        } else {
            return null;
        }
    }

    public function selecionar(CotasUser $obj) {
        $conn = new Conexao();
        $camposTabelas = array("co.pkuser", "co.LimiteSetor", "co.pkgroup");
        $conn->sql = "SELECT pkuser, \"LimiteSetor\", pkgroup FROM \"Cotas_User\" WHERE pkuser = {$obj->getPkuser()} and pkgroup = {$obj->getPkgroup()} ;";
        $arrayDados = (array) $conn->montaArrayPesquisa();
        if ($arrayDados != null) {
            $objmonta = new MontaDados();
            $objmonta->colunas = $camposTabelas;
            $objmonta->dados = $arrayDados;
            $d = $objmonta->pegaDados();
            $ob = new CotasUser($d->dado[0], $d->dado[1], $d->dado[2]);
        } else {
            $ob = new CotasUser(0, 0, 0);
        }
        return $ob;
    }

    public function DataContaUser(CotasUser $obj) : objGeneric {
        $arrayDados = array();
        $objG = new objGeneric();
        $conn = new Conexao();
        $camposTabelas = array("g.groupname", "u.username", "cu.LimiteSetor");
        $conn->sql = "Select g.groupname, u.username, \"LimiteSetor\" from \"Cotas_User\" as cu,groups as g, users as u where cu.pkgroup=g.id and cu.pkuser = u.id and u.id = {$obj->getPkuser()};";
        $arrayDados = (array) $conn->montaArrayPesquisa();
        if ($arrayDados != null) {
            $objmonta = new MontaDados();
            $objmonta->colunas = $camposTabelas;
            $objmonta->dados = $arrayDados;
            $d = $objmonta->pegaDados();
            $objG->setCampoI($d->dado[0]);
            $objG->setCampoII($d->dado[1]);
            $objG->setCampoIII($d->dado[2]);
        } else {
            $objG->setCampoI(0);
        }
        return $objG;
    }

    public function selectContasUsers(CotasUser $obj) : array {
        $arrayDados = array();
        $conn = new Conexao();
        $camposTabelas = array("co.pkuser", "co.LimiteSetor", "co.pkgroup");
        $conn->sql = "SELECT pkuser, \"LimiteSetor\", pkgroup FROM \"Cotas_User\" WHERE pkuser = {$obj->getPkuser()} ;";
        $arrayDados = (array) $conn->montaArrayPesquisa();
        return $arrayDados;
    }

    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array("co" => "Cotas_User");
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

    public function alterar(CotasUser $obj) {
        $dado = array($obj->getLimiteSetor());
        $camposTabelas = array("\"LimiteSetor\"");
        $where = "pkuser = " . $obj->getPkuser() . " and pkgroup = " . $obj->getPkgroup() . " ";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function alterarUsu(CotasUser $obj, $idAtual) {
        $dado = array($obj->getPkuser(),$obj->getLimiteSetor());
        $camposTabelas = array("pkuser","\"LimiteSetor\"");
        $where = "pkuser = " . $idAtual . " and pkgroup = " . $obj->getPkgroup() . " ";
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
        $this->dao->arrayTable = array("co" => "Cotas_User");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(CotasUser $obj) {
        $where = array("pkuser = " . $obj->getPkuser() . " and pkgroup = " . $obj->getPkgroup() . " ");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
