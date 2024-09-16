<?php

/**
 * Description of AcessoLoginWS
 *
 * @author Abílio José
 */
class AcessoLoginWS {

    private function __construct(
        private int $id = 0,
        private int $idusuario = 0,
        private int $tempo = 1,
        private string $dataaccesslogin = '',
        private bool $isok = true,
    ) {}

    public function setDefault() : void {
        $d = new Data();
        $this->tempo = 1;
        $this->dataaccesslogin = $d->dataEhora_atual_en();
        $this->isok = true;
    }
    
    public function getId(): int {
        return $this->id;
    }

    public function getTempo(): int {
        return $this->tempo;
    }

    public function getDataaccesslogin(): string {
        return $this->dataaccesslogin;
    }

    public function getIdusuario(): int {
        return $this->idusuario;
    }

    public function getIsok(): bool {
        return $this->isok;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setTempo(int $tempo): void {
        $this->tempo = $tempo;
    }

    function setDataaccesslogin(string $dataaccesslogin): void {
        $this->dataaccesslogin = $dataaccesslogin;
    }

    function setIdusuario(int $idusuario): void {
        $this->idusuario = $idusuario;
    }

    function setIsok(bool $isok): void {
        $this->isok = $isok;
    }
}

