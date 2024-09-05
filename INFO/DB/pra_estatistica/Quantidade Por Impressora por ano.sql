select count(a.jobsize) as QUANTIDADE,b.printername as IMPRESSORA
 from jobhistory a left join printers b on a.printerid=b.id
 where (a.jobdate between '01-01-2022' and '31-01-2022') and a.action='ALLOW'
 group by b.printername;