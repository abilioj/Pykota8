<?php

/**
 * Description of SqlRules
 *
 * @author abilio.jose
 */
class SqlRules {

    private $stnSQL;
    private $ClassSQL;

    function __construct() {
        $this->ClassSQL = new Sql(null);
        $this->stnSQL = null;
    }

    function getStnSQL(): string {
        return (string) $this->stnSQL;
    }

    function sqlEstatisticaMesal(string $stnAno): string {
        $sql_tb = "select sum(case when extract(month from a.jobdate)=1 then a.jobsize else 0 end) JANEIRO,"
                . "sum(case when extract(month from a.jobdate)=2 then a.jobsize else 0 end) FEVEREIRO,"
                . "sum(case when extract(month from a.jobdate)=3 then a.jobsize else 0 end) MARCO,"
                . "sum(case when extract(month from a.jobdate)=4 then a.jobsize else 0 end) ABRIL,"
                . "sum(case when extract(month from a.jobdate)=5 then a.jobsize else 0 end) MAIO,"
                . "sum(case when extract(month from a.jobdate)=6 then a.jobsize else 0 end) JUNHO,"
                . "sum(case when extract(month from a.jobdate)=7 then a.jobsize else 0 end) JULHO,"
                . "sum(case when extract(month from a.jobdate)=8 then a.jobsize else 0 end) AGOSTO,"
                . "sum(case when extract(month from a.jobdate)=9 then a.jobsize else 0 end) SETEMBRO,"
                . "sum(case when extract(month from a.jobdate)=10 then a.jobsize else 0 end) OUTUBRO,"
                . "sum(case when extract(month from a.jobdate)=11 then a.jobsize else 0 end) NOVEMBRO,"
                . "sum(case when extract(month from a.jobdate)=12 then a.jobsize else 0 end) DEZEMBRO"
                . " from jobhistory a where a.action='ALLOW' and a.jobdate between '" . $stnAno . "-01-01' and '" . $stnAno . "-12-31' ;";
        return $sql_tb;
    }

    // -- LIST HOME
    public function sqlHome($conditions): string {
        $this->ClassSQL->arrayTable = array('u' => 'users', 'g' => 'groups', 'gm' => 'groupsmembers', 'us' => 'userpquota', 'p' => 'printers');
        $this->ClassSQL->camposTabelas = array('u.username as usuario', 'g.groupname as grupo', 'p.printername as impressora', 'u.id as idu', 'g.id as idg', 'p.id as idp');
        $this->ClassSQL->condicoesTabela = array('gm.userid = u.id', 'gm.groupid = g.id', 'us.userid = u.id', 'us.printerid = p.id');
        $this->ClassSQL->conditions = $conditions;
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //-- page home --lista todos os usuarios na home que estão usando normamente o pykota - ok
    public function sqlHomeUsers($conditions): string {
        $this->ClassSQL->arrayTable = array('u' => 'users');
        $this->ClassSQL->camposTabelas = array('u.username as usuario', 'g.groupname as grupo', 'p.printername as impressora', 'u.id as idu', 'g.id as idg', 'p.id as idp');
        $this->ClassSQL->condicoesTabela = array('uc.id is not null', 'g.id is not null');
        $this->ClassSQL->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id', ' left join groups g on gm.groupid=g.id'
            , ' left join userpquota uc on uc.userid=u.id', ' left join "Cotas_User" cu on cu.pkgroup=g.id'
            , 'left join printers p on p.id=uc.printerid', ' left join users u2 on u2.id=cu.pkuser');
        $this->ClassSQL->GroupBY = array('g.id', 'uc.id', 'p.id', 'u.id', 'u.username', 'g.groupname', 'p.printername');
        $this->ClassSQL->conditions = $conditions;
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //-- page home --lista todos os usuarios na home que estão usando normamente o pykota - ok
    public function sqlHomeUsersII($conditions): string {
        $this->ClassSQL->arrayTable = array('u' => 'users');
        $this->ClassSQL->camposTabelas = array('u.username as usuario', "coalesce(g.groupname,'0') as grupo", 'p.printername as impressora', 'uc.softlimit as limite', 'uc.pagecounter as cota', 'u.id as idu', 'g.id as idg', 'p.id as idp');
        $this->ClassSQL->condicoesTabela = array('uc.id is not null');
        $this->ClassSQL->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id', ' left join groups g on gm.groupid=g.id'
            , ' left join userpquota uc on uc.userid=u.id', ' left join "Cotas_User" cu on cu.pkgroup=g.id', 'left join printers p on p.id=uc.printerid');
        $this->ClassSQL->GroupBY = array('g.id', 'uc.id', 'p.id', 'u.id', 'u.username', 'p.printername');
        $this->ClassSQL->conditions = $conditions;
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //-- page home -- 
    public function sqlHomeUsersBalance($conditions): string {
        $this->ClassSQL->arrayTable = array('u' => 'users');
        $this->ClassSQL->camposTabelas = array(
            "u.username as usuario"
            , "coalesce(g.groupname,'0') as grupo"
            , "u.balance as limite"
            , "u.limitmonth as limiteMensal", "u.id as idu");
        $this->ClassSQL->condicoesTabela = array();
        $this->ClassSQL->conditionsLeftJoin = array("left join groupsmembers gr on u.id = gr.userid", "left join groups g on g.id = gr.groupid ");
        $this->ClassSQL->GroupBY = array('u.id', 'u.username', 'u.balance', 'u.limitmonth', 'gr.userid', 'g.groupname');
        $this->ClassSQL->condicoesTabela = $conditions;
//        $this->ClassSQL->conditions = $conditions;
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //--  -- uma da fumnção é pego os dados de cota de usuarios - ok
    public function sqlHomeVerCota($conditions): string {
        $this->ClassSQL->arrayTable = array('u' => 'users', 'up' => 'userpquota', 'p' => 'printers');
        $this->ClassSQL->camposTabelas = array('u.id as pkuser', 'p.id as pkprinter', 'p.printername as print'
            , 'u.username as usern', 'up.softlimit as softl', 'up.hardlimit as hardl', 'up.pagecounter as pagec', 'up.lifepagecounter as lifep');
        $this->ClassSQL->condicoesTabela = array('u.id=up.userid', 'up.printerid=p.id');
        $this->ClassSQL->conditions = $conditions;
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    // -- -- lista todos usuarios do grupo destalhando as cotas por impressao - ok
    public function sqlVerGrupoFindIDgroupAll(int $idGroup): string {
        $this->stnSQL = "select uc.id as id,u.id as idu,g.id as idg, p.id as idi,u.username as usuario,g.groupname as grupo,"
                . "uc.softlimit as limite,uc.pagecounter as consumido, uc.softlimit - uc.pagecounter as disponivel , p.printername as impressora "
                . " from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id left join printers p on uc.printerid = p.id "
                . " left join \"Cotas_User\" cu on cu.pkgroup=g.id left join users u2 on u2.id=cu.pkuser"
                . " where g.groupname is not null and g.id = {$idGroup} order by u.username;";
        return $this->stnSQL;
    }

    // -- -- lista todos usuarios do grupo destalhando as cotasas cotas por impressao - ok
    public function sqlVerGrupoFindIDgroup(int $idGroup): string {
        $this->stnSQL = "select uc.id as id,u.id as idu,g.id as idg, p.id as idi,u.username as usuario,g.groupname as grupo,"
                . "uc.softlimit as limite,uc.pagecounter as consumido, uc.softlimit - uc.pagecounter as disponivel , p.printername as impressora "
                . " from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id left join printers p on uc.printerid = p.id "
                . " left join \"Cotas_User\" cu on cu.pkgroup=g.id left join users u2 on u2.id=cu.pkuser"
                . " where g.groupname is not null and g.id = {$idGroup}  and uc.softlimit != -1  order by u.username;";
        return $this->stnSQL;
    }

    // -- -- lista todos usuarios do grupo destalhando as cotas por Usuario 
    public function sqlVerGrupoFindIDgroupUsers(int $idGroup): string {
        return $this->stnSQL;
    }

    public function sqlVerGrupoFindIDgroupUsersBalance(int $idGroup): string {
        $this->ClassSQL->arrayTable = array("u" => "users");
        $this->ClassSQL->camposTabelas = array("u.id as idu", "u.username as usuario", "sum(uc.pagecounter) as consumido", "u.balance as balance", "u.limitmonth");
        $this->ClassSQL->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id', ' left join groups g on gm.groupid=g.id', ' left join userpquota uc on uc.userid=u.id', ' left join "Cotas_User" cu on cu.pkgroup=g.id', ' left join users u2 on u2.id=cu.pkuser');
        $this->ClassSQL->condicoesTabela = array("g.groupname is not null", "g.id = " . $idGroup . "");
        $this->ClassSQL->GroupBY = array("u.id");
        $this->ClassSQL->colunaOrdenada = "u.username";
        $this->ClassSQL->ordenacao = "ASC";
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    // -- -- //lista todos usuarios do grupo destalhando as cotas
    public function sqlSelctUserCotas(int $idUser, int $idPrinter): string {
        $this->stnSQL = "select uc.id as id,u.id as idu,g.id as idg, p.id as idi,u.username as usuario,g.groupname as grupo,"
                . "uc.softlimit as limite,uc.pagecounter as consumido, uc.softlimit - uc.pagecounter as disponivel "
                . ", p.printername as impressora "
                . " from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id "
                . "left join userpquota uc on uc.userid=u.id left join printers p on uc.printerid = p.id "
                . " left join \"Cotas_User\" cu on cu.pkgroup=g.id left join users u2 on u2.id=cu.pkuser"
                . " where g.groupname is not null and uc.userid = {$idUser} and uc.printerid = {$idPrinter} order by u.username;";
        return $this->stnSQL;
    }

    //
    public function sqlVerGrupoFindIDgroupII(int $idGroup, int $idUser): string {
        $this->ClassSQL->camposTabelas = array('g.id', 'g.groupname as grupo', '"LimiteSetor" as limite', 'sum(uc.pagecounter) as consumidoTotal', '"LimiteSetor" - sum(uc.pagecounter) as disponivel');
        $this->ClassSQL->arrayTable = array('u' => 'users');
        $this->ClassSQL->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id', 'left join groups g on gm.groupid=g.id'
            , 'left join userpquota uc on uc.userid=u.id', 'left join "Cotas_User" cu on pkgroup=g.id'
            , 'left join printers p on p.id=uc.printerid', 'left join users u2 on u2.id=pkuser');
        $this->ClassSQL->condicoesTabela = array('g.groupname is not null', 'u2.username is not null');
        $this->ClassSQL->conditions = array('u2.id=' . $idUser . '', 'g.id=' . $idGroup . '');
        $this->ClassSQL->GroupBY = array('"LimiteSetor"', 'g.groupname', 'g.id');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    // lista todos os grupos de determinado usuario que administrar
    public function sqlListContasFindIDUsers(int $idu): string {
        $this->stnSQL = 'Select g.groupname as grupo, u.username as usuario, "LimiteSetor", g.id as idg, u.id as idu'
                . ' from "Cotas_User" as cu,groups as g, users as u'
                . ' where cu.pkgroup=g.id and cu.pkuser = u.id and u.id = ' . $idu . ' ;';
        return $this->stnSQL;
    }

    // lista todos os grupos de determinado usuario que administrar
    public function sqlListContasFindIDUserIDGroups(int $idG, int $idU): string {
        $this->stnSQL = 'Select g.groupname as grupo, u.username as usuario, "LimiteSetor", g.id as idg, u.id as idu'
                . ' from "Cotas_User" as cu,groups as g, users as u, respongroups as r '
                . 'where cu.pkgroup=g.id and cu.pkuser = u.id and r.id_user_res = cu.pkuser and r.id_group=cu.pkgroup and u.id = ' . $idU . ' or r.id_user=' . $idU . ''
                . 'group by g.groupname, u.username, "LimiteSetor", g.id, u.id;';
        return $this->stnSQL;
    }

    // -- page de detalhes de grupos  -- mostra os detalhes geral do grupo, por exemplo o nome do resposavel  - ok
    public function sqlDetalheGeraisDeGrupos(int $id, array $conditions) {
        $this->ClassSQL->arrayTable = array('gm' => 'groupsmembers');
        $this->ClassSQL->camposTabelas = array('uc.username as reponsavel', 'g.id as id', 'g.groupname as grupo', '"LimiteSetor" as limitesetor'
            , '(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as limitesetoratual'
            , '(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as consumidoatuado'
            , '(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )'
            . '-(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as disponivel'
            , '"LimiteSetor"-(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as disponivelgeral'
        );
        $this->ClassSQL->conditionsLeftJoin = array('left join users u on u.id=gm.userid', 'left join  groups g on g.id=gm.groupid', 'left join  userpquota q on q.userid=u.id'
            , ' left join  "Cotas_User" cu on cu.pkgroup=g.id', 'left join  printers p on p.id=q.printerid', 'left join  users uc on uc.id=cu.pkuser');
        $this->ClassSQL->condicoesTabela = array('"LimiteSetor" is not null', 'pkgroup=' . $id . '');
        if ($conditions != null)
            $this->ClassSQL->conditions = $conditions;
        $this->ClassSQL->GroupBY = array('uc.username', 'g.groupname', 'g.id', 'cu."LimiteSetor"', 'limitesetoratual', 'consumidoatuado', 'disponivel', 'disponivelgeral');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //
    public function sqlDetalheGeraisDeGruposBalance(int $id, array $conditions) {
        $this->ClassSQL->arrayTable = array('gm' => 'groupsmembers');
        $this->ClassSQL->camposTabelas = array('uc.username as reponsavel', 'g.id as id', 'g.groupname as grupo', '"LimiteSetor" as limitesetor'//ok
            , '(select sum(u1.limitmonth) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as limitesetoratual'//ok usado
            , '(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as consumidoatuado' //ok
            , '"LimiteSetor" - (select sum(u1.limitmonth) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )'
//            . '-(select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )'
            . ' as disponivel'
            , '"LimiteSetor"-(select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid  where g1.id=g.id group by g1.id ) as disponivelgeral'
        );
        $this->ClassSQL->conditionsLeftJoin = array('left join users u on u.id=gm.userid', 'left join  groups g on g.id=gm.groupid', 'left join  userpquota q on q.userid=u.id'
            , ' left join  "Cotas_User" cu on cu.pkgroup=g.id', 'left join  printers p on p.id=q.printerid', 'left join  users uc on uc.id=cu.pkuser');
        $this->ClassSQL->condicoesTabela = array('"LimiteSetor" is not null', 'pkgroup=' . $id . '');
        if ($conditions != null)
            $this->ClassSQL->conditions = $conditions;
        $this->ClassSQL->GroupBY = array('uc.username', 'g.groupname', 'g.id', 'cu."LimiteSetor"', 'limitesetoratual', 'consumidoatuado', 'disponivel', 'disponivelgeral');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //
    public function sqlDetalheCotasDeGrupos(int $id, array $conditions) {
        $this->ClassSQL->arrayTable = array('gm' => 'groupsmembers');
        $this->ClassSQL->camposTabelas = array('g.id as idg', 'u.id as idu', 'p.id as idi', 'g.groupname as grupo', '"LimiteSetor" as limitesetor', 'u.username as usuario'
            , 'p.printername as impressora', 'q.softlimit as limiteusuario', 'q.pagecounter as consumido'
            , '(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as limitesetoratual'
            , '(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as consumidoatuado'
            , '"LimiteSetor"-(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as diferenca'
            , '"LimiteSetor"-(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as diferencasolimit'
        );
        $this->ClassSQL->conditionsLeftJoin = array('left join users u on u.id=gm.userid', 'left join groups g on g.id=gm.groupid'
            , 'left join userpquota q on q.userid=u.id', 'left join "Cotas_User" cu on pkgroup=g.id', 'left join printers p on p.id=q.printerid');
        $this->ClassSQL->condicoesTabela = array('"LimiteSetor" is not null', 'pkgroup=' . $id . '');
        if ($conditions != NULL):
            $this->ClassSQL->conditions = $conditions;
        endif;
        $this->ClassSQL->GroupBY = array('g.groupname', '"LimiteSetor"', 'u.username', 'p.printername', 'limiteusuario', 'q.pagecounter', 'g.id', 'u.id', 'p.id');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //cosumo do grupo
    public function sqlVerCosumoGrupo(int $id) {
        $this->ClassSQL->arrayTable = array('uq1' => 'userpquota');
        $this->ClassSQL->camposTabelas = array('sum(uq1.pagecounter) as somaconsumido');
        $this->ClassSQL->conditionsLeftJoin = array('left join users u1 on u1.id=uq1.userid'
            , ' left join groupsmembers gm1 on gm1.userid=u1.id', ' left join groups g1 on g1.id=gm1.groupid');
        $this->ClassSQL->condicoesTabela = array('g1.id=' . $id . '');
        //$this->ClassSQL->conditions = $arrayWhere;
        $this->ClassSQL->GroupBY = array('g1.id');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //limite de grupo
    public function sqlVerLimiteGrupo(int $id) {
        $this->ClassSQL->arrayTable = array('uq1' => 'userpquota');
        $this->ClassSQL->camposTabelas = array('sum(uq1.softlimit) as limite');
        $this->ClassSQL->conditionsLeftJoin = array('left join users u1 on u1.id=uq1.userid'
            , ' left join groupsmembers gm1 on gm1.userid=u1.id', ' left join groups g1 on g1.id=gm1.groupid');
        $this->ClassSQL->condicoesTabela = array('g1.id=' . $id . '');
//       $this->ClassSQL->conditions = $arrayWhere;
        $this->ClassSQL->GroupBY = array('g1.id');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //limite de grupo balace
    public function sqlVerLimiteGrupoBalance(int $id) {
        $this->ClassSQL->arrayTable = array("u" => "users");
        $this->ClassSQL->camposTabelas = array("u.id as idu", "u.balance", "u.limitmonth");
        $this->ClassSQL->conditionsLeftJoin = array('left join groupsmembers gm on gm.userid=u.id', ' left join groups g on gm.groupid=g.id', ' left join userpquota uc on uc.userid=u.id', ' left join "Cotas_User" cu on cu.pkgroup=g.id', ' left join users u2 on u2.id=cu.pkuser');
        $this->ClassSQL->condicoesTabela = array("g.groupname is not null", "g.id = " . $idGroup . "");
        $this->ClassSQL->GroupBY = array("u.id");
        $this->ClassSQL->colunaOrdenada = "u.username";
        $this->ClassSQL->ordenacao = "ASC";
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //limite de Usuario
    public function sqlVerLimiteUsuario(int $id) {
        $this->ClassSQL->arrayTable = array('uq1' => 'userpquota');
        $this->ClassSQL->camposTabelas = array('uq1.softlimit as limite');
        $this->ClassSQL->condicoesTabela = array('uq1.id=' . $id . '');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //limite de Usuario
    public function sqlVerLimiteUsuarioBalance(int $id) {
        $this->ClassSQL->arrayTable = array('u' => 'users');
        $this->ClassSQL->camposTabelas = array('u.balance as balance');
        $this->ClassSQL->condicoesTabela = array('u.id=' . $id . '');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    public function sqlSelectUsuariosResResponsavel() {
        $this->ClassSQL->arrayTable = array('u' => 'users', 'cu' => '"Cotas_User"', 'g' => 'groups');
        $this->ClassSQL->camposTabelas = array('DISTINCT u.id as id', 'u.username as nome');
        $this->ClassSQL->conditionsLeftJoin = null;
        $this->ClassSQL->condicoesTabela = array('cu."LimiteSetor" >= 1', 'cu.pkuser = u.id', 'cu.pkgroup=g.id');
        $this->ClassSQL->GroupBY = null;
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //
    public function sqlSelectModalAlterar(int $iduq, int $idg): string {
        $this->ClassSQL->arrayTable = array('uq' => 'userpquota');
        $this->ClassSQL->camposTabelas = array('uq.id as iduq', 'uq.softlimit as limite', 'u.username as usuario', 'p.printername as impressora');
        $this->ClassSQL->conditionsLeftJoin = array('left join users u on u.id=uq.userid', 'left join printers p on p.id = printerid', 'left join groupsmembers gm on gm.userid = u.id');
        $this->ClassSQL->condicoesTabela = array('gm.groupid = ' . $idg . ' and uq.id not in(' . $iduq . ')');
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //
    public function sqlSelectPrinters() {
        $this->ClassSQL->camposTabelas = array("p.printername", "p.description", "p.id");
        $this->ClassSQL->arrayTable = array("p" => "printers");
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    //
    public function sqlDataInforCotaGeral(): string {
        $this->stnSQL = "Select sum(uq.softlimit) as limite, sum(uq.pagecounter) as consumido, sum(uq.softlimit) - sum(uq.pagecounter) as disponivel from users u,groups g,groupsmembers gm,userpquota uq,printers p "
                . " where u.id=gm.userid and g.id=gm.groupid and uq.userid=u.id and p.id=uq.printerid ;";
        return $this->stnSQL;
    }

    // printrsUsersArray
    public function sqlPrintrsUsersArray(int $id): string {
        $this->ClassSQL->camposTabelas = array("p.printername as nome", "p.id as idp", "uq.id as iduq", "u.id as idu");
        $this->ClassSQL->arrayTable = array("uq" => "userpquota", "u" => "users", "p" => "printers");
        $this->ClassSQL->condicoesTabela = array("uq.printerid = p.id", "uq.userid = u.id", "uq.userid = {$id}");
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }

    // -- ok Para Alterar numera cota de Usuario
    public function sqlAlterarCotar(int $softlimit, int $pkuser, int $pkprinter): string {
        $this->ClassSQL->tabela = 'userpquota';
        $this->ClassSQL->camposTabelas = array("softlimit", "hardlimit");
        $this->ClassSQL->dados = array($softlimit, 0);
        $where = " userid={$pkuser} and printerid={$pkprinter} ";
        $this->stnSQL = $this->ClassSQL->sqlAtualizar($where);
        return $this->stnSQL;
    }

    //
    public function sqlAlterarCotarVerGrupo(int $softlimit, int $id): string {
        $this->ClassSQL->tabela = 'userpquota';
        $this->ClassSQL->camposTabelas = array("softlimit");
        $this->ClassSQL->dados = array($softlimit);
        $where = " id = {$id} ";
        $this->stnSQL = $this->ClassSQL->sqlAtualizar($where);
        return $this->stnSQL;
    }

    //
    public function sqlAlterarCotarUserBalance(int $balance, int $id): string {
        $this->ClassSQL->tabela = 'users';
        $this->ClassSQL->camposTabelas = array("balance");
        $this->ClassSQL->dados = array($balance);
        $where = " id = {$id} ";
        $this->stnSQL = $this->ClassSQL->sqlAtualizar($where);
        return $this->stnSQL;
    }

}
