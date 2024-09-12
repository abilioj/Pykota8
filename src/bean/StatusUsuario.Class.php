<?php
/**
 * Description of StatusUsuario
 *
 * @author AJ
 */
class StatusUsuario {

    public function __construct(
        private int $IDSTATUS,
        private string $TIPOSTATUS,
    ) {}

    public function getIDSTATUS(): int {
        return $this->IDSTATUS;
    }

    public function getTIPOSTATUS(): string {
        return $this->TIPOSTATUS;
    }

}
