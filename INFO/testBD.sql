
-- User IDUser, NameUser, Email
/*1,'Leanne Graham','Sincere@april.biz'
2,'Ervin Howell','Shanna@melissa.tv'
3,'Clementine Bauch','Nathan@yesenia.net'
4,'Patricia Lebsack','Julianne.OConner@kory.org'
5,'Chelsey Dietrich','Lucio_Hettinger@annie.ca'
6,'Mrs. Dennis Schulist','Karley_Dach@jasper.info'
7,'Kurtis Weissnat','Telly.Hoeger@billy.biz'
8,'Nicholas Runolfsdottir V','Sherwood@rosamond.me'
9,'Glenna Reichert','Chaim_McDermott@dana.io'
10,'Clementina DuBuque','Rey.Padberg@karina.biz'
*/
truncate table "Cotas_User";

select u.id,u.username from users as u left join groupsmembers gm on gm.userid=u.id where gm.groupid = 60 ;
 
SELECT u.id as id, u.id as idu, g.id as idg, u.id as idi, u.username as usuario, g.groupname as grupo
, u.balance as limite
, SUM(uc.pagecounter) as consumido
, (SUM(uc.softlimit) - SUM(uc.pagecounter)) as disponivel
 FROM users AS u
 left join groupsmembers gm on gm.userid=u.id
 left join groups g on gm.groupid=g.id
 left join userpquota uc on uc.userid=u.id
 left join "Cotas_User" cu on cu.pkgroup=g.id
 left join users u2 on u2.id=cu.pkuser
 WHERE g.groupname is not null AND g.id = 60 AND uc.softlimit != -1 group by u.id,u.username,g.id,g.groupname ORDER BY u.username ASC ;

UPDATE userpquota set softlimit = 0 where userid=500 and userid=3 and userid=2 and userid=96;