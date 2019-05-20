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
/*
select * from gebruiker
select * from verkoper
*/

/*==============================================================*/
/* Table: Gebruiker												*/
/*==============================================================*/
create table gebruiker (
   gebruikersnaam				varchar(20)			not null,
   voornaam						varchar(20)			not null,
   achternaam					varchar(20)			not null,
   adresregel1					varchar(20)			not null,
   adresregel2					varchar(20)			null,
   postcode						char(7)				not null,
   plaatsnaam					varchar(20)			not null,
   land							varchar(20)			not null,
   geboortedatum				date				not null,
   mailadres					varchar(50)			not null,
   wachtwoord					varchar(255)		not null,
   vraag						numeric(2)			not null,
   antwoordtekst				varchar(50)			not null,
   rol							numeric(1)			not null,
   profielfoto					varchar(255)		null
   constraint pk_gebruiker_gebruikersnaam primary key (gebruikersnaam)
)	

/*==============================================================*/
/* Table: Vraag													*/
/*==============================================================*/
create table vraag (
	vraagnummer					numeric(2)			not null,
	tekstvraag					varchar(50)			not null
	constraint pk_vraag_vraagnummer primary key (vraagnummer)
)

/*==============================================================*/
/* Table: Gebruikerstelefoon									*/
/*==============================================================*/
create table gebruikerstelefoon (
	volgnr						numeric(3)			identity(1,1) not null,
	gebruiker					varchar(20)			not null,
	telefoon					char(11)			not null
	constraint pk_gebruikerstelefoon_volgnr primary key (volgnr),
	constraint fk_gebruikerstelefoon_gebruiker foreign key (gebruiker) references gebruiker (gebruikersnaam) on update cascade on delete no action
)

alter table gebruiker
add constraint fk_gebruiker_vraag foreign key (vraag) references vraag (vraagnummer) on update no action on delete no action,
	constraint ck_gebruiker_geboortedatumVoorVandaag check (geboortedatum < getDate()),
	constraint ck_gebruiker_wachtwoordLangerDan7Karakters check (LEN(wachtwoord) >= 7),
	constraint ck_gebruiker_wachtwoordMinimaal1LetterEn1Cijfer check (wachtwoord like '%[A-Za-z]%' and wachtwoord like '%[0-9]%')



/*==============================================================*/
/* Table: Verkoper												*/
/*==============================================================*/
create table verkoper (
	gebruiker					varchar(20)			not null,
	bank						varchar(20)			null,
	bankrekening				varchar(30)			null,
	controleoptie				varchar(20)			not null,
	creditcard					varchar(30)			null
	constraint pk_verkoper_gebruiker primary key (gebruiker),
	constraint fk_verkoper_gebruiker foreign key (gebruiker) references gebruiker (gebruikersnaam) on update cascade on delete no action
)

/*==============================================================*/
/* Table: Voorwerp												*/
/*==============================================================*/
create table voorwerp (
	voorwerpnummer				int					identity(1,1) not null,
	titel						varchar(30)			not null,
	beschrijving				varchar(100)		not null,
	startprijs					numeric(10,2)			not null,
	betalingswijze				varchar(20)			not null,
	betalingsinstructie			varchar(30)			null,
	plaatsnaam					varchar(20)			not null,
	land						varchar(20)			not null,
	looptijd					numeric(3)			not null,
	looptijdbeginDag			date				not null,
	looptijdbeginTijdstip		time			not null,
	verzendkosten				varchar(10)			null,
	verzendinstructies			varchar(100)		null,
	verkoper					varchar(20)			not null,
	koper						varchar(20)			null,
	looptijdeindeDag			AS  (dateadd(day,[looptijd],[looptijdbeginDag])),
	looptijdeindeTijdstip		time				not null,
	veilingGesloten				varchar(4)			not null,
	verkoopprijs				varchar(10)			null
	constraint pk_voorwerp_voorwerpnummer primary key (voorwerpnummer),
	constraint fk_voorwerp_verkoper foreign key (verkoper) references verkoper (gebruiker),
	constraint fk_voorwerp_koper foreign key (koper) references gebruiker (gebruikersnaam) on update cascade on delete no action
	/* bij rubriek een foreign key naar voorwerpnummer */

	/*
	AF 1	Tabel Voorwerp, kolom LooptijdeindeDag:
	Kolom LooptijdeindeDag heeft de datum van LooptijdbeginDag + het aantal dagen dat Looptijd aangeeft.

	AF 2	Tabel Voorwerp, kolom LooptijdeindeTijdstip:
	Kolom LooptijdeindeTijdstip heeft dezelfde waarde als kolom LooptijdbeginTijdstip.

	AF 3	Tabel Voorwerp, kolom VeilingGesloten?:
	Kolom VeilingGesloten? heeft de waarde ‘niet’ als de systeemdatum en –tijd vroeger zijn dan wat kolommen LooptijdeindeDag en 
	LooptijdeindeTijdstip aangeven, en de waarde ‘wel’ als de systeemdatum en –tijd later zijn dan dat.

	AF 4	Tabel Voorwerp, kolom Koper:
	Kolom Koper heeft een NULL-waarde, tenzij de veiling is gesloten en er op het voorwerp een bod is uitgebracht. Dan heeft kolom Koper 
	de waarde uit kolom Bod(Gebruiker) die bij het hoogste bod op hetzelfde voorwerp hoort.

	AF 5	Tabel Voorwerp, kolom Verkoopprijs:
	Kolom Verkoopprijs heeft een NULL-waarde, tenzij de veiling is gesloten en er op het voorwerp een bod is uitgebracht. Dan heeft kolom 
	Verkoopprijs de waarde uit kolom Bod(Bodbedrag) die bij het hoogste bod op hetzelfde voorwerp hoort.
	*/
)

	alter table voorwerp 
		add constraint ck_voorwerp_betalingswijze check (betalingswijze IN ('iDeal', 'PayPal', 'Creditcard', 'Zelf halen')),
		constraint ck_voorwerp_startprijs check (startprijs > 0),
		constraint ck_voorwerp_veilingGesloten check (veilingGesloten IN ('wel', 'niet')),
		constraint ck_voorwerp_verkoopprijs_negatief check (verkoopprijs <= startprijs),
		constraint ck_voorwerp_verkoper_geen_koper check (verkoper != koper)

/*==============================================================*/
/* Table: Bestand												*/
/*==============================================================*/
create table bestand (
	filenaam					varchar(200)		not null,
	voorwerp					int					not null
	constraint pk_bestand_filenaam primary key (filenaam),
	constraint fk_bestand_voorwerp foreign key (voorwerp) references voorwerp (voorwerpnummer) on update cascade on delete no action
)

/*==============================================================*/
/* Table: Rubriek												*/
/*==============================================================*/
create table rubriek (
	rubrieknummer				numeric(3)			not null,
	rubrieknaam					varchar(50)			not null,
	rubriek						numeric(3)			null,
	volgnr						numeric(3)			not null
	constraint pk_rubriek_rubrieknummer primary key (rubrieknummer),
	constraint fk_rubriek_rubriek foreign key (rubriek) references rubriek (rubrieknummer) on update no action on delete no action
)

/*==============================================================*/
/* Table: Voorwerp in rubriek									*/
/*==============================================================*/
create table [voorwerp in rubriek] (
	voorwerp					int					not null,
	[rubriek op laagste niveau]	numeric(3)			not null
	constraint pk_voorwerpinrubriek_voorwerp primary key (voorwerp),
	constraint fk_voorwerpinrubriek_voorwerp foreign key (voorwerp) references voorwerp (voorwerpnummer) on update cascade on delete no action,
	constraint fk_voorwerpinrubriek_rubriekoplaagsteniveau foreign key ([rubriek op laagste niveau]) references rubriek (rubrieknummer) on update no action on delete no action
)
/*
/*==============================================================*/
/* Table: Bod													*/
/*==============================================================*/
create table bod (
	
)
*/



/*			Weghalen		*/
insert into vraag values ('1', 'vraag1')	
insert into gebruiker values ('Beheerder', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 5, null)

insert into verkoper values('Beheerder', null, null, 'controle-optie', null)/*
insert into voorwerp values('titel1', 'beschrijving1', 'startprijs', 'betalingswijze1', null, 'plaatsnaam1', 'land1',
							1, GETDATE(), '11-32-04', null, null, 'Beheerder', null, GETDATE()+1, '11-32-04', 'niet', 1)
insert into voorwerp values('titel2', 'beschrijving2', 'startprijs', 'betalingswijze2', null, 'plaatsnaam2', 'land2',
							2, GETDATE(), '11-32-04', null, null, 'Beheerder', null, GETDATE()+2, '11-32-04', 'niet', 2)
insert into voorwerp values('titel3', 'beschrijving3', 'startprijs', 'betalingswijze3', null, 'plaatsnaam3', 'land3',
							3, GETDATE(), '11-32-04', null, null, 'Beheerder', null, GETDATE()+3, '11-32-04', 'niet', 3)
insert into voorwerp values('titel4', 'beschrijving4', 'startprijs', 'betalingswijze4', null, 'plaatsnaam4', 'land4',
							4, GETDATE()-4, '11-32-04', null, null, 'Beheerder', null, GETDATE(), '11-32-04', 'wel', 4)
insert into voorwerp values('titel5', 'beschrijving5', 'startprijs', 'betalingswijze5', null, 'plaatsnaam5', 'land5',
							5, GETDATE(), '11-32-04', null, null, 'Beheerder', null, GETDATE()+5, '11-32-04', 'niet', 5)*/
use master