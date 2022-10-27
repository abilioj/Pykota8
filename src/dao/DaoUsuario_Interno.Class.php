<?php

class DaoUsuario_Interno {

    private $dao;
    private $colunas;
    private $colunasAS;
    private $numrows;
    private $isOK;

    //
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "usuario_interno";
        $this->colunas = array("id_users", "id_usuario");
        $this->colunasAS = array("ui.id_usuario", "ui.id_users");
        $this->numrows = 0;
        $this->isOK = false;
    }

    public function inserir(Usuario_Interno $objUI): bool {
        $dado = array($objUI->getID_USERS(), $objUI->getID_USUARIO());
        $coluna = $this->colunas;
        $this->dao->table = "usuario_interno";
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
//        $camposTabelas = array();
//        $nomeTabelas = array();
//        $dao = new DaoFull();
//        $this->dao->arrayTable=$nomeTabelas;
//        $arrayDados = $this->dao->listar($camposTabelas, null, "", null);
//        if ($arrayDados != null) {
//            $objMontaDados = new MontaDados;
//            $objMontaDados->colunas = $camposTabelas;
//            $objMontaDados->dados = $arrayDados;
//            return $objMontaDados->deListar(2, "",7);
//        } else {
//            return null;
//        }
    }

    public function selecionar(Usuario $usu) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("ui" => "usuario_interno");
        $condicoes = array("ui.id_usuario = {$usu->getId()} ");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $objUI = new Usuario_Interno($d->dado[0], $d->dado[1]);
        } else {
            $objUI = new Usuario_Interno(0, 0);
        }
        return $objUI;
    }

    public function alterar(Usuario_Interno $objUI) {
        $dado = array($objUI->getID_USUARIO());
        $camposTabelas = array("id_users");
        $where = "id_usuario = {$objUI->getID_USUARIO()} ";
        $this->dao->table = "usuario_interno";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where): bool {
        $this->dao->arrayTable = array("ui" => "usuario_interno");
        $this->isOK = $this->dao->Verificar($where, null);
        $this->numrows = $this->dao->getNumrows();
        return $this->isOK;
    }

    public function VerificarRowTab(Usuario_Interno $obj): bool {
        return (bool) $this->isOK;
    }

    public function excluir(Usuario_Interno $objUI) {
        $where = array("id_usuario = {$objUI->getID_USUARIO()} ");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function customExcluir(Usuario $obj) {
        $sqlOBJ = new Sql('usuario_interno');
        $conn = new Conexao();
        $where = array("id_usuario = {$obj->getId()} ;");
        $sqlOBJ->condicoesTabela = $where;
        $conn->sql = $sqlOBJ->sqlexcluir();
        $sqlOBJ->tabela = "";
        $where = array("id_usuario = {$obj->getID()} ;");
        $conn->sql .= $sqlOBJ->sqlexcluir();
        if ($conn->updateQuery()):
            return true;
        else:
            return false;
        endif;
    }

    public function selecionarPeloUser() {
        $camposTabelas = array("u.id", "g.id", "ua.id_usuario", "u.username", "ua.nome_usuario", "g.groupname", "n.tipo_nivel");
        $nomeTabelas = array("u" => "users", "ua" => "usuario", "ue" => "usuario_interno", "g" => "groups", "gm" => "groupsmembers", "n" => "nivel_usuario");
        $condicoes = array("ue.id_usuario = ua.id_usuario", "ue.id_users = u.id", "gm.userid = u.id", "gm.groupid = g.id", "ua.id_nivel = n.id_nivel");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, null, null, null, null);
    }

    public function ListarDeUsuarios() {
        $camposTabelas = array("u.id", "g.id", "ua.id_usuario", "u.username", "ua.nome_usuario", "g.groupname", "n.tipo_nivel");
        $nomeTabelas = array("u" => "users", "ua" => "usuario", "ue" => "usuario_interno", "g" => "groups", "gm" => "groupsmembers", "n" => "nivel_usuario");
        $condicoes = array("ue.id_usuario = ua.id_usuario", "ue.id_users = u.id", "gm.userid = u.id", "gm.groupid = g.id", "ua.id_nivel = n.id_nivel");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(1, '', '', 0);
        } else {
            return null;
        }
    }

    public function ListarDeUsuariosViculado() {
        $camposTabelas = array('g.id','u.id','uu.login_usuario','uu.nome_usuario','g.groupname');
//        $camposTabelas = array("u.id", "ua.id_usuario", "u.username", "ua.nome_usuario", "ua.login_usuario", "na.tipo_nivel");
        $nomeTabelas = array("u" => "users");
        $condicoes = array("uu.nome_usuario IS NOT NULL");
        $condicoesLeft = array('left join usuario_interno ui on ui.id_users=u.id'
            , 'left join usuario uu on uu.id_usuario = ui.id_usuario'
            , 'left join groupsmembers gm on gm.userid = u.id '
            , 'left join groups g on g.id = gm.groupid');
        $this->dao->arrayTable = $nomeTabelas;
        $this->dao->conditionsLeftJoin = $condicoesLeft;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($arrayDados != null):
            $objMontaDados = new MontaDados;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(1, '', '', 0);
        else:
            return null;
        endif;
    }

    public function getNumrows() {
        return $this->numrows;
    }

}
