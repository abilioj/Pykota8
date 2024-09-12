<?php
/**
 * Description of NivelUsuario
 *
 * @author AJ
 */
class NivelUsuario {

    public function __construct(
        private int $id,
        private string $nome,
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }


}
