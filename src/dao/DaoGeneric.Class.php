<?php

/**
 * Description of DaoGeneric
 *
 * @author abilio.jose
 */
class DaoGeneric {
 
    private array $Array; 
    private SqlRules $sqlR;
    private SqlRulesRelatorios $sqlRR;
    private Conexao $conn;

    function __construct() {  
        $this->sqlR = new SqlRules();
        $this->sqlRR = new SqlRulesRelatorios();
        $this->conn = new Conexao();
    }

    //listar todo usuario com todas inmformação de cota de um deteminado usuario
    public function listContasUserFindIDUsers(CotasUser $obj) {
        $this->Array = [];
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $conn->sql = $sqlR->sqlVerGrupoFindIDgroup($obj->getPkuser());
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $r):
            $this->Array[] = array("idg" => $r["idg"], "usuario" => $r["usuario"], "grupo" => $r["grupo"], "limite" => $r["limite"]
                , "consumido" => $r["consumido"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de ContasUser - pra listar cota de cada grupo nas view. com nome de grupo,usuario resposavel e numero de cotas UNICO ADM
    public function listContasUserFindIDUsersII(int $idU, int $op) {
        $this->Array = [];
        $sqlR = new SqlRules();
        $conn = new Conexao();
        if ($op == 0):
            $conn->sql = $sqlR->sqlListContasFindIDUsers($idU);
        else:
            $conn->sql = $sqlR->sqlListContasFindIDUserIDGroups(0, $idU);
        endif;
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("idg" => $dados["idg"], "idu" => $dados["idu"], "grupo" => $dados["grupo"], "usuario" => $dados["usuario"]
                , "LimiteSetor" => $dados["LimiteSetor"]);
        endforeach;
        return $this->Array;
    }

    //listar todo usuario com todas inmformação de cota de um deteminado grupo && view ver grupo 
    public function listContasUserFindIDGroup(CotasUser $obj,int $op) {
        $this->Array = [];
        $conn = new Conexao();
        $sqlR = new SqlRules();
        switch ($op):
        case 0:
            $conn->sql = $sqlR->sqlVerGrupoFindIDgroup($obj->getPkgroup());
            break;
        case 1:
            $conn->sql = $sqlR->sqlVerGrupoFindIDgroupAll($obj->getPkgroup());
            break;
        case 3:
//            $conn->sql = $sqlR->sqlVerGrupoFindIDgroupUsers($obj->getPkgroup());
            $conn->sql = $sqlR->sqlVerGrupoFindIDgroupUsersBalance($obj->getPkgroup());
            break;
        endswitch;
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $r):
            $this->Array[] = array("id" => $r["id"]?? 0, "idu" => $r["idu"]?? 0, "idg" => $r["idg"]?? 0, "idi" => $r["idi"]?? 0, "usuario" => $r["usuario"]?? ''
                , "grupo" => $r["grupo"]?? '', "limite" => $r["limite"]?? 0, "consumido" => $r["consumido"]?? 0, "disponivel" => $r["disponivel"]?? 0, "impressora" => $r["impressora"] ?? ''
                    , "balance" => $r["balance"]?? 0, "limitmonth" => $r["limitmonth"]?? 0);
        endforeach;
        return $this->Array;
    }
    
    public function listContasUserFindIDGroupBalance(int $paramId) {
        $this->Array = [];
        $this->conn->sql = $this->sqlR->sqlVerGrupoFindIDgroupUsersBalance($paramId);
        $ArrayPesquisa = $this->conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $r):
            $this->Array[] = array(
                "idu" => $r["idu"]
                    , "usuario" => $r["usuario"]
                    , "consumido" => $r["consumido"]
                    , "balance" => $r["balance"]
                    , "limitmonth" => $r["limitmonth"]);
        endforeach;
        return $this->Array;
    }
    
    //listar todo usuario com todas inmformação de cota de um deteminado grupo && view ver grupo 
    public function listSelctUserCotas(Userpquota $obj) {
        $this->Array = [];
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $conn->sql = $sqlR->sqlSelctUserCotas($obj->getUserid(), $obj->getPrinterid());
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $r):
            $this->Array[] = array("id" => $r["id"], "idu" => $r["idu"], "idg" => $r["idg"], "idi" => $r["idi"], "usuario" => $r["usuario"]
                , "grupo" => $r["grupo"], "limite" => $r["limite"]
                , "consumido" => $r["consumido"], "disponivel" => $r["disponivel"], "impressora" => $r["impressora"]);
        endforeach;
        return $this->Array;
    }

    //listar todo usuario com todas inmformação de cota de um deteminado grupo
    public function listContasUserFindIDGroupII(CotasUser $obj) {
        $this->Array = [];
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $conn->sql = $sqlR->sqlVerGrupoFindIDgroup( $obj->getPkgroup());
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $r):
            $this->Array[] = array("idu" => $r["idu"], "idg" => $r["idg"], "usuario" => $r["usuario"], "grupo" => $r["grupo"], "limite" => $r["limite"]
                , "consumido" => $r["consumido"], "disponivel" => $r["disponivel"], "disponivelgeral" => $r["disponivelgeral"]);
        endforeach;
        return $this->Array;
    }

    //metodo de array de ContasUser - pra listar cota de cada grupo nas view. com nome de grupo,usuario resposavel e numero de cotas
    public function listContasUserFindAll() {
        $this->Array = [];
        $conn = new Conexao();
        $conn->sql = "Select g.groupname as grupo, u.username as usuario, \"LimiteSetor\", g.id as idg, u.id as idu from \"Cotas_User\" as cu,groups as g, users as u "
                . "where cu.pkgroup=g.id and cu.pkuser = u.id ;";
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("idg" => $dados["idg"], "idu" => $dados["idu"], "grupo" => $dados["grupo"], "usuario" => $dados["usuario"]
                , "LimiteSetor" => $dados["LimiteSetor"]);
        endforeach;
        return $this->Array;
    }

    public function listHistoricoUsuario($conditions): array {
        $this->Array = [];
        $this->conn->sql = $this->sqlRR->sqlHistoricoUsuario($conditions);
        $arrayPesq = $this->conn->fetchArrayAssoc();
        foreach ($arrayPesq as $col):
            $this->Array[] = array("id" => $col["id"], "nome" => $col["nome"], "impressora" => $col["impressora"]
                , "arquivo" => $col["arquivo"], "qtd_paginas" => $col["qtd_paginas"], "data" => $col["data"], "hostname" => $col["hostname"]);
        endforeach;
        return $this->Array;
    }

    //qtd_paginas
    public function getSelectsModalAlterar(int $iduq, int $idg) {
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $array = [];
        $conn->sql = $sqlR->sqlSelectModalAlterar($iduq, $idg);
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $r):
            $array = array("iduq" => $r["iduq"], "usuario" => $r["usuario"]
                , "impressora" => $r["impressora"], "limite" => $r["limite"]
            );
        endforeach;
        return $array;
    }

    //
    public function getLimiteDisponivelCotas(int $id, int $op): array {
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $array = [];
        $conn->sql = $sqlR->sqlDetalheGeraisDeGrupos($id, array());
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $dados):
            $array = array("id" => $dados["id"], "grupo" => $dados["grupo"]
                , "reponsavel" => $dados["reponsavel"], "limite" => $dados["limitesetor"]
                , "limitesetoratual" => $dados["limitesetoratual"], "consumido" => $dados["consumidoatuado"]
                , "disponivel" => $dados["disponivel"], "disponivelgeral" => $dados["disponivelgeral"]
            );
        endforeach;
        return $array;
    }
    
    //
    public function getLimiteDisponivelCotasBalance(int $id, int $op): array {
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $array = [];
        $conn->sql = $sqlR->sqlDetalheGeraisDeGruposBalance($id, array());
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $dados):
            $array = array("id" => $dados["id"], "grupo" => $dados["grupo"]
                , "reponsavel" => $dados["reponsavel"], "limite" => $dados["limitesetor"]
                , "limitesetoratual" => $dados["limitesetoratual"], "consumido" => $dados["consumidoatuado"]
                , "disponivel" => $dados["disponivel"], "disponivelgeral" => $dados["disponivelgeral"]
            );
        endforeach;
        return $array;
    }

    //
    public function printrsUsersArray(int $id): array {
        $this->Array = [];
        $conn = new Conexao();
        $sqlR = new SqlRules();
        $conn->sql = $sqlR->sqlPrintrsUsersArray($id);
        $ArrayPesquisa = $conn->fetchArrayAssoc();
        foreach ($ArrayPesquisa as $dados):
            $this->Array[] = array("idu" => $dados["idu"],"iduq" => $dados["iduq"], "idp" => $dados["idp"], "nome" => $dados["nome"]);
        endforeach;
        return $this->Array;
    }

    public function getLimiteatual(int $id): int {
        $int = 0;
        return $int;
    }

}
