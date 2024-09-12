<?php

/**
 * Description of ResponGroups
 *
 * @author abilio.jose
 */
class ResponGroups {

    public function __construct(
        private int $id_user,
        private int $id_user_res,
        private int $id_group,
    ) {}

    public function getId_user(): int {
        return $this->id_user;
    }

    public function getId_user_res(): int {
        return $this->id_user_res;
    }

    public function getId_group(): int {
        return $this->id_group;
    }

}
