<?php

class ConexaoSQLServer {

   private $bancoDeDados;
   private $usuario;
   private $servidor;
   private $senha;
   private $porta;
   private $conexao;
   private $execucao;
   private $erro;
   public $sql;

   function __construct() {
      $configBD = new ConfigBDClass();
      $this->bancoDeDados = $configBD->getBancoDeDados();
      $this->usuario = $configBD->getUsuario();
      $this->servidor = $configBD->getServidor();
      $this->senha = $configBD->getSenha();
      $this->porta = $configBD->getPorta();
      $this->erro = 0;
   }

   public function conecta() {
      //serverName\instanceName, portNumber (default is 1433)
      // .", ".$this->porta.""
      $serverName = $this->servidor;

      // UID e PWD Desde não são especificados na matriz $ConnectionInfo,
      // A conexão estará usando autenticação do Windows Tentativa.
      $connectionInfo = array("Database" => $this->bancoDeDados, "UID" => $this->usuario, "PWD" => $this->senha, "ReturnDatesAsStrings" => true, "CharacterSet" => "UTF-8");
      $this->conexao = sqlsrv_connect($serverName, $connectionInfo);

      if ($this->conexao) {
         return $this->conexao;
      } else {
         $this->erro = 1;
         throw new Exception("Erro ao conectar ao banco de dados.");
      }
   }

   public function executaQuery() {

      try {
         $this->conecta();
      } catch (Exception $erro) {
         throw new Exception($erro->getMessage());
      }

      $this->execucao = sqlsrv_query($this->conexao, $this->sql);

      if ($this->execucao) {
         $execucao = $this->execucao;
         $this->desconecta();
         return $execucao;
      } else {
         $this->desconecta();
         throw new Exception("Erro ao encontrar a tabela de banco de dados.");
      }
   }

   public function montaArrayPesquisa() {

      try {
         $this->conecta();
      } catch (Exception $erro) {
         throw new Exception($erro->getMessage());
      }

      $this->execucao = sqlsrv_query($this->conexao, $this->sql);

      if ($this->execucao) {
         $i = 0;
         while ($a = sqlsrv_fetch_array($this->execucao)) {
            $arrayDados[$i] = $a;
            $i++;
         }
         $this->desconecta();
         return $arrayDados;
      } else {
         $this->desconecta();
         throw new Exception("Erro ao encontrar a tabela de banco de dados.");
      }
   }

   public function RsutArrayAssoc() {

      try {
         $this->conecta();
      } catch (Exception $erro) {
         throw new Exception($erro->getMessage());
      }
      $this->execucao = sqlsrv_query($this->conexao, $this->sql);
      if ($this->execucao) {
         $arrayDados = sqlsrv_fetch_array($this->execucao, SQLSRV_FETCH_ASSOC);
         $this->desconecta();
         return $arrayDados;
      } else {
         $this->desconecta();
         throw new Exception("Erro ao encontrar a tabela de banco de dados.");
      }
   }

   private function desconecta() {
      sqlsrv_close($this->conexao);
   }

   public function TestConect() {
      $this->conecta();
      return $this->erro;
   }

   public function linhasPesquisadas($tipo) {
      try {
         $this->conecta();
      } catch (Exception $erro) {
         throw new Exception($erro->getMessage());
      }
      $this->execucao = sqlsrv_query($this->conexao, $this->sql);

      $tipo = strtolower($tipo);
      if ($tipo == "select") {
         $result = sqlsrv_num_rows($this->execucao);
      } else {
         $result = sqlsrv_rows_affected($this->execucao);
      }
      return $result;
   }

   public function commit() {
      $this->sql = "COMMIT";
      return $this->executaQuery();
   }

   public function rollback() {
      $this->sql = "ROLLBACK";
      return $this->executaQuery();
   }

}
