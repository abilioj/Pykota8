<?php
/**
 * Description of DaoUsers
 *
 * @author abilio.jose
 */
class DaoUsers {
    
    //users -  'id', 'username', 'email', 'balance', 'lifetimepaid'
    //, 'limitby', 'description', 'overcharge'
    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;
    private $colunasAS_Lista_MD;

    function __construct() {
        $this->dao = new DaoFull();
        $this->colunas = array('id', 'username', 'email', 'balance'
            , 'lifetimepaid', 'limitby', 'description', 'overcharge');
        $this->colunasAS = array('u.id', 'u.username', 'u.email', 'u.balance'
            , ' u.lifetimepaid', 'u.limitby', 'u.description', 'u.overcharge','u.limitmonth');
        $this->colunasAS_Lista = array('u.username','u.email',"g.groupname", 'u.id');
    }

    public function inserir(Users $obj) {
        $dado = array(NULL,$obj->getUsername(),$obj->getEmail(),$obj->getBalance(),$obj->getLifetimepaid(),$obj->getLimitby(),$obj->getDescription(),$obj->getOvercharge());
        $coluna = $this->colunas;
        $this->dao->table = "users";
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function inserirSQL(Users $obj) {
        $conn = new Conexao();
        $conn->sql = "INSERT INTO public.users(username, email, balance, lifetimepaid, limitby, description, overcharge) VALUES ('{$obj->getUsername()}', '{$obj->getEmail()}', 0, 0, 'quota', '{$obj->getDescription()}', 1);";
        return $conn->updateQuery();
    }

    public function Listar() {
        $camposTabelas = $this->colunasAS_Lista;
        $nomeTabelas = array("u" => "users");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        $this->dao->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id','left join groups g on gm.groupid=g.id');
        $this->dao->GroupBY = array();
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "username", "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            //$obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(2, "../../controle/cad_Users.php", 2,null);
        } else {
            return null;
        }
    }

    public function ListarToFone() {
        $camposTabelas = $this->colunasAS_Lista;
        $nomeTabelas = array("u" => "users");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        $this->dao->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id','left join groups g on gm.groupid=g.id');
        $this->dao->GroupBY = array();
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "username", "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            //$obMontaDados->CampoData = array(0 => "");
            $obMontaDados->ArrayCamposOcutar = array(0 => "email", 1 => "groupname");
            $obMontaDados->colunas = $camposTabelas; 
            $obMontaDados->dados = $arrayDados;;
            return $obMontaDados->deListar(2, "../../controle/cad_Users.php", 0,null);
        } else {
            return null;
        }
    }

    public function selecionar(Users $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("u" => "users");
        $condicoes = array("u.id=".$obj->getId());
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null):
            $obj->setId($d->dado[0]);
            $obj->setUsername($d->dado[1]);
            $obj->setEmail($d->dado[2]);
            $obj->setBalance($d->dado[3]);
            $obj->setLifetimepaid($d->dado[4]);
            $obj->setLimitby($d->dado[5]);
            $obj->setDescription($d->dado[6]);
            $obj->setOvercharge($d->dado[7]);
            $obj->setLimitmonth($d->dado[8]);
        else:
            $obj->setId(0);
        endif;
        return $obj;
    }
     
    public function selecionarIdPorNome(Users $obj) {
        $camposTabelas = array("u.id");
        $nomeTabelas = array("u" => "users");
        $condicoes = array("u.username='".$obj->getUsername()."'");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null):
            $obj->setId($d->dado[0]);
        else:
            $obj->setId(0);
        endif;
        return $obj;
    }
     
    public function PegarUltimoId() {
        $camposTabelas = array();
        $nomeTabelas = array("u" => "users");
        $condicoes = NULL;
        $this->dao->table = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
        if ($d != null):
            $Id = $d->dado[0];
        else:
            $Id = 0;
        endif;
        return $Id;
    }

    public function alterar(Users $obj) {
        $dado = array($obj->getUsername(),$obj->getEmail(),$obj->getDescription(),$obj->getLimitby(),$obj->getBalance(), $obj->getLimitmonth());
        $camposTabelas = array('username', 'email', 'description', 'limitby', 'balance', 'limitmonth');
        $where = "id = " . $obj->getId();
        $this->dao->table = "users";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        $this->dao->table = "users";
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) {
        $this->dao->table = array("u" => "users");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Users $obj) {
        $where = array("id=".$obj->getId());
        $this->dao->table = "users";
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }
}
