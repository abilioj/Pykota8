<?php

/**
 * Description of ResponGroups
 *
 * @author abilio.jose
 */
class ResponGroups {
    
    private $id_user;
    private $id_user_res;
    private $id_group;
    
    public function __construct($id_user, $id_user_res, $id_group) {
        $this->id_user = $id_user;
        $this->id_user_res = $id_user_res;
        $this->id_group = $id_group;
    }

    public function getId_user() {
        return $this->id_user;
    }

    public function getId_user_res() {
        return $this->id_user_res;
    }

    public function getId_group() {
        return $this->id_group;
    }

}
