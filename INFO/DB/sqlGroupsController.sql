----------------------------------------------------------------------------
select g.id as idg,  u.id as idu,u.username as usuario,g.groupname as grupo, uc.softlimit as limite,uc.pagecounter as consumido,u2.username as administrador
	from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id
		left join "Cotas_User" cu on cu.pkgroup=g.id left join users u2 on u2.id=cu.pkuser
	where g.groupname is not null and u2.username is not null and g.id = 86 order by g.groupname, u.username;
----------------------------------------------------------------------------
-- lista todos usuarios de controlado por um usuarios 
select g.id as idg, u2.id as idAdm, p.id as idp, u.id as idu, u.username as usuario, g.groupname as grupo,uc.softlimit as limite, uc.pagecounter as consumido, p.printername as impressora
	from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id left join "Cotas_User" cu on cu.pkgroup=g.id left join printers p on p.id=uc.printerid  left join users u2 on u2.id=cu.pkuser
	where g.groupname is not null and u2.username is not null  and u2.id=342 order by g.groupname, u.username;
----------------------------------------------------------------------------
select g.id,g.groupname from groups as g left join "Cotas_User" cu on cu.pkgroup=g.id where cu.pkuser=52;
----------------------------------------------------------------------------
-- sql pra ver destalis de couta
select g.id,g.groupname as grupo
--, "LimiteSetor" as limitesSetor
, sum(uc.softlimit) as limite 
, sum(uc.pagecounter) as consumidoTotal
,sum(uc.softlimit) - sum(uc.pagecounter) as disponivel 
 from users u 
 left join groupsmembers gm on gm.userid=u.id
 left join groups g on gm.groupid=g.id 
 left join userpquota uc on uc.userid=u.id
 left join "Cotas_User" cu on pkgroup=g.id 
 left join printers p on p.id=uc.printerid
 left join users u2 on u2.id=pkuser
 where g.groupname is not null and u2.username is not null
 and u2.id=52 
 and g.id = 78 
 GROUP BY 
"LimiteSetor"
, uc.softlimit
,g.groupname
,g.id
,u2.username
,uc.pagecounter
 order by g.groupname asc ;