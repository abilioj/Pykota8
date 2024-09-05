
/**
 * Author:  Abílio José
 * Created: 29/03/2020
 */

SELECT u.username as usuario, g.groupname as grupo, p.printername as impressora
, uc.softlimit as limite, uc.pagecounter as cota, u.id as idu, g.id as idg, p.id as idp 
FROM users AS u 
left join groupsmembers gm on gm.userid=u.id 
left join groups g on gm.groupid=g.id
left join userpquota uc on uc.userid=u.id
left join "Cotas_User" cu on cu.pkgroup=g.id 
left join printers p on p.id=uc.printerid 
-- left join users u2 on u2.id=cu.pkuser  
WHERE uc.id is not null 
--AND g.id is not null 
ORDER BY u.username ;

SELECT u.id as idu, p.id as idp, p.printername as impressora, u.username as usuario, up.softlimit as softl
, up.hardlimit as hardl, up.pagecounter as pagec, up.lifepagecounter as lifep 
FROM users AS u, userpquota AS up, printers AS p WHERE u.id=up.userid AND up.printerid=p.id limit 10;

select u.username as usuario,coalesce(g.groupname,'Não Vinculada Em Grupo') grupo, p.printername as impressora, uc.softlimit as limite, uc.pagecounter as cota, u.id as idu, g.id as idg, p.id as idp
 from userpquota uc
 left join users u on uc.userid=u.id
 left join groupsmembers gm on gm.userid=u.id
 left join groups g on g.id=gm.groupid
 left join printers p on p.id=uc.printerid
 group by g.id,uc.id,p.id,u.id,u.username,p.printername  
order by 1 ;