/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     6/8/2016 12:24:41 PM                         */
/*==============================================================*/


drop table if exists APBD;

drop table if exists DAERAH;

drop table if exists DATA_APBD;

drop table if exists KONTAK;

drop table if exists PERIODE;

drop table if exists USER;

/*==============================================================*/
/* Table: APBD                                                  */
/*==============================================================*/
create table APBD
(
   ID_APBD              int not null AUTO_INCREMENT,
   URAIAN               varchar(60) not null,
   primary key (ID_APBD)
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: DAERAH                                                */
/*==============================================================*/
create table DAERAH
(
   ID_DAERAH            int not null AUTO_INCREMENT,
   NAMA_DAERAH          varchar(25) not null,
   primary key (ID_DAERAH)
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

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
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

/*==============================================================*/
/* Table: DATA_APBD                                             */
/*==============================================================*/
create table DATA_APBD
(
   ID_APBD              int not null,
   ID_DAERAH            int not null,
   ID_PERIODE           int not null,
   ID_KONTAK            int not null,
   
   primary key (ID_APBD, ID_DAERAH, ID_PERIODE, ID_KONTAK)
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
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


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
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

alter table DATA_APBD add constraint FK_DAERAH_APBD foreign key (ID_APBD)
      references APBD (ID_APBD) on delete restrict on update cascade;

alter table DATA_APBD add constraint FK_DAERAH_APBD2 foreign key (ID_DAERAH)
      references DAERAH (ID_DAERAH) on delete restrict on update cascade;

alter table DATA_APBD add constraint FK_PEMILIK_DATA foreign key (ID_KONTAK)
      references KONTAK (ID_KONTAK) on delete restrict on update cascade;

alter table DATA_APBD add constraint FK_PERIODE_APBD foreign key (ID_PERIODE)
      references PERIODE (ID_PERIODE) on delete restrict on update cascade;

