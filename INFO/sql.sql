/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  abilio.jose
 * Created: 28 de abr de 2022
 */
/*SELECT uc.username as reponsavel, g.id as id, g.groupname as grupo, "LimiteSetor" as limitesetor,
 (select sum(u1.limitmonth) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as limitesetoratual
, (select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as consumidoatuado
, "LimiteSetor"-(select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as disponivel
, (select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as disponivelgeral
 FROM groupsmembers AS gm left join users u on u.id=gm.userid left join groups g on g.id=gm.groupid left join userpquota q on q.userid=u.id left join "Cotas_User" cu on cu.pkgroup=g.id left join printers p on p.id=q.printerid left join users uc on uc.id=cu.pkuser 
 WHERE "LimiteSetor" is not null AND pkgroup=60 group by uc.username,g.groupname,g.id,cu."LimiteSetor",limitesetoratual,consumidoatuado,disponivel,disponivelgeral ;*/

select sum(case when extract(month from a.jobdate)=1 then a.jobsize else 0 end) JANEIRO,
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
from jobhistory a where a.action='ALLOW' and a.jobdate between '2022-01-01' and '2022-12-31' ;