<?php

/**
 * Description of CotasUser
 *
 * @author abilio.jose
 */
class CotasUser {
    
    public function __construct(
        private int $pkuser,
        private int $LimiteSetor,
        private int $pkgroup,
    ) {
        $this->pkuser = $pkuser;
        $this->LimiteSetor = $LimiteSetor;
        $this->pkgroup = $pkgroup;
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

