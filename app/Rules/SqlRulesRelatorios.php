<?php

/**
 * Description of SqlRulesRelatorios
 *
 * @author abilio.jose
 */
class SqlRulesRelatorios {

    private $stnSQL;
    private $ClassSQL;

    function __construct() {
        $this->ClassSQL = new Sql(null);
        $this->stnSQL = null;
    }

    public function getStnSQL(): string {
        return (string) $this->stnSQL;
    }
    
    public function SqlViewREFRESH($paramNameView) {
        $this->stnSQL = "REFRESH MATERIALIZED VIEW {$paramNameView} ;";
        return $this->stnSQL;
    }

    public function SqlViewEstatistica_imprecao_mes_por_anoErespopnsavel($paramIdUR, $paramAno): string {
        $condicao = "";
        if ($paramIdUR != 0)
            $condicao = "pkuser={$paramIdUR} and";
        $this->stnSQL = "select * from estatistica_imprecao_mes_por_ano_m where {$condicao} ano='{$paramAno}';";
        return $this->stnSQL;
    }
    
    public function SqlViewEstatistica_imprecao_mes_por_anoEgrupo($idg, $paramAno): string {
        $condicao = "";
        if ($idg != 0)
            $condicao = "g.id={$idg} and";
        $this->stnSQL = "select * from estatistica_imprecao_mes_por_ano_m where ano={$paramAno};";
    }
    
    public function SqlViewEstatistica_pro_imprecao($paramIdUR, $paramAno): string {
        
    }

    public function sqlHistoricoUsuario($conditions): string {
        $this->ClassSQL->arrayTable = array('a' => 'jobhistory');
        $this->ClassSQL->camposTabelas = array('u.id as id', 'u.username as nome', 'p.printername as impressora', 'a.title as arquivo', 'a.jobsize as qtd_paginas', 'a.jobdate as data', 'a.hostname');
        $this->ClassSQL->condicoesTabela = array("a.action='ALLOW'");
        $this->ClassSQL->conditionsLeftJoin = array("left join users u on u.id=a.userid", "left join printers p on p.id=a.printerid");
        $this->ClassSQL->GroupBY = null;
        $this->ClassSQL->conditions = $conditions;
        $this->ClassSQL->colunaOrdenada = "a.jobdate";
        $this->ClassSQL->ordenacao = "asc";
        $this->stnSQL = $this->ClassSQL->sqlPesquisar();
        return $this->stnSQL;
    }
    
    public function SqlSaldoEstatisticoMesesCDC($paramIdUR, $paramAno): string {
        $condicao = "";
        if ($paramIdUR != 0)
            $condicao = "g.id={$paramIdUR} and";
        $this->stnSQL = "select g.groupname as CDC,
        sum(case when extract(month from a.jobdate)=1 then a.jobsize else 0 end) JANEIRO,
        sum(case when extract(month from a.jobdate)=2 then a.jobsize else 0 end) FEVEREIRO,
        sum(case when extract(month from a.jobdate)=3 then a.jobsize else 0 end) MARCO,
        sum(case when extract(month from a.jobdate)=4 then a.jobsize else 0 end) ABRIL,
        sum(case when extract(month from a.jobdate)=5 then a.jobsize else 0 end) MAIO,
        sum(case when extract(month from a.jobdate)=6 then a.jobsize else 0 end) JUNHO,
        sum(case when extract(month from a.jobdate)=7 then a.jobsize else 0 end) JULHO,
        sum(case when extract(month from a.jobdate)=8 then a.jobsize else 0 end) AGOSTO,
        sum(case when extract(month from a.jobdate)=9 then a.jobsize else 0 end) SETEMBRO,
        sum(case when extract(month from a.jobdate)=10 then a.jobsize else 0 end) OUTUBRO,
        sum(case when extract(month from a.jobdate)=11 then a.jobsize else 0 end) NOVEMBRO,
        sum(case when extract(month from a.jobdate)=12 then a.jobsize else 0 end) DEZEMBRO 
        from jobhistory a left join users u on u.id=a.userid left join groupsmembers gm on u.id=gm.userid left join groups g on gm.groupid=g.id 
        where {$condicao} a.action='ALLOW' and a.jobdate between '01-01-{$paramAno}' and '31-12-{$paramAno}' group by g.id,g.groupname";
        return $this->stnSQL;
    }

    public function SqlSaldoEstatisticoMesesCDCPorResponsalve($paramIdUR, $paramAno): string {
        $condicao = "";
        if ($paramIdUR != 0)
            $condicao = "ur.id={$paramIdUR} and";
        $this->stnSQL = "select g.groupname as CDC,
        sum(case when extract(month from a.jobdate)=1 then a.jobsize else 0 end) JANEIRO,
        sum(case when extract(month from a.jobdate)=2 then a.jobsize else 0 end) FEVEREIRO,
        sum(case when extract(month from a.jobdate)=3 then a.jobsize else 0 end) MARCO,
        sum(case when extract(month from a.jobdate)=4 then a.jobsize else 0 end) ABRIL,
        sum(case when extract(month from a.jobdate)=5 then a.jobsize else 0 end) MAIO,
        sum(case when extract(month from a.jobdate)=6 then a.jobsize else 0 end) JUNHO,
        sum(case when extract(month from a.jobdate)=7 then a.jobsize else 0 end) JULHO,
        sum(case when extract(month from a.jobdate)=8 then a.jobsize else 0 end) AGOSTO,
        sum(case when extract(month from a.jobdate)=9 then a.jobsize else 0 end) SETEMBRO,
        sum(case when extract(month from a.jobdate)=10 then a.jobsize else 0 end) OUTUBRO,
        sum(case when extract(month from a.jobdate)=11 then a.jobsize else 0 end) NOVEMBRO,
        sum(case when extract(month from a.jobdate)=12 then a.jobsize else 0 end) DEZEMBRO 
        from jobhistory a left join users u on u.id=a.userid left join groupsmembers gm on u.id=gm.userid left join groups g on gm.groupid=g.id 
        left join \"Cotas_User\" cu on cu.pkgroup=g.id left join users ur on ur.id=cu.pkuser 
        where {$condicao} g.groupname is not null and a.action='ALLOW' and a.jobdate between '01-01-{$paramAno}' and '31-12-{$paramAno}' group by g.id,g.groupname";
        return $this->stnSQL;
    }

    public function sqlEstatisticaPorImpressoraAnual(int $paramAno) {
        $this->stnSQL = "select count(a.jobsize) as QUANTIDADE,b.printername as IMPRESSORA from jobhistory a left join printers b on a.printerid=b.id"
                . " where (a.jobdate between '{$paramAno}-01-01' and '{$paramAno}-12-31') and a.action='ALLOW' group by b.printername;";
        return $this->stnSQL;
    }

    public function sqlEstatisticaPorImpressoraAnualAtivada(int $paramAno) {
        $this->stnSQL = "select count(a.jobsize) as QUANTIDADE,b.printername as IMPRESSORA from jobhistory a "
                . " left join printers b on a.printerid=b.id left join ip_printers c on c.id_printer=b.id"
                . " where (a.jobdate between '{$paramAno}-01-01' and '{$paramAno}-12-31') and a.action='ALLOW' and c.status=1 group by b.printername;";
        return $this->stnSQL;
    }

    public function sqlEstatisticaPorImpressoraMes(int $paramAno) {
        $this->stnSQL = "select
sum(case when extract(month from a.jobdate)=1 then a.jobsize else 0 end) JANEIRO,
sum(case when extract(month from a.jobdate)=2 then a.jobsize else 0 end) FEVEREIRO,
sum(case when extract(month from a.jobdate)=3 then a.jobsize else 0 end) MARCO,
sum(case when extract(month from a.jobdate)=4 then a.jobsize else 0 end) ABRIL,
sum(case when extract(month from a.jobdate)=5 then a.jobsize else 0 end) MAIO,
sum(case when extract(month from a.jobdate)=6 then a.jobsize else 0 end) JUNHO,
sum(case when extract(month from a.jobdate)=7 then a.jobsize else 0 end) JULHO,
sum(case when extract(month from a.jobdate)=8 then a.jobsize else 0 end) AGOSTO,
sum(case when extract(month from a.jobdate)=9 then a.jobsize else 0 end) SETEMBRO,
sum(case when extract(month from a.jobdate)=10 then a.jobsize else 0 end) OUTUBRO,
sum(case when extract(month from a.jobdate)=11 then a.jobsize else 0 end) NOVEMBRO,
sum(case when extract(month from a.jobdate)=12 then a.jobsize else 0 end) DEZEMBRO,
p.printername as PRINTER
from jobhistory a
left join users u on u.id=a.userid left join userpquota up on up.userid=u.id left join printers p on p.id=up.printerid
where p.printername is not null and a.action='ALLOW' and a.jobdate between '{$paramAno}-01-01' and '{$paramAno}-12-31' group by p.printername";
        return $this->stnSQL;
    }

}
