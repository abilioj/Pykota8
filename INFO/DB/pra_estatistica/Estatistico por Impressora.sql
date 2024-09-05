select p.id as IDPRINTER,p.printername as PRINTER,
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
from jobhistory a
left join users u on u.id=a.userid left join userpquota up on up.userid=u.id left join printers p on p.id=up.printerid
where a.action='ALLOW' and a.jobdate between '2019-01-01' and '2019-12-31' group by 1,2 order by p.id

CREATE VIEW estatistica_pro_imprecao AS (
    select p.id as IDPRINTER,p.printername as PRINTER,
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
    ,extract(year from a.jobdate)  as ano
    from jobhistory a
    left join users u on u.id=a.userid left join userpquota up on up.userid=u.id left join printers p on p.id=up.printerid
    where a.action='ALLOW' group by 1,2,15 order by p.id
);

CREATE MATERIALIZED VIEW estatistica_pro_imprecao_m AS (
        select p.id as IDPRINTER,p.printername as PRINTER,
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
    ,extract(year from a.jobdate)  as ano
    from jobhistory a
    left join users u on u.id=a.userid left join userpquota up on up.userid=u.id left join printers p on p.id=up.printerid
    where a.action='ALLOW' group by 1,2,15 order by p.id
)with no data;
