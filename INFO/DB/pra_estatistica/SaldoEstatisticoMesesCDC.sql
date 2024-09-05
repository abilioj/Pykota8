select g.id as id,g.groupname as CDC,
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
left join users u on u.id=a.userid left join groupsmembers gm on u.id=gm.userid
left join groups g on gm.groupid=g.id 
left join "Cotas_User" cu on cu.pkgroup=g.id left join users ur on ur.id=cu.pkuser 
where 
-- g.id=18 and
 g.groupname is not null and 
 a.action='ALLOW' and a.jobdate between '01-01-2022' and '31-12-2022' group by g.id,g.groupname,ur.id

    CREATE VIEW estatistica_imprecao_mes_por_ano AS (
            select g.groupname as CDC,
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
            ,g.id,cu.pkuser,extract(year from a.jobdate)  as ano
            from jobhistory a left join users u on u.id=a.userid left join groupsmembers gm on u.id=gm.userid left join groups g on gm.groupid=g.id 
            left join "Cotas_User" cu on cu.pkgroup=g.id left join users ur on ur.id=cu.pkuser 
            where g.groupname is not null and a.action='ALLOW' group by g.id,g.groupname,cu.pkuser, ano order by cu.pkuser
    );

    CREATE MATERIALIZED VIEW estatistica_imprecao_mes_por_ano_m AS (
            select g.groupname as CDC,
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
            ,g.id,cu.pkuser,extract(year from a.jobdate)  as ano
            from jobhistory a left join users u on u.id=a.userid left join groupsmembers gm on u.id=gm.userid left join groups g on gm.groupid=g.id 
            left join "Cotas_User" cu on cu.pkgroup=g.id left join users ur on ur.id=cu.pkuser 
            where g.groupname is not null and a.action='ALLOW' group by g.id,g.groupname,cu.pkuser, ano order by cu.pkuser
    )with no data ;