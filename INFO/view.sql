-- temporaria - CREATE VIEW <NOME-DA-VIEW> AS <BUSCA_SQL>;
-- deleta - DROP VIEW <NOME-DA-VIEW>

-- materizada - CREATE MATERIALIZED VIEW <NOME-DA-VIEW> AS <BUSCA_SQL> WITH [NA] DATA;
-- ATUALIZA A VIEW MATERIXADA - REFRESH MATERIALIZED VIEW <NOME-DA-VIEW>
-- deleta - DROP MATERIALIZED VIEW <NOME-DA-VIEW>

-- ver view
 select table_schema as schema_name, table_name as view_name from information_schema.views where table_schema not in ('information_schema', 'pg_catalog') order by schema_name, view_name;

select count(a.jobsize) as QUANTIDADE,b.printername as IMPRESSORA from jobhistory a
 left join printers b on a.printerid=b.id 
 left join ip_printers c on c.id_printer=b.id
   where (a.jobdate between '2022-01-01' and '2022-12-31') and a.action='ALLOW' and c.status=1 group by b.printername;