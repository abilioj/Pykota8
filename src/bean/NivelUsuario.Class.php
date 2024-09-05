<?php
/**
 * Description of NivelUsuario
 *
 * @author AJ
 */
class NivelUsuario {
    
    private $id;
    private $nome;

    function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }


}
