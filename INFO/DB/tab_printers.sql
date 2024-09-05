
/**
 * Author:  abilio.jose
 * Created: 07/07/2020
 */

/*==============================================================*/
/* table: ip_printers                                           */
/*==============================================================*/
drop table ip_printers;
create table ip_printers(
   id_printer integer,
   ip         varchar(50)
);

INSERT INTO ip_printers (id_printer,ip) values 
( 11,'10.1.0.10')
,( 22,'10.1.0.13')
,( 24,'10.1.0.14')
,( 16,'10.1.0.2')
,( 4,'10.1.0.6')
,( 19,'10.1.0.8')
,( 7,'10.1.0.5')
,( 31,'10.1.0.11')
,( 8,'10.1.0.4')
,( 17,'10.1.0.9')
,( 30,'10.1.0.18')
,( 9,'10.1.0.3')
,( 14,'10.1.0.7')
,( 32,'10.1.0.19')
,( 25,'10.1.0.16');


select * from ip_printers ;

SELECT p.printername as nome from ip_printers ipp, printers p where ipp.id_printer=p.id and ipp.ip = '10.1.0.2' ; 
