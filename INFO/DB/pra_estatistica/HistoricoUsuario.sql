select u.id as id, u.username as nome,p.printername as impressora,a.title as arquivo,
a.jobsize as qtd_paginas,a.jobdate as data 
from jobhistory a left join users u on u.id=a.userid left join printers p on p.id=a.printerid
 where 
 u.id = 52 and
 a.action='ALLOW' and a.jobdate between '01-10-2015' and '31-10-2015' 
order by a.printerid,a.jobdate desc;
