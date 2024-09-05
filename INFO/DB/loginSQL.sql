
/**
 * Author:  abilio.jose
 * Created: 09/04/2019
 */

create table login (
  id integer constraint pkid primary key,
  login varchar(45) not null,
  senha varchar(45) not null,
  email varchar(45) null,
  cpf integer not null,
  nivel integer not null,
  status integer not null,
  pkgroup integer null);

insert into public.login(id, login, senha, email, cpf, nivel, status, pkgroup) values (1, 'admin', md5('123123'), 'ti@ti.com', 042638511, 1, 1, 60);

SELECT * FROM usuario;