-- grupos de um responsalve - id 52
SELECT g.id as idg, g.groupname as grupo, cu."LimiteSetor", sum(uc.pagecounter) as consumidoTotal, cu."LimiteSetor" - sum(uc.pagecounter) as disponivel 
 FROM users AS u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id
 left join "Cotas_User" cu on cu.pkgroup=g.id left join printers p on p.id=uc.printerid left join users u2 on u2.id=cu.pkuser WHERE
 g.groupname is not null AND u2.username is not null
-- AND u2.id=52 
 group by cu."LimiteSetor",g.groupname,g.id ;

------------------------------------------------------------------------------------------------------------
-- busca informação de conta de usuarios
SELECT uc.id as id, g.id as idg, u.id as idu, u.username as usuario, uc.softlimit as limite, g.groupname as grupo 
, sum(uc.pagecounter) as consumido, uc.softlimit - sum(uc.pagecounter) as disponivel 
 FROM users AS u 
 left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id
 left join userpquota uc on uc.userid=u.id left join "Cotas_User" cu on cu.pkgroup=g.id
 left join printers p on p.id=uc.printerid left join users u2 on u2.id=cu.pkuser
 WHERE uc.id is not null
-- AND uc.id!=504
-- AND g.id=78 
 group by uc.id,uc.softlimit,g.id,u.id,u.username,g.groupname;
-------------------------------------------------------------------------------------------------------------
-- informação geral de contas
SELECT sum(uc.pagecounter) as consumido, sum(uc.softlimit) as limite, sum(uc.softlimit) - sum(uc.pagecounter) as disponivel 
 FROM userpquota as uc;
-------------------------------------------------------------------------------------------------------------
-- busca informação de usuario nome e grupo
SELECT uc.id as id, g.id as idg, u.username as usuario, g.groupname as grupo 
 FROM users AS u 
 left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id
 left join userpquota uc on uc.userid=u.id left join "Cotas_User" cu on cu.pkgroup=g.id
 left join printers p on p.id=uc.printerid left join users u2 on u2.id=cu.pkuser
 WHERE uc.id is not null and cu.pkuser = 96
-- AND uc.id!=504
-- AND g.id=78 
 group by g.id,uc.id,u.username,g.groupname;
--------------------------------------------------------------------------------------------------------------
select uc.id as id,u.id as idu,g.id as idg, p.id as idi,u.username as usuario,g.groupname as grupo,
 uc.softlimit as limite,uc.pagecounter as consumido, uc.softlimit - uc.pagecounter as disponivel , p.printername as impressora 
 from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id left join printers p on uc.printerid = p.id 
 left join "Cotas_User" cu on cu.pkgroup=g.id left join users u2 on u2.id=cu.pkuser
 where
-- g.groupname is not null and
 g.id = 6  order by u.username;