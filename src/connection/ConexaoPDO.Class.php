<?php

/**
 * Description of ConnectionPDO
 *
 * @author AJGF
 */
class ConexaoPDO {
    private ?PDO $pdo = null;
    private string $database;
    private string $user;
    private string $server;
    private string $password;
    private string $port;
    private string $drivers;
    private ?PDO $connection = null;
    private $execution;
    private string $host_info = '';
    private int $toerror = 0;
    private string $msgErro = '';
    private string $msgInfo = '';
    private int $numrows = 0;
    private bool $autocommit = false;
    private $db_row_autocommit;
    private ?bool $beginTransaction = null;
    private bool $isOk = false;
    private string $dsn;
    private array $options;
    private int $lastInsertId = 0;
    public ?string $sql = null;
    public string $string;

    public function __construct() {
        $this->isOk = false;
        $this->msgInfo = "";
        $this->msgErro = "";
        $this->host_info = "";
        $this->numrows = 0;
        $this->autocommit = false;
        $this->lastInsertId = 0;

        // Assuming the `ConfigBDClass` returns configurations for the database
        $configBD = new ConfigBDClass();
        $this->drivers = $configBD->getDrivers();
        $this->database = $configBD->getBancoDeDados();
        $this->user = $configBD->getUsuario();
        $this->server = $configBD->getServidor();
        $this->password = $configBD->getSenha();
        $this->port = $configBD->getPorta();
        $this->dsn = $configBD->getDsn();
        $this->options = $configBD->getOptions();
    }

    private function getConnect(): bool {
        try {
            $this->validationDrivers();
            $this->connection = new PDO($this->dsn, $this->user, $this->password, $this->options);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->isOk = true;
        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = $PDOe->getMessage();
        }
        return $this->isOk;
    }

    private function disconnect(): void {
        $this->connection = null;
    }

    private function validationDrivers(): void {
        $this->isOk = false;
        $availableDrivers = PDO::getAvailableDrivers();
        if (in_array($this->drivers, $availableDrivers, true)) {
            $this->isOk = true;
        } else {
            $this->msgErro = "Driver {$this->drivers} não encontrado.";
            throw new Exception($this->msgErro);
        }
    }

    private function validationConnect(): void {
        $this->numrows = 0;
        if (!$this->getConnect()) {
            throw new Exception($this->msgErro);
        }
        $this->isOk = true;
    }

    private function validationSql(): void {
        if (is_null($this->sql)) {
            $this->isOk = false;
            throw new Exception("Erro: A SQL é nula!");
        }
    }

    public function executeQuery(): bool|PDOStatement  {
        try {
            $this->validationConnect();
            $this->validationSql();
            $this->connection->query("SET NAMES 'UTF8';");
            $this->execution = $this->connection->query($this->sql);
            if (!$this->execution) {
                throw new PDOException();
            }
            $this->isOk = true;
            $this->numrows = $this->execution->rowCount();
        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = $PDOe->getMessage();
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnect();
        }
        return $this->execution;
    }

    public function updateQuery(): bool {
        try {
            $this->validationConnect();
            $this->validationSql();
            if (!$this->isOk) {
                return $this->isOk;
            }

            $affected = $this->connection->exec($this->sql);
            if ($affected === false) {
                throw new PDOException();
            }

            $this->isOk = true;
            if (stripos($this->sql, 'INSERT') !== false) {
                $this->lastInsertId = (int)$this->connection->lastInsertId();
            }
            $this->numrows = $affected;
            $this->msgInfo = "Linhas afetadas: " . $this->numrows;

        } catch (PDOException $PDOe) {
            $this->isOk = false;
            $this->msgErro = $PDOe->getMessage();
        } catch (Exception $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnect();
        }
        return $this->isOk;
    }

    public function queryStmtUpdate(): bool {
        $this->validationConnect();
        try {
            $this->execution = $this->connection->prepare($this->sql);
            $this->execution->execute();
            $this->isOk = true;
        } catch (PDOException $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnect();
        }
        return $this->isOk;
    }

    public function countRow(): int {
        $this->validationConnect();
        try {
            $this->execution = $this->connection->query($this->sql);
            $this->numrows = $this->execution->rowCount();
        } catch (PDOException $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnect();
        }
        return $this->numrows;
    }

    public function queryTransaction(array $arraySQLs): bool {
        $this->validationConnect();
        $this->connection->beginTransaction();
        try {
            foreach ($arraySQLs as $sql) {
                if (!$this->connection->exec($sql)) {
                    throw new PDOException();
                }
            }
            $this->lastInsertId = (int)$this->connection->lastInsertId();
            $this->connection->commit();
        } catch (PDOException $e) {
            $this->msgErro = "Falha: " . $e->getMessage();
            $this->connection->rollBack();
        } finally {
            $this->disconnect();
        }
        return $this->isOk;
    }

    public function fetchArrayAssoc(): array {
        $result = $this->executeQuery();
        return $this->isOk && $this->numrows > 0 ? $result->fetchAll(PDO::FETCH_BOTH) : [];
    }

    public function fetchArrayCLASSTYPE(): array {
        $result = $this->executeQuery();
        return $this->isOk && $this->numrows > 0 ? $result->fetchAll(PDO::FETCH_CLASSTYPE) : [];
    }

    public function testConnect(): bool {
        try {
            $this->validationConnect();
            $this->isOk = true;
        } catch (PDOException | Exception $e) {
            $this->isOk = false;
            $this->msgErro = $e->getMessage();
        } finally {
            $this->disconnect();
        }
        return $this->isOk;
    }

    public function setAutocommit(bool $autocommit): void {
        $this->autocommit = $autocommit;
    }

    public function getLastInsertId(): int {
        return $this->lastInsertId;
    }

    public function getMsgErro(): string {
        return $this->msgErro;
    }

    public function getMsgInfo(): string {
        return $this->msgInfo;
    }

    public function getNumrows(): int {
        return $this->numrows;
    }

    public function getIsOk(): bool {
        return $this->isOk;
    }
}
