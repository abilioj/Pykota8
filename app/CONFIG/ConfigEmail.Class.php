<?php

class ConfigEmailClass {

    private $SMTPDebug;
    private $Debugoutput;
    private $Host;
    private $Port;
    private $SMTPAuth;
    private $SMTPSecure;
    private $isHTML;
    private $Username;
    private $Password;
    private $NomeDefault;
    private $EmailDefault;

    function __construct() {
        // Atiprivate a depuração SMTP  0 = off (para uso em produção) * 1 = mensagens de cliente * 2 = cliente e servidor de mensagens
        $this->SMTPDebug = 0;
        // Peça saída de depuração HTML-friendly
        $this->Debugoutput = 'html';
        // Endereço do servidor SMTP
        $this->Host = '';
        // Definir o número da porta SMTP - provável que seja 25, 465 ou 587
        $this->Port = '';
        // Usa autenticação SMTP? (opcional)
        $this->SMTPAuth = true;
        // Protocolo da conexão
        $this->SMTPSecure = 'ssl';
        // Definir formato de email para HTML
        $this->isHTML = true;
        // Usuário do servidor SMTP
        $this->Username = '';
        // Senha do servidor SMTP
        $this->Password = '';
        $this->NomeDefault = 'Atendimento';
        $this->EmailDefault = '';
    }

    function getSMTPDebug() {
        return $this->SMTPDebug;
    }

    function getDebugoutput() {
        return $this->Debugoutput;
    }

    function getHost() {
        return $this->Host;
    }

    function getPort() {
        return $this->Port;
    }

    function getSMTPAuth() {
        return $this->SMTPAuth;
    }

    function getSMTPSecure() {
        return $this->SMTPSecure;
    }

    function getIsHTML() {
        return $this->isHTML;
    }

    function getUsername() {
        return $this->Username;
    }

    function getPassword() {
        return $this->Password;
    }

    function getNomeDefault() {
        return $this->NomeDefault;
    }

    function getEmailDefault() {
        return $this->EmailDefault;
    }

}
