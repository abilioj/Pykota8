<?php

function config() {
    
}

function authUser($Service,$id): bool {
    if($id != 0 && !is_null($Service)):
        $_SESSION['idusu' . $Service->getNameSESSION() . ''] = $id;
        return true;
    else:
        return false;
    endif;
}

function logout($Service) {
    if (isset($_SESSION['idusu' . $Service->getNameSESSION() . ''])) {
        unset($_SESSION['idusu' . $Service->getNameSESSION() . '']);
    }
}

function logoutAll() {
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
}