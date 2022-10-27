<?php

/**
 * Description of DaoArrayGeneric
 *
 * @author AJ
 * CLASS DE ALIMENTA SELECT DE FORMULARILO
 */
class DaoArrayGeneric {

    private $Array;
    private $nLinha;

    function __construct() {
        $this->Array = NULL;
    }

    //metodo de array de User
    public function Array_User() {
        $this->Array = NULL;
        $conn = new Conexao();
        $conn->sql = "select id as id, username as nome from users;";
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"], "value" => $dados["nome"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de  printers
    public function Array_Printers() {
        $this->Array = NULL;
        $conn = new Conexao();
        $conn->sql = "SELECT id as id, printername as value, description as desc FROM printers";
        $this->Array = $conn->montaArrayPesquisa();
        return $this->Array;        
    }

    //metodo de array de groups
    public function Array_Groups(int $id, int $opS) {
        $this->Array = NULL;
        $conn = new Conexao();
        if ($id == 0):
            if ($opS == 0):
                $conn->sql = "select id as id, groupname as nome from groups;";
            else:
                $conn->sql = "select g.id as id,g.groupname as nome from groups as g,\"Cotas_User\" as cu where cu.pkgroup=g.id;";
            endif;
        else:
            $conn->sql = "select g.id,g.groupname as nome from groups as g left join \"Cotas_User\" cu on cu.pkgroup=g.id where cu.pkuser={$id} ;";
        endif;
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"], "value" => $dados["nome"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de NIVEL_USUARIO
    public function Array_Nivel() {
        $this->Array = NULL;
        $conn = new Conexao();
        $conn->sql = "select ID_NIVEL as id, TIPO_NIVEL as nome from NIVEL_USUARIO;";
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"], "value" => $dados["nome"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de Usuario de acesso
    public function Array_UsuarioDeAcesso() {
        $this->Array = NULL;
        $conn = new Conexao();
        $conn->sql = "select id_usuario as id, login_usuario as nome from usuario";//nome_usuario login_usuario
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"], "value" => $dados["nome"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de usuario do grupo no modal de de altre cota
    public function Array_Users_Modal($idg, $idu, $idi) {
        $this->Array = NULL;
        $sqlR = new SqlRules();
        $conn = new Conexao();
        $conditions = array('u.id=' . $idu . '', 'p.id=' . $idi . '');
        $conn->sql = $sqlR->sqlDetalheCotasDeGrupos($idg, $conditions);
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array = array("id" => $dados["idi"], "nome" => $dados["usuario"]);
        endforeach;
        return $this->Array;
    }
    
    //metodo de array de usuario do grupo no modal de de altre cota
    public function Array_Users_Modal_Balance(int $idg) {
        $this->Array = NULL;
        $conn = new Conexao();
        $conn->sql = "select u.id as id,u.username as value from users as u left join groupsmembers gm on gm.userid=u.id where gm.groupid = {$idg} ;";
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"], "value" => $dados["value"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de reponsavel
    public function Array_Responsavel() {
        $this->Array = NULL;
        $conn = new Conexao();
        $SQLR = new SqlRules();
        $conn->sql = $SQLR->sqlSelectUsuariosResResponsavel();
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"], "value" => $dados["nome"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de 
    public function Array_() {
        $this->Array = NULL;
        $conn = new Conexao();
        $ArrayPesquisa = $conn->montaArrayPesquisa();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("id" => $dados["id"]);
        endforeach;
        return $this->Array;
    }

    public function getnLinha() {
        return $this->nLinha;
    }

}
