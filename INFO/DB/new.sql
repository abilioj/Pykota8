-- PARA GERENCIA COTA VDE SERTOOR
select u.username,g.groupname from public."Cotas_User" c,public.groups g,public.users u where g.id=c.pkgroup and u.id=c.pkuser;
--  and c.pkuser=

SELECT * FROM printers;
select u.username from users u order by u.username;
-- Grupo por nome 
Select id from groups where groupname='';
--limiti por grupo
SELECT "LimiteSetor" as Limmit FROM "Cotas_User" where pkgroup='';

-- 
Select sum(uq.softlimit) as total,sum(uq.pagecounter) as disponivel
 from users u,groups g,groupsmembers gm,userpquota uq,printers p
 where u.id=gm.userid and g.id=gm.groupid and uq.userid=u.id and p.id=uq.printerid ;
-- and g.id="0" group by g.id;

-- visão de copias
Select u.username,g.groupname,uq.softlimit,uq.pagecounter,p.id as pkprinter,u.id as pkuser,p.printername 
 from users u,groups g,groupsmembers gm,userpquota uq,printers p 
 where u.id=gm.userid and g.id=gm.groupid and uq.userid=u.id and p.id=uq.printerid and g.id=0 order by p.id;

-- Alterar copias
update userpquota set softlimit='softlimit', hardlimit=0 where userid= 'pkuser' and printerid= 'pkprinter';

-- pega cota de grupo
select * from "Cotas_User" where pkgroup=;

-- usuarias por grupos
select u.id as pkuser,p.id as pkprinter,(u.username  || ' <' || p.printername || '>') as username,up.softlimit,up.hardlimit,up.pagecounter,up.lifepagecounter
 from users u,userpquota up,printers p where u.id=up.userid and up.printerid=p.id order by u.username;

select u.id as pkuser,p.id as pkprinter,u.username,up.softlimit,up.hardlimit,up.pagecounter,up.lifepagecounter
 from users u,userpquota up,printers p where u.id=up.userid and up.printerid=p.id ;--and p.printername="" ;

-- Altera Limite Grupo
UPDATE "Cotas_User" SET "LimiteSetor"=0  WHERE pkgroup=0;

--pra perga log de historico de impressão
SELECT job.jobdate,job.hostname,job.filename,job.title,job.action,job.pages,job.copies,job.userid,job.printerid,job.pagecounter
 from jobhistory job where job.userid="+getPkUser(username)+" and extract(month from job.jobdate)="+Mes+"
 and extract(year from job.jobdate)="+Ano+" and job.action='"+Action+"';
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- VER  Dados DE COTA DE CADA usuario
SELECT u.id, g.id, ua.id_usuario, u.username, ua.nome_usuario, g.groupname, n.tipo_nivel
 FROM users AS u, usuario AS ua, usuario_interno AS ue, groups AS g, groupsmembers AS gm, nivel_usuario AS n
 WHERE ue.id_usuario = ua.id_usuario AND ue.id_users = u.id AND gm.userid = u.id AND gm.groupid = g.id
 AND ua.id_nivel = n.id_nivel  ;
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- ver todo os users em algum grupo pra campo select html
SELECT u.id as id,u.username as nome FROM users AS u, groups AS g, groupsmembers AS gm
 WHERE gm.userid = u.id AND gm.groupid = g.id ;
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- ver todo os grupos montado pra campo select html
select g.id, g.groupname FROM groups as g, "Cotas_User" cu where cu.pkgroup=g.id;

-- ver todo os users sem ou em algum grup
SELECT u.username as usuario, g.groupname as grupo, p.printername as impressora, u.id as idu, g.id as idg, p.id as idp
 FROM users AS u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id
 left join userpquota uc on uc.userid=u.id left join "Cotas_User" cu on cu.pkgroup=g.id
 left join printers p on p.id=uc.printerid left join users u2 on u2.id=cu.pkuser
 WHERE uc.id is not null group by g.id,uc.id,p.id,u.id,u.username,g.groupname,p.printername ;

--pra perga log de historico de impressão personalizado
select id,title,jobdate,hostname from jobhistory
 WHERE 
-- pages is not null
 userid=320 
-- and jobdate between '2020-02-18 00:01:00' and '2020-02-18 23:59:59' 
 order by id DESC
 limit 100;
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
---- VER  Dados DE COTA DE CADA DE UM GRUPO
select uc.id as id,u.id as idu,g.id as idg, p.id as idi,u.username as usuario,g.groupname as grupo,
                uc.softlimit as limite,uc.pagecounter as consumido, uc.softlimit - uc.pagecounter as disponivel , p.printername as impressora 
                 from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id left join printers p on uc.printerid = p.id 
                 left join "Cotas_User" cu on cu.pkgroup=g.id left join users u2 on u2.id=cu.pkuser
                 where g.groupname is not null and g.id = 112  order by u.username;
