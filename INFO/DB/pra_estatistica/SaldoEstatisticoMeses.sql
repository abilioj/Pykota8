select u.id as id, u.username as USUARIO,sum(case when extract(month from a.jobdate)=1 then a.jobsize else 0 end) JANEIRO,
sum(case when extract(month from a.jobdate)=2 then a.jobsize else 0 end) FEVEREIRO,sum(case when extract(month from a.jobdate)=3	then a.jobsize else 0 end) MARCO,
sum(case when extract(month from a.jobdate)=4 then a.jobsize else 0 end) ABRIL,sum(case when extract(month from a.jobdate)=5 	then a.jobsize else 0 end) MAIO,
sum(case when extract(month from a.jobdate)=6 then a.jobsize else 0 end) JUNHO,sum(case when extract(month from a.jobdate)=7 then a.jobsize else 0 end) JULHO,
sum(case when extract(month from a.jobdate)=8 then a.jobsize else 0 end) AGOSTO,sum(case when extract(month from a.jobdate)=9 then a.jobsize else 0 end) SETEMBRO,
sum(case when extract(month from a.jobdate)=10 then a.jobsize else 0 end) OUTUBRO, sum(case when extract(month from a.jobdate)=11 then a.jobsize else 0 end) NOVEMBRO, 
sum(case when extract(month from a.jobdate)=12 then a.jobsize else 0 end) DEZEMBRO
 from jobhistory a left join users u on u.id=a.userid where a.action='ALLOW' and a.jobdate between '01-01-2022' and '31-12-2022' group by u.id, u.username order by u.username ;
