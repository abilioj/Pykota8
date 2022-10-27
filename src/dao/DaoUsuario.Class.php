<?php

class DaoUsuario {

    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;
    private $isOk;
    private $lastInsertId;

    function __construct() {
        $this->dao = new DaoFull();
        $this->isOk = false;
        $this->lastInsertId = 0;
        $this->colunas = array("id_status", "id_nivel", "nome_usuario", "login_usuario", "senha_usuario","email_usuario", "telefone_usuario", "data_cadastro_usuario", "data_alteracao_usuario","data_ultimo_login_usuario", "foto_usuario");
        $this->colunasAS = array("u.id_usuario", "u.id_status", "u.id_nivel", "u.nome_usuario", "u.login_usuario", "u.senha_usuario", "u.email_usuario", "u.foto_usuario", "u.telefone_usuario", "u.data_cadastro_usuario", "u.data_alteracao_usuario", "u.data_ultimo_login_usuario");
    }

    public function inserir(Usuario $usu) {
        $dado = array($usu->getStatus(), $usu->getNivel(), $usu->getNome(), $usu->getLogin(), $usu->getSenha(), $usu->getEmail(), $usu->getTelefone(), $usu->getDatacadastro(), $usu->getDataalteracao(), $usu->getDataultimologin(), NULL);
        $coluna = $this->colunas;
        $this->dao->table = "usuario";
        $this->isOk = $this->dao->inserir($dado, $coluna, null);
        $this->lastInsertId = $this->dao->getLastInsertId();
        if($this->isOk):
            return $this->isOk;
        else:
            return $this->isOk;
        endif;
    }

    public function Listar() {
        $camposTabelas = array("u.nome_usuario", "s.tipo_status", "n.tipo_nivel", "u.data_cadastro_usuario", "u.id_usuario");
        $nomeTabelas = array("u" => "usuario", "s" => "status_usuario", "n" => "nivel_usuario");
        $condicoes = array("s.id_status=u.id_status", "n.id_nivel=u.id_nivel");
        $campoData = array(0 => "data_cadastro_usuario");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "u.nome_usuario", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->CampoData = $campoData;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(2, "../../controle/cad_Usuario.php", 8, "");
        } else {
            return null;
        }
    }

    public function ListarToFone() {
        $camposTabelas = array("u.nome_usuario", "s.tipo_status", "n.tipo_nivel", "u.data_cadastro_usuario", "u.id_usuario");
        $nomeTabelas = array("u" => "usuario", "s" => "status_usuario", "n" => "nivel_usuario");
        $condicoes = array("s.id_status=u.id_status", "n.id_nivel=u.id_nivel");
        $campoData = array(0 => "data_cadastro_usuario");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "u.nome_usuario", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->CampoData = $campoData;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->ArrayCamposOcutar = array(0 => "tipo_status", 1 => "tipo_nivel", 2 => "data_cadastro_usuario");
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(2, "../../controle/cad_Usuario.php", 0, "");
        } else {
            return null;
        }
    }

    public function selecionar(Usuario $usu) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("u" => "usuario");
        $condicoes = array("u.id_usuario=" . $usu->getId() . "");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $usu->setId($d->dado[0]);
            $usu->setStatus($d->dado[1]);
            $usu->setNivel($d->dado[2]);
            $usu->setNome($d->dado[3]);
            $usu->setLogin($d->dado[4]);
            $usu->setSenha($d->dado[5]);
            $usu->setEmail($d->dado[6]);
            $usu->setFoto($d->dado[7]);
            $usu->setTelefone($d->dado[8]);
            $usu->setDatacadastro($d->dado[9]);
            $usu->setDataalteracao($d->dado[10]);
            $usu->setDataultimologin($d->dado[11]);
        } else {
            $usu->setId(0);
        }
        return $usu;
    }

    public function PegarUltimoId() {
        $camposTabelas = array("u.id_usuario");
        $nomeTabelas = array("u" => "usuario");
        $condicoes = NULL;
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "u.id_usuario", "DESC", 1, null, null);
        if ($d != null) {
            $Id = $d->dado[0];
        } else {
            $Id = 0;
        }
        return $Id;
    }

    public function alterar(Usuario $usu) {
        $dado = array($usu->getNome(), $usu->getNivel(), $usu->getStatus(), $usu->getEmail(), $usu->getTelefone(), $usu->getDataalteracao());
        $camposTabelas = array("nome_usuario", "id_nivel", "id_status", "email_usuario", "telefone_usuario", "data_alteracao_usuario");
        $where = "id_usuario=" . $usu->getId() . "";
        $this->dao->table = "usuario";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        $this->dao->table = "usuario";
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) {
        $this->dao->arrayTable = array("u" => "usuario");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Usuario $usu) {
        $where = array("id_usuario=" . $usu->getId() . "");
        $this->dao->table = "usuario";
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function logar(Usuario $u) {
        $usu = new Usuario;
        $camposTabelas = array("u.id_usuario", "u.id_status", "u.id_nivel", "u.login_usuario", "u.senha_usuario", "u.data_cadastro_usuario", "u.data_alteracao_usuario", "u.data_ultimo_login_usuario");
        $nomeTabelas = array("u" => "usuario");
        $condicoes = array("u.login_usuario ='" . $u->getLogin() . "'");
        $limit = 1;
        $this->dao->arrayTable = $nomeTabelas;
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, $limit, null, null);
        if ($d != null) {
            $usu->setId($d->dado[0]);
            $usu->setStatus($d->dado[1]);
            $usu->setNivel($d->dado[2]);
            $usu->setLogin($d->dado[3]);
            $usu->setSenha($d->dado[4]);
            $usu->setDatacadastro($d->dado[5]);
            $usu->setDataalteracao($d->dado[6]);
            $usu->setDataultimologin($d->dado[7]);
        } else {
            $usu->setId(0);
        }
        return $usu;
    }

}
