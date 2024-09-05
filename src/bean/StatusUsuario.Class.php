<?php
/**
 * Description of StatusUsuario
 *
 * @author AJ
 */
class StatusUsuario {

    private $IDSTATUS;
    private $TIPOSTATUS;
    
    function __construct($IDSTATUS, $TIPOSTATUS) {
        $this->IDSTATUS = $IDSTATUS;
        $this->TIPOSTATUS = $TIPOSTATUS;
    }

    function getIDSTATUS() {
        return $this->IDSTATUS;
    }

    function getTIPOSTATUS() {
        return $this->TIPOSTATUS;
    }

}
