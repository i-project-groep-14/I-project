/*==============================================================*/
/* Database name:  fletnix									    */
/* Script:		   I-Project groep 14		                    */
/* Created on:     25-4-2016		                            */
/*==============================================================*/

use master

--drop database fletnix

/*==============================================================*/
/* Database: EenmaalAndermaal									*/
/*==============================================================*/
create database EenmaalAndermaal

use EenmaalAndermaal


/*==============================================================*/
/* Table: Gebruiker												*/
/*==============================================================*/
create table gebruiker (
   gebruikersnaam			char(10)			not null,
   voornaam					char(5)				not null,
   achternaam				char(8)				not null,
   adresregel1				char(15)			not null,
   adresregel2				char(15)			null,
   postcode					char(7)				not null,
   plaatsnaam				char(12)			not null,
   land						char(9)				not null,
   geboortedag				char(10)			not null,
   mailbox					char(18)			not null,
   wachtwoord				char(9)				not null,
   vraag					integer(1)			not null,
   antwoordtekst			char(6)				not null,
   verkoper					char(3)				not null
   constraint pk_gebruiker_gebruikersnaam primary key (gebruikersnaam)
)	

/*==============================================================*/
/* Table: Vraag													*/
/*==============================================================*/
create table vraag (
	vraagnummer				char(21)			not null,
	tekstvraag				char(21)			not null
	constraint pk_vraag_vraagnummer primary key (vraagnummer)
)

/*==============================================================*/
/* Table: Gebruikerstelefoon									*/
/*==============================================================*/
create table gebruikerstelefoon (
	volgnr					integer(2)			not null,
	gebruiker				char(10)			not null,
	telefoon				char(11)			not null
	constraint pk_gebruikerstelefoon_volgnr primary key (volgnr),
	constraint fk_gebruikerstelefoon_gebruiker foreign key (gebruiker) references gebruiker (gebruikersnaam)
)

alter table gebruiker
add constraint fk_gebruiker_vraag foreign key (vraag) references vraag (vraagnummer),
constraint fk_gebruiker_gebruikersnaam foreign key (gebruikersnaam) references gebruikerstelefoon (gebruiker)



use master