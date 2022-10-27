<?php

/**
 * Description of PageHTML
 *
 * @author AJGF
 */
class PageHTML {

    private $string;
    private $ImputDisabled;
    private $btnForn;
    private $block;
    private $clear;

    function __construct() {
        $this->string = "";
        $this->ImputDisabled = "";
        $this->btnForn = "";
    }

    private function htmBtnForm(int $paramOp) {
        if ($paramOp <= 1):
            $this->block = "BLOCK_BTNs";
            $this->clear = "BLOCK_BTNv";
        else:
            $this->block = "BLOCK_BTNv";
            $this->clear = "BLOCK_BTNs";
        endif;
    }

    private function PageForm(int $paramOp, string $paramName): string {
        $this->string = (string) "";
        switch ($paramOp):
            case -1:
                $this->string = "Para Teste";
                break;
            case 0 :
                $this->string = "Cadastro de " . $paramName;
                break;
            case 1 :
                $this->string = "Alterar de " . $paramName;
                break;
            case 2 :
                $this->ImputDisabled = "disabled";
                $this->string = "Visualizando " . $paramName;
                break;
            case 3 :
                $this->ImputDisabled = "disabled";
                $this->string = "Sua Conta";
                break;
            case 4 :
                $this->string = "Alterar Senha do " . $paramName;
                break;
            case 5 :
                $this->string = "Alterar Imagem do " . $paramName;
                break;
            default :
                $this->string = "";
                break;
        endswitch;
        return $this->string;
    }

    private function PageList(string $paramName): string {
        $this->string = (string) "Lista de " . $paramName . "";
        return $this->string;
    }

    public function OPNamePage(int $paramOp, string $paramName, string $paramaAcao): string {
        switch ($paramaAcao):
            case "f" :
                $this->htmBtnForm($paramOp);
                $this->string = $this->PageForm($paramOp, $paramName);
                break;
            case "l" :
                $this->string = $this->PageList($paramName);
                break;
            case "t":
                $this->string = "Para Teste";
                break;
            default :
                $this->string = "";
                break;
        endswitch;
        return $this->string;
    }

    public function data_field_type(int $paramOpNav) {
        if ($paramOpNav == 2):
            $this->block="CAMP_DATA2";
            $this->clear="CAMP_DATA";
        else:
            $this->block="CAMP_DATA";
            $this->clear="CAMP_DATA2";
        endif;
    }

    /*
     * abilitar o disabled no campo
     * se for ativado a condição no metodo PageForm
     */
    public function getImputDisabled() : string {
        return $this->ImputDisabled;
    }

    public function getBlock() : string {
        return $this->block;
    }

    public function getClear() : string {
        return $this->clear;
    }

    public function getString() : string {
        return $this->string;
    }

    public function setString($string) {
        $this->string = $string;
    }

}
