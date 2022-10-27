<?php

/**
 * Description of CotasUser
 *
 * @author abilio.jose
 */
class CotasUser {
    
    private $pkuser;
    private $LimiteSetor;
    private $pkgroup;
    
    function __construct(int $pkuser,int $LimiteSetor,int $pkgroup) {
        $this->pkuser = (int) $pkuser;
        $this->LimiteSetor = (int) $LimiteSetor;
        $this->pkgroup = (int) $pkgroup;
    }

    function getPkuser() : int {
        return (int) $this->pkuser;
    }

    function getLimiteSetor() : int {
        return (int) $this->LimiteSetor;
    }

    function getPkgroup() : int {
        return (int) $this->pkgroup;
    }

}
