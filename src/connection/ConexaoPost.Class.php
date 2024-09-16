<?php

use  PgSql\Connection;
use PgSql\Result;

Class ConexaoPost {

    private string $bancoDeDados;
    private string $usuario;
    private string $servidor;
    private string $senha;
    private int $porta;
    private Connection|false $conexao;
    private Result|bool $execucao;
    private int $numrows;
    private bool $isOK;
    private string $string;
    private string $error;
    public string $sql;

    function __construct() {
        $configBD = new ConfigBDClass();
        $this->bancoDeDados = $configBD->getBancoDeDados();
        $this->usuario = $configBD->getUsuario();
        $this->servidor = $configBD->getServidor();
        $this->senha = $configBD->getSenha();
        $this->porta = $configBD->getPorta();
        $this->numrows = 0;
    }

    private function conecta() : mixed {
        $this->conexao = pg_connect("host=" . $this->servidor . " port=" . $this->porta . " dbname=" . $this->bancoDeDados . " user=" . $this->usuario . " password=" . $this->senha . "");
        if ($this->conexao) {
            return $this->conexao;
        } else {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    public function executaQuery() : mixed {
        try {
            $this->conecta();
        } catch (Exception $erro) {
            return false;
        }
        pg_exec("SET NAMES 'utf8'");
        $this->execucao = pg_exec($this->sql);
        if ($this->execucao) {
            $this->desconecta();
            return $this->execucao;
        } else {
            $this->desconecta();
            return false;
        }
    }

    public function updateQuery() : mixed {
        try {
            $this->conecta();
        } catch (Exception $erro) {
            $this->error = $erro->getMessage();
        }
        pg_query($this->conexao, "BEGIN;");
        $this->execucao = pg_query($this->conexao, $this->sql);
        if ($this->execucao) {
            pg_exec($this->conexao, "COMMIT;");
            $this->desconecta();
            return $this->execucao;
        } else {
            pg_exec($this->conexao, "ROLLBACK;");
            $this->desconecta();
            return false;
        }
    }

    // Salva no array $line resultados retornados
    function fetchArrayAssoc() : array|null {
        $execucao = $this->executaQuery();
        $line = pg_fetch_array($execucao);
        return $line;
    }

    public function montaArrayPesquisa() : array|null  {
        $arrayDados = null;
        $execucao = $this->executaQuery();
        $i = 0;
        while ($a = pg_fetch_array($execucao)) {
            $arrayDados[$i] = $a;
            $i++;
        }
        if ($i > 0)
            $row = sizeof($arrayDados);
        return $arrayDados;
    }

    public function RsutArrayAssoc() : array {
        $result = $this->executaQuery();
//        if(is_array($result)):
        return pg_fetch_array($result, PGSQL_ASSOC);
//        else:
//            return null;
//        endif;
    }

    // Numero de linhas retornada na consulta
    public function ContarLinhas() : int {
        $this->numrows = pg_num_rows($this->execucao);
        return $this->numrows;
    }

    // Fecha conexao
    private function desconecta() : void {
        pg_flush($this->conexao);
        pg_close($this->conexao);
    }

    // Libera consulta da memoria
    public function Liberar(): void {
        pg_free_result($this->execucao);
    }

    public function linhasPesquisadas(string $tipo) : bool {
        $this->isOK = $this->executaQuery();
        if ($this->isOK == true):
            $tipo = strtolower($tipo);
            if ($tipo == "select"):
                $this->numrows = pg_num_rows($this->execucao);
            else:
                $this->numrows = pg_affected_rows($this->conexao);
            endif;
        endif;
        return (bool) $this->isOK;
    }

    public function TestConect() : bool {
        $this->conexao = pg_connect("host=" . $this->servidor . " port=" . $this->porta . " dbname=" . $this->bancoDeDados . " user=" . $this->usuario . " password=" . $this->senha . "");
        if ($this->conexao) {
            $this->string = "conectado";
            return true;
        } else {
            $this->string = "Erro ao conectar ao banco de dados.";
            return false;
        }
    }

    public function getNumrows() : int {
        return $this->numrows;
    }

    public function getString() : string {
        return $this->string;
    }

    public function getError() : mixed {
        return $this->error;
    }

}
