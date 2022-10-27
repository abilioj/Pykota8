<?php

/**
 * Description of ConexaoPostgres
 *
 * @author abilio.jose
 */
class ConexaoPostgres {

    private mixed $conn;
    private string $host;
    private string $dbname;
    private string $user;
    private string $password;
    private string $port;
    private string $stringDSN;
    private string $host_info;
    private mixed $result;
    private string $toerror;
    private string $msgErro;
    private string $msgInfo;
    private int $numrows;
    private string $autocommit;
    private string $db_row_autocommit;
    private string $beginTransaction;
    private string $isOk;
    public string $sql;

    function __construct() {
        $configBD = new ConfigBDClass();
        $this->host = $configBD->getHostServer();
        $this->port = $configBD->getPort();
        $this->dbname = $configBD->getDatabase();
        $this->user = $configBD->getUser();
        $this->password = $configBD->getpassword();
    }

    private function getConnect() : mixed {
        $this->conn = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" . $this->dbname . " user=" . $this->user . " password=" . $this->password . "");
        if ($this->conn) {
            return $this->conn;
        } else {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    // Fecha conexao
    private function disconnects() {
        pg_flush($this->conn);
        pg_close($this->conn);
    }

    public function executeQuery() : mixed {
        try {
            $this->getConnect();
        } catch (Exception $erro) {
            return false;
        }
        pg_exec("SET NAMES 'utf8'");
        $this->result = pg_exec($this->sql);
        if ($this->result) {
            $this->disconnects();
            return $this->result;
        } else {
            $this->disconnects();
            return false;
        }
    }

    public function updateQuery() {
        try {
            $this->conecta();
        } catch (Exception $erro) {
            $this->error = $erro->getMessage();
        }
        pg_query($this->conn, "BEGIN;");
        $this->result = pg_query($this->conn, $this->sql);
        if ($this->result) {
            pg_exec($this->conn, "COMMIT;");
            $this->disconnects();
            return $this->result;
        } else {
            pg_exec($this->conn, "ROLLBACK;");
            $this->disconnects();
            return false;
        }
    }

    // Numero de linhas retornada na consulta
    public function CountRow() : int {
        $this->numrows = pg_num_rows($this->result);
        return $this->numrows;
    }

    public function montaArrayPesquisa() {
        $arrayDados = null;
        $result = $this->executeQuery();
        $i = 0;
        while ($a = pg_fetch_array($result)) {
            $arrayDados[$i] = $a;
            $i++;
        }
        if ($i > 0)
            $row = sizeof($arrayDados);
        return $arrayDados;
    }

    public function RsutArrayAssoc() {
        return null;
    }

    // Salva no array $line resultados retornados
    public function MostrarResultados() {
        $result = $this->executeQuery();
        $line = pg_fetch_array($result);
        return $line;
    }

    // Libera consulta da memoria
    public function clean() {
        pg_free_result($this->result);
    }

    public function linhasPesquisadas($tipo) : int {
        $this->isOK = $this->executeQuery();
        if ($this->isOK == true):
            $tipo = strtolower($tipo);
            if ($tipo == "select"):
                $this->numrows = pg_num_rows($this->result);
            else:
                $this->numrows = pg_affected_rows($this->conn);
            endif;
        endif;
        return (int) $this->numrows;
    }

    public function TestConect() {
        $this->conn = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" . $this->dbname . " user=" . $this->user . " password=" . $this->password . "");
        if ($this->conn) {
            $this->msgInfo = "conectado";
            $this->disconnects();
            return true;
        } else {
            $this->msqInfo = "Erro ao conectar ao banco de dados.";
            $this->disconnects();
            return false;
        }
    }


    public function actionAutocommit() {
        // autocommit trur - on
    }

    public function actionCommit() {
        $this->conn->commit();
    }

    public function actionRollback() {
        $this->conn->rollBack();
    }

    public function informationConn(): string {
        return $this->string;
    }

    public function setBeginTransaction(bool $beginTransaction) {
        $this->beginTransaction = $beginTransaction;
    }

    public function setAutocommit(bool $autocommit) {
        $this->autocommit = $autocommit;
    }

    public function setDatabase(string $database) {
        $this->database = $database;
    }

    public function getHost_info(): string {
        return (string) $this->host_info;
    }

    public function geTotErro(): int {
        return (int) $this->toerror;
    }

    public function getMsgErro(): string {
        return (string) $this->msgErro;
    }

    public function getMsgInfo(): string {
        return (string) $this->msgInfo;
    }

    public function getNumrows(): int {
        return (int) $this->numrows;
    }

    public function getIsOk(): bool {
        return $this->isOk;
    }

    function getLastInsertId() {
        return $this->lastInsertId;
    }
}
