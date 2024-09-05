/* ----------------------------------------------------------------------------------------------------------------------------------------------------- */

/*==============================================================*/
/* table: nivel_usuario                                         */
/*==============================================================*/
create table nivel_usuario(
   id_nivel             serial,
   tipo_nivel           varchar(20) not null,
   primary key (id_nivel)
);

/*==============================================================*/
/* table: status_usuario                                        */
/*==============================================================*/
create table status_usuario(
   id_status            serial,
   tipo_status          varchar(20) not null,
   primary key (id_status)
); 
 
/*==============================================================*/
/* table: usuario                                               */
/*==============================================================*/
create table usuario(
   id_usuario           serial, 
   id_status            integer,
   id_nivel             integer,
   nome_usuario         varchar(100) not null,
   login_usuario        varchar(20),
   senha_usuario        varchar(64),
   email_usuario        varchar(250),
   telefone_usuario     varchar(10), 
   data_cadastro_usuario date,
   data_alteracao_usuario date,
   data_ultimo_login_usuario date,
   foto_usuario         varchar(250),
   primary key (id_usuario)
);

/*==============================================================*/
/* table: usuario_interno                                       */
/*==============================================================*/
create table usuario_interno(
   id_users             integer,
   id_usuario           integer
);
/*==============================================================*/ 
/* table:   acessologinws                                       */
/*==============================================================*/
create table acessologinws(
   id			serial,
   id_usuario		int,
   tempo		int,
   data_access_login	Timestamp,
   data_expedicao_login	Timestamp,
   isok			int
);

CREATE TABLE respongroups(
  id_user INT NULL,
  id_user_res INT NULL,
  id_group INT NULL
);

-- nivel
insert into nivel_usuario (id_nivel,tipo_nivel) values (1,'Sem Permição');
insert into nivel_usuario (id_nivel,tipo_nivel) values (2,'Sem Acesso');
insert into nivel_usuario (id_nivel,tipo_nivel) values (3,'Usuário');
insert into nivel_usuario (id_nivel,tipo_nivel) values (4,'Administrador');
insert into nivel_usuario (id_nivel,tipo_nivel) values (5,'Super Usuário');

-- status
insert into status_usuario (id_status,tipo_status) values (1,'Cancelado');
insert into status_usuario (id_status,tipo_status) values (2,'Inativo');
insert into status_usuario (id_status,tipo_status) values (3,'Ativo');

/*usuarios*/ 
insert into usuario (id_usuario, id_status, id_nivel, nome_usuario, login_usuario, senha_usuario, email_usuario, telefone_usuario, data_cadastro_usuario, data_alteracao_usuario, data_ultimo_login_usuario, foto_usuario) 
values (1, 3, 5, 'Admin', 'admin', md5('admin'), 'admin@admin.com.br', '', current_date, current_date, current_date, null);
