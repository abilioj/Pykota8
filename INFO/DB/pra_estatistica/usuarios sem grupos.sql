select u.username,
 (select sum(up.pagecounter) from userpquota as up where up.userid=u.id)as total
 --,(select g.groupname from groupsmembers as gm,groups as g where gm.groupid=g.id and gm.userid=u.id limit 1)as grupo
 from users as u order by 1;

select u.username as NOME, sum(up.pagecounter) as total
from users u left join groupsmembers gm on u.id=gm.userid left join groups g on g.id=gm.groupid left join userpquota up on u.id=up.userid
where g.groupname is null and up.pagecounter is not null group by g.groupname, u.username order by u.username;
