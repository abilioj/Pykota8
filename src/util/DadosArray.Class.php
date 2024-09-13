<?php

/**
 * Description of DadosArray
 *
 * @author Abílio José G Ferreira
 * CLASS DE ALIMENTA SELECT DE FORMULARILO
 */
class DadosArray {

    private array $dadosArray;
    private array $ArrayCampos;
    private int $intrervaloAno;
    private int $AnoInD;

    public function __construct() {
        $this->dadosArray = [];
        $this->intrervaloAno = 20;
        $this->AnoInD = 2010;
    }

    //metodo de array de CpfCnpj
    public function ArrayCpfCnpj(): array {
        $this->dadosArray = [
            ["id" => 1, "value" => "CPF"],
            ["id" => 2, "value" => "CNPJ"]
        ];
        return $this->dadosArray;
    }

    //metodo de array de Anos
    public function ArrayAnos(int $prmAnoIn): array {
        $anoIn = $prmAnoIn <= 0 ? $this->AnoInD : $prmAnoIn;
        for ($i = 0; $i <= $this->intrervaloAno; $i++):
            $this->dadosArray[] = ["id" => $anoIn + $i, "value" => $anoIn + $i];
        endfor;

        return $this->dadosArray;
    }

    //metodo de array de flag
    public function ArrayFlag(): array {
        $this->dadosArray = [
            ["id" => true, "value" => "Sim"],
            ["id" => false, "value" => "Não"]
        ];
        return $this->dadosArray;
    }

    //metodo de array de status
    public function ArrayStatus(): array {
        $this->dadosArray = [
            ["id" => 0, "value" => "Ativo"],
            ["id" => 1, "value" => "Inativo"]
        ];
        return $this->dadosArray;
    }

    //metodo de array de meses
    public function ArrayMeses(): array {
        $this->dadosArray = ['JANEIRO', 'FEVEREIRO', 'MARCO', 'ABRIL','MAIO', 'JUNHO','JULHO', 'AGOSTO', 'SETEMBRO', 'OUTUBRO', 'NOVEMBRO', 'DEZEMBRO'];
        return $this->dadosArray;
    }

    //metodo de array de meses Abreviado
    public function ArrayMesesAbreviado(): array {
        $this->dadosArray = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        return $this->dadosArray;
    }

    //metodo de array de Nivel de Acesso
    public function ArrayNivel_de_Acesso(): array {
        $this->dadosArray = [
            ["id" => 0, "value" => "Sem permição"],
            ["id" => 1, "value" => "Sem Acesso"],
            ["id" => 2, "value" => "Usuário"],
            ["id" => 3, "value" => "Administrador"],
            ["id" => 4, "value" => "Super Usuário"]
        ];
        return $this->dadosArray;
    }

    //metodo de array de tipo de Telefone
    public function ArrayTipo_de_Telefone(): array {
        $this->dadosArray = [
            ["id" => 1, "value" => "Fixo Residencial"],
            ["id" => 2, "value" => "Fixo Comercial"],
            ["id" => 3, "value" => "Ramal"],
            ["id" => 4, "value" => "Celular"],
            ["id" => 5, "value" => "Celular Comercial"]
        ];
        return $this->dadosArray;
    }

    //metodo de array de tipo de limete
    public function ArrayTipoLimite(): array {
        $this->dadosArray = [
            ["id" => "quota", "value" => "quota"],
            ["id" => "balance", "value" => "balance"],
        ];
        return $this->dadosArray;
    }

    //metodo de array de Opcao Home
    public function ArrayOpcaoHome(): array {
        $this->dadosArray = [
            ["id" => "1", "value" => "Com Grupo"],
            ["id" => "2", "value" => "Sem Grupo"],
        ];
        return $this->dadosArray;
    }

    //metodo de array de setar Campos
    public function SetArrayCampos(array $campos): void {
        $this->ArrayCampos = $campos;
    }

    //metodo de array de pegAr Campos
    public function GetArrayCampos(): array {
        return $this->ArrayCampos;
    }

}
