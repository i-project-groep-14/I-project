/*==============================================================*/
/* Database name:  EenmaalAndermaal							    */
/* Script:		   I-Project groep 14		                    */
/* Created on:     25-4-2016		                            */
/*==============================================================*/

use master

drop database EenmaalAndermaal

/*==============================================================*/
/* Database: EenmaalAndermaal									*/
/*==============================================================*/
create database EenmaalAndermaal

use EenmaalAndermaal



/*==============================================================*/
/* Table: Gebruiker												*/
/*==============================================================*/
create table gebruiker (
   gebruikersnaam			varchar(20)			not null,
   voornaam					varchar(20)			not null,
   achternaam				varchar(20)			not null,
   adresregel1				varchar(20)			not null,
   adresregel2				varchar(20)			null,
   postcode					char(7)				not null,
   plaatsnaam				varchar(20)			not null,
   land						varchar(20)			not null,
   geboortedatum			date				not null,
   mailadres				varchar(50)			not null,
   wachtwoord				varchar(255)		not null,
   vraag					numeric(2)			not null,
   antwoordtekst			varchar(50)			not null,
   rol						numeric(1)			not null,
   profielfoto				varchar(255)		null
   constraint pk_gebruiker_gebruikersnaam primary key (gebruikersnaam)
)	

/*==============================================================*/
/* Table: Vraag													*/
/*==============================================================*/
create table vraag (
	vraagnummer				numeric(2)			not null,
	tekstvraag				varchar(50)			not null
	constraint pk_vraag_vraagnummer primary key (vraagnummer)
)

/*==============================================================*/
/* Table: Gebruikerstelefoon									*/
/*==============================================================*/
create table gebruikerstelefoon (
	volgnr					numeric(2)			identity(1,1) not null,
	gebruiker				varchar(20)			not null,
	telefoon				char(11)			not null
	constraint pk_gebruikerstelefoon_volgnr primary key (volgnr),
	constraint fk_gebruikerstelefoon_gebruiker foreign key (gebruiker) references gebruiker (gebruikersnaam)
)

alter table gebruiker
add constraint fk_gebruiker_vraag foreign key (vraag) references vraag (vraagnummer),
	constraint ck_gebruiker_geboortedatumVoorVandaag check (geboortedatum < getDate()),
	constraint ck_gebruiker_wachtwoordLangerDan7Karakters check (LEN(wachtwoord) >= 7),
	constraint ck_gebruiker_wachtwoordMinimaal1LetterEn1Cijfer check (wachtwoord like '%[A-Za-z]%' and wachtwoord like '%[0-9]%')
	




/*			Weghalen		*/
insert into vraag values ('1', 'vraag1')



use master