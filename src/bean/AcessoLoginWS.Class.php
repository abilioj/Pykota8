<?php

/**
 * Description of AcessoLoginWS
 *
 * @author Abílio José
 */
class AcessoLoginWS {

    private $id;
    private $idusuario;
    private $tempo;
    private $dataaccesslogin;
    private $isok;

    function __construct() {        
    }

    public function setDefault() {
        $d = new Data();
        $this->tempo = 1;
        $this->dataaccesslogin = $d->dataEhora_atual_en();
        $this->isok = true;
    }
    
    function getId() {
        return (int) $this->id;
    }

    function getTempo() {
        return (int) $this->tempo;
    }

    function getDataaccesslogin() {
        return $this->dataaccesslogin;
    }

    function getIdusuario() {
        return (int) $this->idusuario;
    }

    function getIsok() {
        return (bool) $this->isok;
    }

    function setId(int $id) {
        $this->id = $id;
    }

    function setTempo(int $tempo) {
        $this->tempo = $tempo;
    }

    function setDataaccesslogin($dataaccesslogin) {
        $this->dataaccesslogin = $dataaccesslogin;
    }

    function setIdusuario(int $idusuario) {
        $this->idusuario = $idusuario;
    }

    function setIsok(bool $isok) {
        $this->isok = $isok;
    }

}
