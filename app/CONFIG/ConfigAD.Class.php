<?php
/**
 * Description of ConfigADClass
 *
 * @author Abílio José
 */
class ConfigADClass {
    
    private $hostServer;
    private $dnsname;
    private $user_auth;
    private $pwd_auth;
    private $port;
    private $stn_User_authentication;
    private $filter_ad;
    private $group_ad;
    private $isOk;
    private $op;
    
    public function __construct() {
//        $this->hostServer = '192.168.0.252';
//        $this->dnsname = 'ajgfad.local';
//        $this->user_auth = 'Administrator';
//        $this->pwd_auth = '4PjB0G1A';
//        $this->group_ad = 'OU=People,DC=ajgfad,DC=local';
//        $this->port = 389;
//----------------------------------------------------------        
        $this->hostServer = '10.1.1.225';
        $this->dnsname = 'HUANA.LOCAL';
        $this->user_auth = 'abilio.jose';
        $this->pwd_auth = 'ajf*3101';
        $this->group_ad = 'OU=People,DC=HUANA,DC=LOCAL';
        $this->port = 389;
//----------------------------------------------------------  
        $this->filter_ad = '(&(objectClass=user)(objectCategory=person)(displayname=*)';
        $this->isOk = FALSE;
        $this->op = 1;
    }
    
    public function getHostServer() {
        return $this->hostServer;
    }

    public function getDnsname() {
        return $this->dnsname;
    }

    public function getUser_auth() {
        return $this->user_auth;
    }

    public function getPwd_auth() {
        return $this->pwd_auth;
    }

    public function getPort() {
        return $this->port;
    }

    public function getStn_User_authentication() {
        return $this->stn_User_authentication;
    }

    public function getFilter_ad() {
        return $this->filter_ad;
    }

    public function getGroup_ad() {
        return $this->group_ad;
    }

    public function getIsOk() {
        return $this->isOk;
    }

    public function getOp() {
        return $this->op;
    }

    public function setUser_auth($user_auth) {
        $this->user_auth = $user_auth;
    }

    public function setPwd_auth($pwd_auth) {
        $this->pwd_auth = $pwd_auth;
    }

}
