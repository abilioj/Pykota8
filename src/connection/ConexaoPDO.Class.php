<?php

/**
 * Description of ConnectionPDO
 *
 * @author AJGF
 */
class ConexaoPDO {

    public function __construct(
        private mixed $pdo = null,
        private string $server = '',
        private string $port = '',
        private string $drivers = '',
        private string $database = '',
        private string $user = '',
        private string $password = '',
        private mixed $connection = null,
        private mixed $execution = null,
        private string $host_info  = '',
        private string $toerror = '',
        private mixed $beginTransaction = null,
        private string $dsn = '',
        private mixed $options = null,
        private int $lastInsertId = 0,
        private bool $isOk = false,
        private string $msgInfo = "",
        private string $msgErro = "",
        private int $numrows = 0,
        private bool $autocommit = false,
        private mixed $db_row_autocommit = null,
        public string $sql = '',
        public string $string = ''
        ) {
        $configBD = new ConfigBDClass();
        $this->server = $configBD->getHostServer();
        $this->drivers = $configBD->getDrivers();
        $this->port = $configBD->getPort();
        $this->database = $configBD->getDatabase();
        $this->user = $configBD->getUser();
        $this->password = $configBD->getpassword();
        $this->dsn = $configBD->getDsn();
        $this->options = $configBD->getOptions();
    }

    private function getConnect(): bool {
        $this->isOk = true;
        try {
            $this->validationDrivers();
            $this->connection = new PDO($this->dsn, $this->user, $this->password, $this->options);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->msgInfo = "Conectado ...";
        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = $PDOe->getMessage();
        }
        return $this->isOk;
    }

    private function disconnects() {
        $this->connection = null;
        unset($this->connection);
    }

    private function validationDrivers() {
        $this->isOk = false;
        $array_Drivers = PDO::getAvailableDrivers();
        foreach ($array_Drivers as $row):
            if ($row == $this->drivers):
                $this->isOk = true;
            endif;
        endforeach;
        if (!$this->isOk):
            $this->msgErro = "driver " . $this->drivers . " Não Encontrado <br/>'";
            $this->isOk = FALSE;
            throw new Exception("Error: " . $this->msgErro);
        endif;
    }

    private function validationConnect() {
        $this->numrows = 0;
        if (!$this->getConnect()):
            throw new Exception($this->msgErro);
            return; //$this->isOk;
        endif;
        $this->isOk = TRUE;
    }

    private function validationSql() {
        if (is_null($this->sql)):
            $this->isOk = FALSE;
            throw new Exception("Error: A sql é Null!");
        endif;
    }

    public function executeQuery() {
        try {
            $this->validationConnect();
            $this->validationSql();
            $this->connection->query("SET NAMES 'UTF8';");
            $this->execution = $this->connection->query($this->sql);
            if (!$this->execution):
                throw new PDOException;
            else:
                $this->isOk = true;
                $this->numrows = $this->execution->rowCount();
            endif;
        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = $PDOe->getMessage() . "";
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage() . "";
        } finally {
            $this->disconnects();
        }
        return $this->execution;
    }

    public function updateQuery(): bool {
        try {
            $this->validationConnect();
            $this->validationSql();
            if (!$this->isOk):
                return $this->isOk;
            endif;
            $affected = $this->connection->exec($this->sql);
            if ($affected === false):
                throw new PDOException;
            else:
                $this->isOk = TRUE;
                if (ToString::VerifecaParteDeString($this->sql, "INSERT")):
                    $this->lastInsertId = $this->connection->lastInsertId();
                endif;
                $this->numrows = $affected;
                $this->msgInfo = "Affected rows: " . $this->numrows;
            endif;
        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = $PDOe->getMessage();
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnects();
        }

        return $this->isOk;
    }

    public function QueryStmtUpdate(): bool {
        $this->validationConnect();
        try {
            $this->execution = $this->connection->prepare($this->sql);
            $this->execution->execute();
            $this->isOk =TRUE;
        } catch (PDOException $e) {
            $this->isOk = false;
            $this->msgErro = $e->getTraceAsString();
        } finally {
            $this->disconnects();
        }
        return $this->isOk;
    }

    public function CountRow(): int {
        $this->validationConnect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $this->execution = $this->connection->query($this->sql);
            $this->execution->execute();
            $this->numrows = $this->execution->rowCount();
        } catch (PDOException $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnects();
        }
        return $this->numrows;
    }

    public function QuerysTransaction(array $arraySQLs): bool {
        $this->validationConnect();
        $this->connection->beginTransaction();
        try {
            foreach ($arraySQLs as $rowSQL):
                if (!$this->connection->query($rowSQL)):
                    throw new PDOException;
                endif;
            endforeach;
            $this->lastInsertId = $this->connection->lastInsertId();
            $this->connection->commit();
        } catch (PDOException $e) {
            $this->msgErro = "Failed: " . $e->getMessage();
        } finally {
            $this->disconnects();
        }
        return $this->isOk;
    }

    public function montaArrayPesquisa(): array {
        $i = 0;
        $arrayDados = null;
        $arrayresult = $this->executeQuery();
        if ($this->isOk && $this->numrows > 0):
            while ($a = $arrayresult->fetch()):
                $arrayDados[$i] = $a;
                $i++;
            endwhile;
            unset($arrayresult);
            return (array) $arrayDados;
        else:
            return (array) [];
        endif;
    }

    public function RsutArrayCLASSTYPE() : array {
        $result = $this->executeQuery();
        if ($this->isOk && $this->numrows > 0):
            return $result->fetchAll(PDO::FETCH_CLASSTYPE);
        else:
            return (array) null;
        endif;
    }

    public function RsutArrayAssoc(): array {
        $result = $this->executeQuery();
        if ($this->isOk && $this->numrows > 0):
            return $result->fetchAll(PDO::FETCH_ASSOC);
        else:
            return (array) null;
        endif;
    }

    public function RsutArrayAssocII(): array {
        $i = 0;
        $arrayDados = null;
        $arrayresult = $this->executeQuery();
        if ($this->isOk && $this->numrows > 0):
            while ($a = $arrayresult->fetchAll(PDO::FETCH_ASSOC)) {
                $arrayDados[$i] = $a;
                $i++;
            }
            return (array) $arrayDados;
        else:
            return (array) null;
        endif;
    }

    public function TestConect(): bool {
        $this->isOk = true;
        try {
            $this->validationConnect();
            $this->getConnect();
        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = "Error: " . $PDOe->getMessage();
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = "Error: " . $e->getMessage();
        }finally{
            $this->disconnects();
        }
        return $this->isOk;
    }

    public function linhasPesquisadas(string $paramTipo): int {
        $this->varInt = 0;
        $tipo = strtolower($paramTipo);
        if ($tipo == "select"):
            $this->varInt = $this->CountRow();
        else:
            $this->updateQuery();
            $this->varInt = $this->numrows;
        endif;
        return $this->varInt;
    }

    public function actionAutocommit() {
        // autocommit trur - on
    }

    public function actionCommit() {
        $this->connection->commit();
    }

    public function actionRollback() {
        $this->connection->rollBack();
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
