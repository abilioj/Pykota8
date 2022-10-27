<?php

class Usuario_Interno {
    
    private $ID_USUARIO;
    private $ID_USERS;
    
    function __construct(int $ID_USUARIO, int $ID_USERS) {
        $this->ID_USUARIO = $ID_USUARIO;
        $this->ID_USERS = $ID_USERS;
    }

    public function getID_USUARIO() : int {
        return (int) $this->ID_USUARIO;
    }

    public function getID_USERS() : int {
        return (int) $this->ID_USERS;
    }

}