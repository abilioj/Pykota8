<?php

/**
 * Description of DadosArray
 *
 * @author Abílio José G Ferreira
 * CLASS DE ALIMENTA SELECT DE FORMULARILO
 */
class DadosArray {

    private $dadosArray;
    private $ArrayCampos;
    private $intrervaloAno;
    private $AnoInD;

    function __construct() {
        $this->dadosArray = null;
        $this->intrervaloAno = 20;
        $this->AnoInD = 2010;
    }

    //metodo de array de CpfCnpj
    public function ArrayCpfCnpj() : array {
        $this->dadosArray = array(
            array("id" => 1, "value" => "CPF"),
            array("id" => 2, "value" => "CNPJ")
        );
        return $this->dadosArray;
    }

    //metodo de array de Anos
    public function ArrayAnos(int $prmAnoIn) : array {
        if($prmAnoIn == null || $prmAnoIn <= 0):
            $anoIn = (int) $this->AnoInD;
        else:
            $anoIn = (int) $prmAnoIn;
        endif;
        for ($i = 0; $i <= $this->intrervaloAno; $i++):
            $this->dadosArray[] = array("id" => $anoIn + $i, "value" => $anoIn + $i);
        endfor;

        return $this->dadosArray;
    }

    //metodo de array de flag
    public function ArrayFlag() : array {
        $this->dadosArray = array(
            array("id" => true, "value" => "Sim"),
            array("id" => false, "value" => "Não")
        );
        return $this->dadosArray;
    }

    //metodo de array de status
    public function ArrayStatus() : array {
        $this->dadosArray = array(
            array("id" => 0, "value" => "Ativo"),
            array("id" => 1, "value" => "Inativo")
        );
        return $this->dadosArray;
    }

    //metodo de array de meses
    public function ArrayMeses() : array {
        $this->dadosArray = array('JANEIRO', 'FEVEREIRO', 'MARCO', 'ABRIL','MAIO', 'JUNHO','JULHO', 'AGOSTO', 'SETEMBRO', 'OUTUBRO', 'NOVEMBRO', 'DEZEMBRO');
        return $this->dadosArray;
    }

    //metodo de array de meses Abreviado
    public function ArrayMesesAbreviado() : array {
        $this->dadosArray = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
        return $this->dadosArray;
    }

    //metodo de array de Nivel de Acesso
    public function ArrayNivel_de_Acesso() : array {
        $this->dadosArray = array(
            array("id" => 0, "value" => "Sem permição"),
            array("id" => 1, "value" => "Sem Acesso"),
            array("id" => 2, "value" => "Usuário"),
            array("id" => 3, "value" => "Administrador"),
            array("id" => 4, "value" => "Super Usuário")
        );
        return $this->dadosArray;
    }

    //metodo de array de tipo de Telefone
    public function ArrayTipo_de_Telefone() : array {
        $this->dadosArray = array(
            array("id" => 1, "value" => "Fixo Residencial"),
            array("id" => 2, "value" => "Fixo Comercial"),
            array("id" => 3, "value" => "Ramal"),
            array("id" => 4, "value" => "Celular"),
            array("id" => 5, "value" => "Celular Comercial")
        );
        return $this->dadosArray;
    }

    //metodo de array de tipo de limete
    public function ArrayTipoLimite() : array {
        $this->dadosArray = array(
            array("id" => "quota", "value" => "quota"),
            array("id" => "balance", "value" => "balance"),
        );
        return $this->dadosArray;
    }

    //metodo de array de Opcao Home
    public function ArrayOpcaoHome() : array {
        $this->dadosArray = array(
            array("id" => "1", "value" => "Com Grupo"),
            array("id" => "2", "value" => "Sem Grupo"),
        );
        return $this->dadosArray;
    }

    //metodo de array de setar Campos
    public function SetArrayCampos($campos) : array {
        $this->ArrayCampos = $campos;
    }

    //metodo de array de pegAr Campos
    public function GetArrayCampos() : array {
        return $this->ArrayCampos;
    }

}