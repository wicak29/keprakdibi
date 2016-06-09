/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     6/9/2016 12:03:44 PM                         */
/*==============================================================*/


drop table if exists APBD;

drop table if exists DAERAH;

drop table if exists DATA_APBD;

drop table if exists KONTAK;

drop table if exists USER;

/*==============================================================*/
/* Table: APBD                                                  */
/*==============================================================*/
create table APBD
(
   ID_APBD              int not null AUTO_INCREMENT,
   URAIAN               varchar(60) not null,
   primary key (ID_APBD)
)ENGINE = InnoDB;


/*==============================================================*/
/* Table: DAERAH                                                */
/*==============================================================*/
create table DAERAH
(
   ID_DAERAH            int not null AUTO_INCREMENT,
   NAMA_DAERAH          varchar(25) not null,
   primary key (ID_DAERAH)
)ENGINE = InnoDB;

/*==============================================================*/
/* Table: DATA_APBD                                             */
/*==============================================================*/
create table DATA_APBD
(
   ID_APBD              int not null,
   ID_DAERAH            int not null,
   ID_KONTAK            int not null,
   NILAI                float,
   TAHUN                char(4),
   primary key (ID_APBD, ID_DAERAH, ID_KONTAK)
);

/*==============================================================*/
/* Table: KONTAK                                                */
/*==============================================================*/
create table KONTAK
(
   ID_KONTAK            int not null AUTO_INCREMENT,
   NAMA_INSTANSI        varchar(50) not null,
   NO_TELEPON           varchar(15),
   EMAIL                varchar(30),
   ALAMAT               varchar(50),
   PIC                  varchar(50),
   PREFERRED_CONTACT    varchar(50),
   primary key (ID_KONTAK)
)ENGINE = InnoDB;

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              int not null AUTO_INCREMENT,
   USERNAME             varchar(20) not null,
   PASSWORD             varchar(40) not null,
   LEVEL                varchar(20) not null,
   primary key (ID_USER)
)ENGINE = InnoDB;

alter table DATA_APBD add constraint FK_DAERAH_APBD foreign key (ID_APBD)
      references APBD (ID_APBD) on delete restrict on update restrict;

alter table DATA_APBD add constraint FK_DAERAH_APBD2 foreign key (ID_DAERAH)
      references DAERAH (ID_DAERAH) on delete restrict on update restrict;

alter table DATA_APBD add constraint FK_PEMILIK_DATA foreign key (ID_KONTAK)
      references KONTAK (ID_KONTAK) on delete restrict on update restrict;

