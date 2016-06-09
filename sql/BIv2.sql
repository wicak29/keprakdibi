/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     6/7/2016 2:13:57 PM                          */
/*==============================================================*/


drop table if exists APBD;

drop table if exists DAERAH;

drop table if exists DAERAH_APBD;

drop table if exists KONTAK;

drop table if exists PERIODE;

drop table if exists PERIODE_APBD;

drop table if exists RELATIONSHIP_2;

drop table if exists USER;

/*==============================================================*/
/* Table: APBD                                                  */
/*==============================================================*/
create table APBD
(
   ID_APBD              int not null AUTO_INCREMENT,
   URAIAN               varchar(60) not null,
   primary key (ID_APBD)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: DAERAH                                                */
/*==============================================================*/
create table DAERAH
(
   ID_DAERAH            int not null AUTO_INCREMENT,
   NAMA_DAERAH          varchar(25) not null,
   primary key (ID_DAERAH)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: DAERAH_APBD                                           */
/*==============================================================*/
create table DAERAH_APBD
(
   ID_APBD              int not null AUTO_INCREMENT,
   ID_DAERAH            int not null,
   primary key (ID_APBD, ID_DAERAH)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

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
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: PERIODE                                               */
/*==============================================================*/
create table PERIODE
(
   ID_PERIODE           int not null AUTO_INCREMENT,
   BULAN                date,
   TRIWULAN             varchar(10),
   TAHUN                date not null,
   primary key (ID_PERIODE)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: PERIODE_APBD                                          */
/*==============================================================*/
create table PERIODE_APBD
(
   ID_APBD              int not null AUTO_INCREMENT,
   ID_PERIODE           int not null,
   primary key (ID_APBD, ID_PERIODE)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: RELATIONSHIP_2                                        */
/*==============================================================*/
create table RELATIONSHIP_2
(
   ID_APBD              int not null AUTO_INCREMENT,
   ID_KONTAK            int not null,
   primary key (ID_APBD, ID_KONTAK)
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

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
) ENGINE = MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

alter table DAERAH_APBD add constraint FK_DAERAH_APBD foreign key (ID_APBD)
      references APBD (ID_APBD) on delete restrict on update restrict;

alter table DAERAH_APBD add constraint FK_DAERAH_APBD2 foreign key (ID_DAERAH)
      references DAERAH (ID_DAERAH) on delete restrict on update restrict;

alter table PERIODE_APBD add constraint FK_PERIODE_APBD foreign key (ID_APBD)
      references APBD (ID_APBD) on delete restrict on update restrict;

alter table PERIODE_APBD add constraint FK_PERIODE_APBD2 foreign key (ID_PERIODE)
      references PERIODE (ID_PERIODE) on delete restrict on update restrict;

alter table RELATIONSHIP_2 add constraint FK_RELATIONSHIP_2 foreign key (ID_APBD)
      references APBD (ID_APBD) on delete restrict on update restrict;

alter table RELATIONSHIP_2 add constraint FK_RELATIONSHIP_3 foreign key (ID_KONTAK)
      references KONTAK (ID_KONTAK) on delete restrict on update restrict;

