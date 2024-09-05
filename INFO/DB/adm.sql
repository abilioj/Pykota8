,/**
 * Author:  abilio.jose
 * Created: 17/02/2020
 */

SELECT CURRENT_TIME;
SELECT CURRENT_DATE;
SELECT CURRENT_TIMESTAMP;
SELECT CURRENT_TIMESTAMP(2);
SELECT LOCALTIMESTAMP;

select transaction_timestamp();
select statement_timestamp();
select clock_timestamp();
select timeofday();
select now();
----------------------------------------------------------------

/*usuarios*/ 
insert into usuario (id_usuario, id_status, id_nivel, nome_usuario, login_usuario, senha_usuario, email_usuario, telefone_usuario, data_cadastro_usuario, data_alteracao_usuario, data_ultimo_login_usuario, foto_usuario) 
values (1, 3, 5, 'Admin', 'admin', md5('admin'), 'admin@admin.com.br', '', current_date, current_date, current_date, null);

-- Retorne o primeiro valor não nulo em uma lista:
SELECT COALESCE(NULL, NULL, NULL, 'W3Schools.com', NULL, 'Example.com');
SELECT COALESCE(NULL, 'Example.com');

ALTER TABLE acessologinws ALTER COLUMN isok TYPE int;
/*
-- acessologinws
insert into acessologinws (id_usuario,tempo,data_access_login,data_expedicao_login,isok) values (1,1,now(),now(),1);

truncate table usuario;
truncate table usuario_interno;
truncate table nivel_usuario;
truncate table status_usuario;
truncate table acessologinws;

DROP TABLE acessologinws;
select * from usuario;
select * from acessologinws;

*/
select gm.groupid, ul.id_nivel from usuario as ul, usuario_interno as ui, users as u, groupsmembers as gm  where ul.id_usuario = 1 
 and ui.id_usuario = ul.id_usuario and ui.id_users = u.id and u.id = gm.userid  GROUP BY gm.groupid, ul.id_nivel ;

UPDATE  acessologinws SET data_expedicao_login = '2019-12-23 14:30:36', isok = 1  WHERE id_usuario = 1
select ai.id_usuario,ai.tempo,ai.isok from acessologinws as ai where ai.isok = 0 ;

select * from usuario_interno;