<?php

class ConexaoMysqli {

    public $isOk;
    public $msgInfo;
    public $msgErro;
    public $host_info;
    public $numrows;
    public $autocommit;
    public $db_row_autocommit;
    public $bancoDeDados;
    public $usuario;
    public $servidor;
    public $senha;
    public $porta;
    public $sql;

    function __construct() {
        $this->isOk = false;
        $this->msgInfo = "";
        $this->msgErro = "";
        $this->host_info = "";
        $this->sql = "";
        $this->numrows = 0;
        $this->autocommit = false;
        $this->db_row_autocommit = null;
        $configBD = new ConfigBDClass();
        $this->bancoDeDados = $configBD->getBancoDeDados();
        $this->usuario = $configBD->getUsuario();
        $this->servidor = $configBD->getServidor();
        $this->senha = $configBD->getSenha();
        $this->porta = $configBD->getPorta();
    }

    private function getConnect(): bool {
        $this->isOk = true;
        try {
            $this->conn = new mysqli($this->servidor, $this->usuario, $this->senha, $this->bancoDeDados, $this->porta);
            $this->host_info = "Conexão Realizada com sucesso! ";
            if ($this->conn->connect_errno)
                throw new Exception($this->conn->connect_error);
        } catch (Exception $e) {
            $this->host_info = "";
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        }
        return $this->isOk;
    }

    private function disconnects() {
        $this->conn->close();
    }

    private function validationConnect() {
        $this->msgErro = "";
        if (!$this->getConnect()):
            return $this->isOk;
        endif;
    }

    public function executaQuery() {
        $this->validationConnect();
        try {
            $this->conn->query("SET NAMES 'utf8'");
            $this->conn->query("SET character_set_connection=utf8");
            $this->conn->query("SET character_set_client=utf8");
            $this->conn->query("SET character_set_results=utf8");
            $this->conn->set_charset('utf8');
            $this->result = $this->conn->query($this->sql);
            if (!$this->result):
                throw new mysqli_sql_exception($this->conn->connect_error);
            else:
                $this->isOk = true;
                $this->numrows = (int) $this->result->num_rows;
                $this->msgInfo = "Affected rows: " . $this->numrows;
            endif;
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = "Erro ao execluta o sql:" . $e->getMessage();
        } finally {
            $this->disconnects();
        }
        return $this->result;
    }

    public function updateQuery(): bool {
        $this->msgErro = "";
        if (!$this->getConnect()):
            return $this->isOk;
        endif;
        try {
            $this->conn->query('SET character_set_results=utf8');
            $this->result = $this->conn->query($this->sql);
            if ($this->result == 0):
                throw new mysqli_sql_exception($this->conn->connect_error);
            else:
                $this->isOk = true;
                $this->numrows = $this->conn->info; //affected_rows
                $this->msgInfo = "Affected rows: " . $this->numrows;
            endif;
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = "Erro ao execluta o sql:" . $e->getMessage();
        } finally {
            $this->disconnects();
        }
        return $this->isOk;
    }

    public function montaArrayPesquisa(): array {
        $i = 0;
        $arrayDados = null;
        $arrayresult = $this->executaQuery();
        if ($this->isOk):
            while ($a = $arrayresult->fetch_array(MYSQLI_ASSOC)) {
                $arrayDados[$i] = $a;
                $i++;
            }
            $arrayresult->free();
        else:
            $arrayDados = null;
        endif;
        return (array) $arrayDados;
    }

    public function RsutArrayAssoc(): array {
        $arrayresult = $this->executaQuery();
        $arrayDados = null;
        if ($this->isOk):
            $arrayDados = mysqli_fetch_array($arrayresult, MYSQLI_ASSOC);
        endif;
        return (array) $arrayDados;
    }

    public function RsutArrayAssocII(): array {
        $i = 0;
        $arrayDados = (array) null;
        $arrayresult = $this->executaQuery();
        if ($this->isOk):
            while ($a = $arrayresult->fetch_array(MYSQLI_ASSOC)) {
                $arrayDados[$i] = $a;
                $i++;
            }
            $arrayresult->free();
        else:
            $arrayDados = (array) null;
        endif;
        return (array) $arrayDados;
    }

    public function TestConect(): bool {
        try {
            $this->isOk = true;
            $conn = new mysqli($this->servidor, $this->usuario, $this->senha, $this->bancoDeDados, $this->porta);
            $this->host_info = $conn->host_info;
            if ($conn->connect_errno):
                throw new Exception($conn->connect_error);
            endif;
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $conn->close();
        }
        return $this->isOk;
    }

    public function linhasPesquisadas(string $paramTipo): int {
        $tipo = strtolower($paramTipo);
        if ($tipo == "select") {
            return (int) mysqli_num_rows($this->executaQuery());
        } else {
            return (int) mysqli_affected_rows($this->executaQuery());
        }
    }

    public function actionAutocommit() {
        // autocommit trur - on 
        $this->conn->autocommit($this->autocommit);
    }

    public function BeginTransaction(array $arraySQLs): bool {
        if (!$this->getConnect()):
            return $this->isOk;
        endif;
        $this->conn->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
        try {
            foreach ($arraySQLs as $rows):
                $this->conn->query($rows);
                if (!$this->conn):
                    throw new mysqli_sql_exception($this->conn->connect_error);
                endif;
            endforeach;
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = "Erro ao execluta o sql:" . $e->getMessage();
        }
        $this->actionCommit();
        $this->disconnects();
        return $this->isOk;
    }

    public function actionCommit() {
        $this->conn->commit();
    }

    public function actionRollback() {
        $this->conn->rollback();
    }

    public function setBeginTransaction(bool $beginTransaction) {
        $this->beginTransaction = $beginTransaction;
    }

    public function informationConn(): string {
        $this->getConnect();
        $this->string = "";
        $this->string .= "Character set: " . $this->conn->character_set_name() . "<br/>";
        if (!$this->conn->set_charset("utf8")) {
            $this->string .= "Error loading character set utf8: " . $this->conn->error . "<br/>";
        } else {
            $this->string .= "Current character set: " . $this->conn->character_set_name() . "<br/>";
        }
        if ($result = $this->conn->query("SELECT @@autocommit")) {
            $row = $result->fetch_row();
            $this->string .= "Autocommit is " . $row[0];
            $result->free();
        }
        $this->disconnects();
        return $this->string;
    }

    public function setAutocommit(bool $autocommit) {
        $this->autocommit = $autocommit;
    }

    public function setBancoDeDados($bancoDeDados) {
        $this->bancoDeDados = $bancoDeDados;
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

}
