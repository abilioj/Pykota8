<?php
/**
 * Description of DaoLogin
 *
 * @author abilio.jose
 */
class DaoLogin {
    
    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;
    
    //login - "id","login","senha","email","cpf","nivel","status","pkgroup"
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "login";
        $this->colunas = array("id","login","senha","email","cpf","nivel","status","pkgroup");
        $this->colunasAS = array("l.id","l.login","l.senha","l.email","l.cpf","l.nivel","l.status","l.pkgroup");
    }

    public function inserir(Login $obj) {
        $dado = array($obj->getLogin(),$obj->getSenha(),$obj->getEmail(),$obj->getCpf(),$obj->getNivel(),$obj->getStatus(),$obj->getPkgroup());
        $coluna = array("login","senha","email","cpf","nivel","status","pkgroup");
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = array("l.id","l.login","l.senha","l.email","l.cpf","l.nivel","l.pkgroup");
        $nomeTabelas = array("l" => "login");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;;
            return $obMontaDados->deListar(2, "../../controle/cad_Login.php", 7, "");
        } else {
            return null;
        }
    }

    public function selecionar(Login $obj) {
        $camposTabelas = array("l.id","l.login","l.senha","l.email","l.cpf","l.nivel","l.pkgroup","l.status");
        $nomeTabelas = array("l" => "login");
        $condicoes = array("l.id = " . $obj->getId() . " ");
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, 1, null, null);
        if ($d != null) {
            $obj->setId($d->dado[0]);
            $obj->setLogin($d->dado[1]);
            $obj->setSenha($d->dado[2]);
            $obj->setEmail($d->dado[3]);
            $obj->setCpf($d->dado[4]);
            $obj->setNivel($d->dado[5]);
            $obj->setPkgroup($d->dado[6]);
            $obj->setStatus($d->dado[7]);
        } else {
            $obj->setId(0);
        }
        return $obj;
    }

    public function login (Login $obj) {
        $camposTabelas = array("l.id","l.login","l.senha","l.email","l.cpf","l.nivel","l.pkgroup","l.status");
        //$nomeTabelas = array("l" => "login");
        //$condicoes = array("l.login = '" . $obj->getLogin() . "' ");
        //$this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        //$d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, 1, null, null);
        $sql = "SELECT l.id, l.login, l.senha, l.email, l.cpf, l.nivel, l.pkgroup, l.status FROM login AS l WHERE l.login = 'abilioj'   LIMIT 1 ;";
        $conn = new Conexao();
        $conn->sql = $sql;
        $arrayDados = $conn->montaArrayPesquisa();
        $d = new Dados();
        if ($arrayDados != null) {
            $objmonta = new MontaDados();
            $objmonta->colunas = $camposTabelas;
            $objmonta->dados = $arrayDados;
            $d = $objmonta->pegaDados($d);
            $obj->setId($d->dado[0]);
            $obj->setLogin($d->dado[1]);
            $obj->setSenha($d->dado[2]);
            $obj->setEmail($d->dado[3]);
            $obj->setCpf($d->dado[4]);
            $obj->setNivel($d->dado[5]);
            $obj->setPkgroup($d->dado[6]);
            $obj->setStatus($d->dado[7]);
        } else {
            $obj->setId(0);
        }
        return $obj;
    }
    
    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array();
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

    public function alterar(Login $obj) {
        $dado = array($obj->getLogin(),$obj->getSenha(),$obj->getEmail(),$obj->getCpf(),$obj->getNivel(),$obj->getStatus(),$obj->getPkgroup());
        $camposTabelas = array("login","senha","email","cpf","nivel","status","pkgroup");
        $where = "id = " . $obj->getId() . " ";
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
        $this->dao->arrayTable = array("l" => "login");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Login $obj) {
        $where = array("id = " . $obj->getId() . " ");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}
