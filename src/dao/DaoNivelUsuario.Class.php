<?php
/**
 * Description of DaoNivelUsuario
 *
 * @author abilio.jose
 */
class DaoNivelUsuario {
 
    private $dao;
    private $colunas;
    private $colunasAS;
    private $colunasAS_Lista;

    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "nivel_usuario";
        $this->colunas = array("tipo_nivel");
        $this->colunasAS = array("n.tipo_nivel","n.id_nivel");
        $this->colunasAS_Lista = array("n.tipo_nivel","n.id_nivel");
    }

    public function inserir(NivelUsuario $obj) {
        $dado = array($obj->getNome());
        $coluna = $this->colunas;
        return $this->dao->inserir($dado, $coluna, null);
    }

    public function Listar() {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("n" => "nivel_usuario");
        $condicoes = null;//array();
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "tipo_nivel", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(2, "../../controle/cad_NivelUsuario.php", 2, "");
        } else {
            return null;
        }
    }

    public function ListarToFone() {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("n" => "nivel_usuario");
        $condicoes = null;
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "tipo_nivel", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            $obMontaDados->CampoData = $campoData;
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->ArrayCamposOcutar = null;
            $obMontaDados->dados = $arrayDados;
            return $obMontaDados->deListar(2, "../../controle/cad_NivelUsuario.php", 0, "");
        } else {
            return null;
        }
    }
    
    public function selecionar(NivelUsuario $obj) {
        $camposTabelas = $this->colunasAS;
        $nomeTabelas = array("n" => "nivel_usuario");
        $condicoes = array("n.id_nivel = " . $obj->getID() . " ");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj = new NivelUsuario($obj->getId(), $d->dado[0]);
        } else {
            $obj = new NivelUsuario(0, "");
        }
        return $obj;
    }

    public function alterar(NivelUsuario $obj) {
        $dado = array($obj->getNome());
        $camposTabelas = array("tipo_nivel");
        $where = "id_nivel = " . $obj->getId() . " ";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where) {
        $this->dao->arrayTable = array("n" => "nivel_usuario");
        return $this->dao->Verificar($where, null);
    }

    public function excluir(NivelUsuario $obj) {
        $where = array("id_nivel = " . $obj->getIDNIVEL() . " ");
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }
}
