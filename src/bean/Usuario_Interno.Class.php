<?php

class Usuario_Interno
{

    public function __construct(
        private int $ID_USUARIO,
        private int $ID_USERS,
    ) {
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
