<?php

class ConexaoMysql {

   private $bancoDeDados;
   private $usuario;
   private $servidor;
   private $senha;
   private $porta;
   private $selecionaBanco;
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
   }

   public function conecta() {
      $this->conexao = mysql_connect($this->servidor, $this->usuario, $this->senha, $this->porta);
      if ($this->conexao) {
         $this->selecionaBD();
         return $this->conexao;
      } else {
         throw new Exception("Erro ao conectar ao banco de dados.");
      }
   }

   private function selecionaBD() {
      $this->selecionaBanco = mysql_select_db($this->bancoDeDados, $this->conexao);
      if ($this->selecionaBanco) {
         return $this->selecionaBanco;
      } else {
         throw new Exception("Erro ao selecionar o banco de dados");
      }
   }

   public function executaQuery() {
      header('Content-Type: text/html; charset=utf-8');
      try {
         $this->conecta();
      } catch (Exception $erro) {
         throw new Exception($erro->getMessage());
      }

      mysql_query("SET NAMES 'utf8'");
      mysql_query('SET character_set_connection=utf8');
      mysql_query('SET character_set_client=utf8');
      mysql_query('SET character_set_results=utf8');

      $this->execucao = mysql_query($this->sql);

      if ($this->execucao) {
         $this->desconecta();
         return $this->execucao;
      } else {
         $this->desconecta();
         throw new Exception("Erro ao encontrar a tabela de banco de dados.");
      }
   }

   public function montaArrayPesquisa() {
      $execucao = $this->executaQuery();
      $i = 0;
      while ($a = mysql_fetch_array($execucao)) {
         $arrayDados[$i] = $a;
         $i++;
      }

      return $arrayDados;
   }

   public function RsutArrayAssoc() {
      $result = $this->executaQuery();
      return mysql_fetch_array($result, MYSQL_ASSOC);
   }

   public function desconecta() {
      mysql_close($this->conexao);
   }

   public function TestConect() {
      $this->conexao = mysql_connect($this->servidor, $this->usuario, $this->senha, $this->porta);
      if ($this->conexao) {
         $this->erro = 0;
      } else {
         $this->erro = 1;
      }
      return $this->erro;
   }

   public function linhasPesquisadas($tipo) {
      $tipo = strtolower($tipo);
      if ($tipo == "select") {
         return mysql_num_rows($this->execucao);
      } else {
         return mysql_affected_rows($this->conexao);
      }
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
