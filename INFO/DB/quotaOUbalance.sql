 
SELECT uc.username as reponsavel, g.id as id, g.groupname as grupo, "LimiteSetor" as limitesetor
, (select sum(u1.limitmonth) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as limitesetoratual
, (select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid  where g1.id=g.id group by g1.id ) as consumidoatuado
   
, (select sum(u1.limitmonth) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id )
   -(select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid where g1.id=g.id group by g1.id ) as disponivel
   
, "LimiteSetor"-(select sum(u1.balance) from users u1 left join groupsmembers gm1 on gm1.userid=u1.id left join groups g1 on g1.id=gm1.groupid  where g1.id=g.id group by g1.id ) as disponivelgeral
  
  FROM groupsmembers AS gm left join users u on u.id=gm.userid left join groups g on g.id=gm.groupid left join userpquota q on q.userid=u.id
  left join "Cotas_User" cu on cu.pkgroup=g.id left join printers p on p.id=q.printerid left join users uc on uc.id=cu.pkuser
WHERE "LimiteSetor" is not null AND pkgroup=60 group by uc.username,g.groupname,g.id,cu."LimiteSetor",limitesetoratual,consumidoatuado,disponivel,disponivelgeral ORDER BY uc.username ASC ;