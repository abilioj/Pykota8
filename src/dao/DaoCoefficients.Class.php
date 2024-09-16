<?php
/**
 * Description of DaoCoefficients
 *
 * @author abilio.jose
 */

class DaoCoefficients
{
    private DaoFull $dao;

    public function __construct()
    {
        $this->dao = new DaoFull();
        $this->dao->table = "coefficients";
    }

    public function inserir(Coefficients $obj): bool
    {
        $dado = [];
        $coluna = [];
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar(): ?MontaDados
    {
        $camposTabelas = ["c.id", "c.printerid", "c.label", "c.coefficient"];
        $nomeTabelas = ["c" => "coefficients"];
        $condicoes = [];
        $this->dao->arrayTable = $nomeTabelas;
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados !== null) {
            $obMontaDados = new MontaDados();
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(2, "../../controle/cad_OBJ.php", 7);
        } else {
            return null;
        }
    }

    public function selecionar(Coefficients $obj): Coefficients
    {
        $camposTabelas = [];
        $nomeTabelas = ["c" => "coefficients"];
        $condicoes = [];
        $this->dao->arrayTable = $nomeTabelas;
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d !== null) {
            $obj->setId($d->dado[0]);
        }
        return $obj;
    }

    public function PegarUltimoId(): int
    {
        $camposTabelas = [];
        $nomeTabelas = ["c" => "coefficients"];
        $condicoes = [];
        $this->dao->arrayTable = $nomeTabelas;
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
        if ($d !== null) {
            $Id = $d->dado[0];
        } else {
            $Id = 0;
        }
        return $Id;
    }

    public function alterar(Coefficients $obj): bool
    {
        $dado = [];
        $camposTabelas = [];
        $where = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull(array $dado, array $camposTabelas, string $where): bool
    {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull(string $where): bool
    {
        $this->dao->table = ["c" => "coefficients"];
        return $this->dao->Verificar($where, null);
    }

    public function excluir(Coefficients $obj): bool
    {
        $where = [];
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }
}
