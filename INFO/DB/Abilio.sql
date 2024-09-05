select g.groupname as grupo,u.username as usuario,cu."LimiteSetor" as limitesetor,q.softlimit as limiteusuario,q.pagecounter as consumido,
(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid
 where g1.id=g.id group by g1.id ) as somalimite,
(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid
 where g1.id=g.id group by g1.id ) as somaconsumido,
cu."LimiteSetor"-(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid
 where g1.id=g.id group by g1.id ) as diferenca,
cu."LimiteSetor"-(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid 
 where g1.id=g.id group by g1.id ) as diferencasolimit
from groupsmembers gm
    left join users u on u.id=gm.userid
    left join groups g on g.id=gm.groupid
    left join userpquota q on q.userid=u.id
    left join "Cotas_User" cu on cu.pkgroup=g.id
    left join printers p on p.id=q.printerid
where cu."LimiteSetor" is not null and cu.pkgroup=60
 group by g.id 
order by g.id, u.id, p.id
--limit 1
;

-- cosumo d grupo
select sum(uq1.pagecounter) as consumido from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid 
where g1.id=60 group by g1.id 
-- limite de grupo utilizado
select sum(uq1.softlimit) as limite from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid
 where g1.id=60 group by g1.id;
----------
select p.id as idp, u.id as id, (u.username  || ' <' || p.printername || '>') as usuario, q.softlimit as limiteusuario 
from groupsmembers gm
    left join users u on u.id=gm.userid
    left join groups g on g.id=gm.groupid
    left join userpquota q on q.userid=u.id
    left join "Cotas_User" cu on cu.pkgroup=g.id
    left join printers p on p.id=q.printerid
where cu."LimiteSetor" is not null and g.id=78
order by g.id, u.id, p.id;
---------
SELECT uc.username as reponsavel, g.id as id, g.groupname as grupo, "LimiteSetor" as limitesetor
, (select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )
 as limitesetoratual
, (select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )
 as consumidoatuado
 , (select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )
 -(select sum(uq1.pagecounter) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )
 as disponivel
 , "LimiteSetor"-(select sum(uq1.softlimit) from userpquota uq1 left join users u1 on u1.id=uq1.userid left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )
 as disponivelgeral
 FROM groupsmembers AS gm
 left join users u on u.id=gm.userid
 left join groups g on g.id=gm.groupid 
 left join userpquota q on q.userid=u.id
 left join "Cotas_User" cu on cu.pkgroup=g.id
 left join printers p on p.id=q.printerid
 left join users uc on uc.id=cu.pkuser
 WHERE "LimiteSetor" is not null AND pkgroup=78
 group by uc.username,g.groupname,g.id,cu."LimiteSetor",limitesetoratual,consumidoatuado,disponivel,disponivelgeral ;

-------------------------------------------------------------------------------------------------------------------------
SELECT uq.id as iduq, uq.softlimit as limite, u.username as usuario, p.printername as impressora 
 FROM userpquota as uq
 left join users u on u.id=uq.userid left join printers p on p.id = printerid left join groupsmembers gm on gm.userid = u.id 
 where gm.groupid = 86 and uq.id not in(300)
;

select * from userpquota where id= 34;
select * from users where id= 121;

SELECT * FROM acessologinws AS al WHERE al.id_usuario = 1 AND al.isok = true  ;