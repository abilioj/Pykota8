-- buscar grupos montado pelo responsavel

Select g.groupname as grupo, u.username as usuario, "LimiteSetor", g.id as idg, u.id as idu,r.id_user_res
 from "Cotas_User" as cu,groups as g, users as u, respongroups as r
 where cu.pkgroup=g.id and cu.pkuser = u.id
 and r.id_user_res = cu.pkuser
 --and r.id_group=cu.pkgroup 
 and r.id_user = 463
 ---and r.id_user_res = 459 
 group by g.groupname, u.username, "LimiteSetor", g.id, u.id,r.id_user_res;

select * from respongroups;