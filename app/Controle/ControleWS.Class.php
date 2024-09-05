<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleWS
 *
 * @author abilio.jose
 */

class ControleWS {

    private $conn;
    private $sqlR;
    private $stnSql;
    public  $IsOK;
    public $row;

    function __construct() {
        $this->conn = new Conexao();
        $this->sqlR = new SqlRules();
        $this->stnSql = null;
        $this->IsOK = false;
        $this->row = 0;
    }

    public function buscarDadosUsuDeCota($paramIdu, $paramIdp) {
        $dados = null;
        $arrayWhere = array("u.id = " . $paramIdu . "", "p.id = " . $paramIdp . "");
        $this->stnSql = $this->sqlR->sqlHomeVerCota($arrayWhere);
        $this->conn->sql = $this->stnSql;
        $result = $this->conn->montaArrayPesquisa();
        $this->row = $this->conn->linhasPesquisadas("select");
        if ($result != null && $this->row > 0):
            foreach ($result as $r):
                $dados = array('pkuser' => $r['pkuser']
                    , 'pkprinter' => $r['pkprinter'], 'printername' => $r['print']
                    , 'username' => $r['usern'], 'softlimit' => $r['softl']
                    , 'hardlimit' => $r['hardl'], 'pagecounter' => $r['pagec']
                    , 'lifepagecounter' => $r['lifep']);
            endforeach;
            $this->IsOK = TRUE;
        else:
            $dados = null;
        endif;
        return $dados;
    }

}
