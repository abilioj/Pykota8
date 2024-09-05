 Cotas_User - 'pkuser', 'LimiteSetor', 'pkgroup' 
 billingcodes - 'id', 'billingcode', 'description', 'balance', 'pagecounter'
 coefficients - 'id', 'printerid', 'label', 'coefficient' 
 grouppquota -  'id', 'groupid', 'printerid', 'softlimit', 'hardlimit', 'datelimit'
 groups - 'id', 'groupname', 'description', 'limitby'
 jobhistory -  'id', 'jobid', 'userid', 'printerid', 'pagecounter', 'jobsizebytes'
, 'jobsize', 'jobprice', 'action', 'filename', 'title', 'copies', 'options', 'hostname'
, 'md5sum', 'pages', 'billingcode', 'precomputedjobsize', 'precomputedjobprice', 'jobdate'
 payments - 'id', 'userid', 'amount', 'description', 'date'
 printers - 'id', 'printername', 'description', 'priceperpage', 'priceperjob', 'passthrough', 'maxjobsize'
 userpquota - 'id', 'userid', 'printerid', 'lifepagecounter', 'pagecounter', 'softlimit', 'hardlimit', 'datelimit', 'maxjobsize', 'warncount'
 users -  'id', 'username', 'email', 'balance', 'lifetimepaid', 'limitby', 'description', 'overcharge'
 groupsmembers - 'groupid', 'userid'
 
respongroups - id_user, id_user_res, id_group
------------------------------------------------------------------------------------------------------------------------------------------------
--busca informação de conta de usuarios TODOA os grupos de um responsaveis - id 52

select g.id as idg, u2.id as idAdm, p.id as idp, u.id as idu, u.username as usuario,g.groupname as grupo,uc.softlimit as limite
, uc.pagecounter as consumido,uc.softlimit - uc.pagecounter as disponivel, p.printername as impressora
from users u left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id
 left join "Cotas_User" cu on cu.pkgroup=g.id left join printers p on p.id=uc.printerid left join users u2 on u2.id=cu.pkuser
 where g.groupname is not null and u2.username is not null  and u2.id=52 order by g.groupname, u.username;

-- VER  Dados DE COTA DE CADA GRUPO    
Select g.groupname, u.username, "LimiteSetor" from "Cotas_User" as cu,groups as g, users as u where cu.pkgroup=g.id and cu.pkuser = u.id ;

-- VER  Dados DE COTA DE CADA GRUPO de um responsaveis - id 52
Select g.groupname as grupo, u.username as usuario, "LimiteSetor", g.id as idg, u.id as idu 
from "Cotas_User" as cu,groups as g, users as u where cu.pkgroup=g.id and cu.pkuser = u.id and u.id = 52 ;--and g.id = 78 
------------------------------------------------------------------------------------------------------------------------------------------------
-- sql pra view vicular
select u.id,u.username from users as u, usuario_interno as ui, usuario as ua 
 where ui.id_users = u.id and ua.id_usuario=ui.id_usuario ;

-- VER  Dados DE COTA DE CADA usuario de um grupo - id 78
select uc.id as id,u.id as idu,g.id as idg, p.id as idi,u.username as usuario,g.groupname as grupo
,uc.softlimit as limite,uc.pagecounter as consumido, uc.softlimit - uc.pagecounter as disponivel 
, p.printername as impressora  from users u left join groupsmembers gm on gm.userid=u.id
 left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id
 left join printers p on uc.printerid = p.id  left join "Cotas_User" cu on cu.pkgroup=g.id
 left join users u2 on u2.id=cu.pkuser
 where g.groupname is not null and g.id = 78 
 and uc.id!=160
 order by u.username;
--------------------------------------------------------------------------------------------------------------------------------

select p.printername as nome, p.id as id from 
 userpquota as uq, printers as p, users as u 
 where uq.printerid = p.id and uq.userid = u.id 
 and uq.userid = 264;

INSERT INTO userpquota (id, userid, printerid, lifepagecounter, pagecounter, softlimit, hardlimit, datelimit, maxjobsize, warncount) 
VALUES(NULL,'408','11',NULL,NULL,NULL,NULL,'2019-09-17 17:02:00',NULL,NULL);
SELECT * FROM userpquota;

DELETE FROM userpquota WHERE userid = 408;

SELECT title,jobdate,hostname FROM jobhistory WHERE userid=31 ORDER BY jobdate desc;

select * from acessologinws;
SELECT * FROM usuario;
DELETE FROM acessologinws WHERE id = 2;
---------------------------------------------------------------------------------------------------------------------------------
-- lista todos usuarios no pykota
SELECT u.username as usuario, g.groupname as grupo, p.printername as impressora, u.id as idu, g.id as idg, p.id as idp
 FROM users AS u
 left join groupsmembers gm on gm.userid=u.id left join groups g on gm.groupid=g.id left join userpquota uc on uc.userid=u.id
 left join "Cotas_User" cu on cu.pkgroup=g.id left join printers p on p.id=uc.printerid left join users u2 on u2.id=cu.pkuser
 WHERE uc.id is not null and g.id is not null group by g.id,uc.id,p.id,u.id,u.username,g.groupname,p.printername ;

-----------------------------------------------------------------------------------------------------------------------------------
-- ver hiostoricos de impressão
SELECT * FROM jobhistory WHERE jobdate >= '2020-02-17 00:00:00.00000' AND jobdate <= '2020-02-17 14:00:00.000000' ;
SELECT * FROM jobhistory WHERE jobdate BETWEEN '2020-02-17 00:00:00.00000' AND '2020-02-17 14:00:00.00000';

SELECT u.id as id, u.username as nome, p.printername as impressora, a.title as arquivo, a.jobsize as qtd_paginas, a.jobdate as data
 FROM jobhistory AS a left join users u on u.id=a.userid left join printers p on p.id=a.printerid 
WHERE a.action='ALLOW' AND a.jobdate between '2018-01-01 00:00:00' and '2018-01-31 23:59:59' ;

select * from jobhistory ORDER BY jobdate desc limit 22;
----------------------------------------------------------------------------------------------------------------------------------

Select DISTINCT  u.id as idg, u.username as usuario
 from "Cotas_User" as cu,groups as g, users as u
 where cu.pkgroup=g.id and cu.pkuser = u.id ;

truncate table respongroups;
DROP TABLE respongroups;
SELECT * FROM respongroups;
INSERT INTO respongroups (id_user,id_user_res,id_group) VALUES (71,459,113);
INSERT INTO respongroups (id_user,id_user_res,id_group) VALUES (463,459,113);
INSERT INTO respongroups (id_user,id_user_res,id_group) VALUES (96,459,60);
SELECT * FROM users WHERE id = 459;
--------------------------------------------------------------------------------------------------------------------------------
-- sql de mostra os usuario a manipular as cota do grupo
select u.username, r.id_user from respongroups r
 left join users u on r.id_user=u.id left join groups g on r.id_group=g.id left join "Cotas_User" cu on r.id_group = cu.pkgroup 
where r.id_group = 113;
----------------------------------------------------------------------------------------------------------------------------------------
Select g.groupname as grupo, u.username as usuario, "LimiteSetor", g.id as idg, u.id as idu
 from "Cotas_User" as cu,groups as g, users as u, respongroups as r  
 where cu.pkgroup=g.id and cu.pkuser = u.id and r.id_user_res = cu.pkuser and r.id_group=cu.pkgroup and r.id_user=71;

Select g.groupname as grupo, u.username as usuario, "LimiteSetor", g.id as idg, u.id as idu
 from "Cotas_User" as cu,groups as g, users as u
 where cu.pkgroup=g.id and cu.pkuser = u.id and u.id = 86 ;