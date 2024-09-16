<?php
/**
 * Description of DaoTabGeneric
 *
 * @author abilio.jose
 */
class DaoTabGeneric {

    private $dao;

    function __construct() {
        $this->dao = new DaoFull();
    }

    public function ListarHome() {
        $camposTabelas = array('u.username', 'g.groupname', 'p.printername');
        $nomeTabelas = array('u' =>  'users', 'g' => 'groups', 'gm' => 'groupsmembers','us' => 'userpquota', 'p' => 'printers');
        $condicoes[] =array('gm.userid = u.id' , 'gm.groupid = g.id' , 'us.userid = u.id' , 'us.printerid = p.id');        
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "u.username", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(1, "", 0, "");
        } else {
            return null;
        }
    }

    public function ListarGroup() {
        $camposTabelas = array('u.username', 'g.groupname', 'p.printername');
        $nomeTabelas = array('u' =>  'users', 'g' => 'groups', 'gm' => 'groupsmembers','us' => 'userpquota', 'p' => 'printers');
        $condicoes[] =array('gm.userid = u.id' , 'gm.groupid = g.id' , 'us.userid = u.id' , 'us.printerid = p.id');        
        $this->dao->arrayTable = $nomeTabelas;
        //$camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $arrayTO
        $arrayDados = $this->dao->listar($camposTabelas, $condicoes, "u.username", "ASC", null, null, NULL);
        if ($arrayDados != null) {
            $objMontaDados = new MontaDados;
            $objMontaDados->colunas = $camposTabelas;
            $objMontaDados->dados = $arrayDados;
            return $objMontaDados->deListar(1, "", 0, "");
        } else {
            return null;
        }
    }
}
