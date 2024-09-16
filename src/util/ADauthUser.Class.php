<?php

/**
 * Description of ADauthUser
 *  Função de validação no AD via protocolo LDAP
 * como usar:
 * valida_ldap("servidor", "domíniousuário", "senha");
 * @author abilio.jose
 */
class ADauthUser {

    private $arrayData;
    private $configAD;
    private $conn;
    private $conn_authentication;
    private $ldap_server;
    private $ldap_domain;
    private $ldap_port;
    private $ldap_filter_ad;
    private $ldap_group_ad;
    private $auth_user;
    private $auth_pwd;
    private $stn_User_authentication;
    private $auth_msg;
    private $isOK;

    public function __construct() {
        $this->isOK = false;
        $this->arrayData = null;
        $this->conn = null;
        $this->conn_authentication = null;
        $this->configAD = new ConfigADClass();
        $this->ldap_server = $this->configAD->getHostServer();
        $this->ldap_domain = $this->configAD->getDnsname();
        $this->ldap_port = $this->configAD->getPort();
        $this->ldap_filter_ad = $this->configAD->getFilter_ad();
        $this->ldap_group_ad = $this->configAD->getGroup_ad();
    }

    /**
     * Metodo para coneceta no ad
     * @access private
     * @param string &$user
     * @param string &$pwd
     * @return boolean
     */
    private function getConnect(string $user, string $pwd): bool {
        $this->auth_user = $user;
        $this->auth_pwd = $pwd;
        $this->stn_User_authentication = $this->auth_user . "@" . $this->ldap_domain;

        // Attempt to connect to the LDAP server
        $this->conn = ldap_connect($this->ldap_server, $this->ldap_port);
        if (!$this->conn) {
            $this->auth_msg = "Não foi possível conexão com Active Directory";
            $this->isOK = false;
            return false;
        }

        // Set LDAP options
        ldap_set_option($this->conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->conn, LDAP_OPT_REFERRALS, 0);

        // Attempt to authenticate the user on the LDAP server
        try {
            $this->conn_authentication = ldap_bind($this->conn, $this->stn_User_authentication, $this->auth_pwd);
            if (!$this->conn_authentication) {
                $this->auth_msg = "Não foi possível pesquisa no AD.";
                ldap_close($this->conn);
                $this->isOK = false;
            } else {
                $this->auth_msg = "Autenticação bem-sucedida";
                $this->isOK = true;
            }
        } catch (Exception $e) {
            $this->auth_msg = "Erro de autenticação: " . $e->getMessage();
            $this->isOK = false;
        }

        return $this->isOK;
    }

    /**
     * Metodo para desconeceta do ad
     * @access private
     * @return void
     */
    private function disconnects() {
        ldap_close($this->conn);
        unset($this->conn);
        unset($this->conn_authentication);
    }

   public function Authenticate_AD(string $user, string $pwd): bool {
    // Verifica se o usuário ou senha são vazios
    if (empty($user) || empty($pwd)) {
        return false;
    }
    // Tenta se conectar e autenticar com o servidor AD
    $this->isOK = $this->getConnect($user, $pwd);
    if (!$this->isOK) {
        return false;
    }
    
    /*
    // Sanitiza o nome de usuário para evitar injeção LDAP
    $user = ldap_escape($user, "", LDAP_ESCAPE_FILTER);
    // Realiza a busca LDAP
   
    try {
        $stn_filter = "(&" . $this->ldap_filter_ad . "(sAMAccountname={$user}))";
        $search = ldap_search($this->conn, $this->ldap_group_ad, $stn_filter);
        if (!$search) {
            $this->auth_msg = ldap_errno($this->conn);
            $this->isOK = false;
        } else {
            $this->isOK = true;
        }
    } catch (Exception $e) {
        $this->auth_msg = "Erro na pesquisa LDAP: " . $e->getMessage();
        $this->isOK = false;
    }
    */
    
    // Fecha a conexão LDAP
    $this->disconnects();
    return $this->isOK;
}


public function User_Authenticate_AD(string $user, string $pwd): ADUser {
    $OadUser = new ADUser();    
    // Verifica se usuário ou senha são vazios
    if (empty($user) || empty($pwd)) {
        return $OadUser; // Retorna objeto vazio em vez de FALSE
    }
    // Tenta se conectar e autenticar no servidor AD
    $this->isOK = $this->getConnect($user, $pwd);
    if (!$this->isOK) {
        return $OadUser; // Conexão falhou, retorna objeto vazio
    }
    // Sanitiza o nome de usuário para evitar injeção LDAP
    $user = ldap_escape($user, "", LDAP_ESCAPE_FILTER);
    // Realiza a pesquisa LDAP
    try {
        $search = ldap_search($this->conn, $this->ldap_group_ad, "(&" . $this->ldap_filter_ad . "(sAMAccountname={$user}))");
        if (!$search) {
            $this->auth_msg = ldap_errno($this->conn);
            $this->isOK = false;
        } else {
            $arrayData = ldap_get_entries($this->conn, $search);
            $rowData = ldap_count_entries($this->conn, $search);
            $OadUser = $this->copularObject($arrayData, $rowData); // Popula o objeto ADUser
        }
    } catch (Exception $e) {
        $this->auth_msg = "Erro na pesquisa LDAP: " . $e->getMessage();
        $this->isOK = false;
    }
    // Fecha a conexão com o AD
    $this->disconnects();
    return $OadUser; // Retorna o objeto ADUser (preenchido ou vazio)
}


    public function Users_Authenticate_AD($user, $pwd): array|bool {
        $this->arrayData = null;
        if ($user == "" || $user == NULL && $pwd == "" || $pwd == NULL):
            return FALSE;
        endif;
        // Tenta se conectar com o servidor
        $this->isOK = $this->getConnect($user, $pwd);
        if (!$this->isOK) {
            return $this->isOK;
        }
        $search = ldap_search($this->conn, $this->ldap_group_ad, $this->ldap_filter_ad . ")"); //(sAMAccountname={$user})
        if (!$search):
            $this->auth_msg = ldap_errno($this->conn);
            $this->isOK = false;
        else:
            $arrayData = ldap_get_entries($this->conn, $search);
            $rowData = ldap_count_entries($this->conn, $search);
            for ($i = 0; $i < $rowData; $i++) {
                $this->arrayData[] = array(
                    "nomeCompleto" => $arrayData[$i]["name"][0]
                    , "nome" => $arrayData[$i]["givenname"][0]
                    , "sobrenome" => $arrayData[$i]["sn"][0]
                    , "silga" => $arrayData[$i]["initials"][0]
                    , "login" => $arrayData[$i]["samaccountname"][0]
                    , "grupo" => $arrayData[$i]["memberof"][0]
                    , "email" => $arrayData[$i]["mail"][0]
                );
            }
        endif;
        $this->disconnects();
        return $this->arrayData;
    }

    private function copularObject($arrayData, $rowData): ADUser {
        $OadUser = new ADUser();
        for ($i = 0; $i < $rowData; $i++) {
            $OadUser->setFullName($arrayData[$i]["name"][0]);
            $OadUser->setName($arrayData[$i]["givenname"][0]);
            $OadUser->setLastName($arrayData[$i]["sn"][0]);
            $OadUser->setInitials($arrayData[$i]["initials"][0]);
            $OadUser->setNameAuth($arrayData[$i]["samaccountname"][0]);
            $OadUser->setGroups($arrayData[$i]["memberof"][0]);
            $OadUser->setTel($arrayData[$i]["telephonenumber"][0]);
            $OadUser->setMail($arrayData[$i]["mail"][0]);
        }
        return $OadUser;
    }

    public function getAuth_msg() {
        return $this->auth_msg;
    }

    public function getIsOK() {
        return $this->isOK;
    }
}
