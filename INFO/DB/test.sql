
SELECT u.id,u.username,coalesce(g.groupname,'Não Vinculada Em Grupo') grupo FROM users as u
 left join groupsmembers gm on gm.userid=u.id
 left join groups g on gm.groupid=g.id
 group by u.id,g.groupname
;

SELECT * from users 