<?php

/**
 * Description of DaoIPPrinter
 *
 * @author abilio.jose
 */
class DaoIPPrinter {
    
    private $dao;
// ip, nome, tipo
    function __construct() {
        $this->dao = new DaoFull();
        $this->dao->table = "ip_printers";
    }

    public function inserir(IPPrinter $obj): bool {
        $dado = array($obj->getId_printer(),$obj->getIp());
        $coluna = array("id_printer","ip");
        return $this->dao->inserir($dado, $coluna, null);
    }

//    sem uso
    public function Listar(): string|null {
        $camposTabelas = array();
        $nomeTabelas = array();
        $condicoes = null;//array();
        $this->dao->table = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, null, "ASC", null, null, null);
        if ($arrayDados != null) {
            $obMontaDados = new MontaDados;
            $obMontaDados->CampoData = array(0 => "");
            $obMontaDados->colunas = $camposTabelas;
            $obMontaDados->dados = $arrayDados;;
            return $obMontaDados->deListar(2, "../../Controle/cad_OBJ.php", 7, "");
        } else {
            return null;
        }
    }

    //sem uso
    public function selecionar(IPPrinter $obj) : IPPrinter {
        $camposTabelas = array();
        $nomeTabelas = array();
        $condicoes = null;//array();
        $this->dao->table = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $obj->setId_printer($d->dado[0]);
        } else {

        }
        return $obj;
    }

    public function getIpPorIdPrintrer(int $id) : string {
        $camposTabelas = array("ipp.ip");
        $nomeTabelas = array("ipp" => "ip_printers","p" => "printers");
        $condicoes = array("ipp.id_printer=p.id","ipp.id_printer = {$id}");
        $this->dao->arrayTable = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        if ($d != null) {
            $ip = $d->dado[0];
        } else {
            $ip = '0.0.0.0';
        }
        return $ip;
    }

    public function selecionarPorIp(string $ip):Dados|null {
        $camposTabelas = array("p.id","p.printername");
        $nomeTabelas = array("ipp" => "ip_printers","p" => "printers");
        $condicoes = array("ipp.id_printer=p.id","ipp.ip = '{$ip}'");
        $this->dao->table = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, null, null, null, null, null);
        return $d;
    }

    public function returnNome(string $ip) : string {
        $stn = "";
        $camposTabelas = array("p.printername");
        $nomeTabelas = array("ipp" => "ip_printers","p" => "printers");
        $condicoes = array("ipp.id_printer=p.id","ipp.ip = '{$ip}'");
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, NULL, NULL, 1, NULL, NULL);
        if ($d != null) {
            $stn = $d->dado[0];
        }
        return $stn;
    }

    public function PegarUltimoId(): int {
        $camposTabelas = array();
        $nomeTabelas = array();
        $condicoes = NULL;
        $this->dao->table = $nomeTabelas;
//$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP,$ArrayTo
        $d = $this->dao->selecionar($camposTabelas, $condicoes, "", "DESC", 1, null, null);
        if ($d != null) {
            $Id = $d->dado[0];
        } else {
            $Id = 0;
        }
        return $Id;
    }

    public function alterar(IPPrinter $obj): bool {
        $dado = array();
        $camposTabelas = array();
        $where = "";
        if ($this->dao->Atualizar($dado, $camposTabelas, $where, null)) {
            return true;
        } else {
            return false;
        }
    }

    public function fucaoAtualizarDefull($dado, $camposTabelas, $where) {
        return $this->dao->Atualizar($dado, $camposTabelas, $where, null);
    }

    public function fucaoVerificarDefull($where)  : bool {
        $this->dao->arrayTable = array("ipp" => "ip_printers");
        return $this->dao->Verificar($where, null);
    }

    //sem uso
    public function excluir($obj) : bool {
        $where = array();
        if ($this->dao->excluir($where, null)) {
            return true;
        } else {
            return false;
        }
    }

}