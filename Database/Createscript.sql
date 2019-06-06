/*==============================================================*/
/* Database name:  EenmaalAndermaal							    */
/* Script:		   I-Project groep 14		                    */
/* Created on:     25-4-2016		                            */
/*==============================================================*/

use master
/*
drop database nepebay
create database nepebay
*/
drop database EenmaalAndermaal

/*==============================================================*/
/* Database: EenmaalAndermaal									*/
/*==============================================================*/
create database EenmaalAndermaal


/*
drop table bestand
drop table bod
drop table gebruikerstelefoon
drop table [voorwerp in rubriek]
drop table voorwerp
drop table verkoper
drop table gebruiker
drop table vraag
drop table rubriek
*/

use EenmaalAndermaal


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
   constraint pk_gebruiker_gebruikersnaam primary key (gebruikersnaam),
   --CONSTRAINT CHK_Postcode CHECK (  (land = 'Nederland' AND postcode like '[0-9][0-9][0-9][0-9][A-Z][A-Z]') OR (postcode like '%[0-9]%') ),
   --CONSTRAINT CHK_email CHECK (mailadres LIKE '%@%.%')

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
	telefoon					char(11)			not null,
	alttelefoon					char(11)			null
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
	beschrijving				varchar(500)		not null,
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
	add constraint ck_voorwerp_betalingswijze check (betalingswijze IN ('-1','iDeal', 'PayPal', 'Creditcard', 'ZelfOphalen')),
	constraint ck_voorwerp_startprijs check (startprijs > 0),
	constraint ck_voorwerp_veilingGesloten check (veilingGesloten IN ('wel', 'niet')),
	constraint ck_voorwerp_verkoopprijs_negatief check (verkoopprijs >= startprijs),
	constraint ck_voorwerp_verkoper_geen_koper check (verkoper != koper)--,
	--CONSTRAINT ck_looptijd CHECK ( looptijd IN (1,3,5,7,10) )

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
	rubrieknummer				int			not null,
	rubrieknaam					varchar(50)			not null,
	rubriek						int			null
	constraint pk_rubriek_rubrieknummer primary key (rubrieknummer),
	constraint fk_rubriek_rubriek foreign key (rubriek) references rubriek (rubrieknummer) on update no action on delete no action
)

/*==============================================================*/
/* Table: Voorwerp in rubriek									*/
/*==============================================================*/
create table [voorwerp in rubriek] (
	voorwerp					int					not null,
	[rubriek op laagste niveau]	int					not null
	constraint pk_voorwerpinrubriek_voorwerp primary key (voorwerp),
	constraint fk_voorwerpinrubriek_voorwerp foreign key (voorwerp) references voorwerp (voorwerpnummer) on update cascade on delete no action,
	constraint fk_voorwerpinrubriek_rubriekoplaagsteniveau foreign key ([rubriek op laagste niveau]) references rubriek (rubrieknummer) on update no action on delete no action
)
/*==============================================================*/
/* Table: Bod													*/
/*==============================================================*/
create table bod (
	voorwerpnummer				int					not null,
	bodbedrag					varchar(10)			not null,
	gebruiker					varchar(20)			not null,
	boddag						date				not null,
	bodtijdstip					time				not null
	constraint pk_bod_voorwerpnummerbodbedrag primary key (voorwerpnummer, bodbedrag),
	constraint ak_bod_gebruikerboddagbodtijdstip unique (gebruiker, boddag, bodtijdstip),
	constraint ak_bod_voorwerpnummerboddagbodtijdstip unique (voorwerpnummer, boddag, bodtijdstip),
	constraint fk_bod_voorwerpnummer foreign key (voorwerpnummer) references voorwerp (voorwerpnummer) on update no action on delete no action,
	constraint fk_bod_gebruiker foreign key (gebruiker) references gebruiker (gebruikersnaam) on update cascade on delete no action
)



/*			Weghalen		*/
insert into vraag values ('1', 'In welke straat ben je geboren?')
insert into vraag values ('2', 'Wat is de meisjesnaam van je moeder?')
insert into vraag values ('3', 'Wat is je lievelingsgerecht?')
insert into vraag values ('4', 'Hoe heet je oudste zusje?')
insert into vraag values ('5', 'Hoe heet je huisdier?')

insert into gebruiker values ('Beheerder', 'Danny', 'Hageman', 'Onbekend', null, '0000AA', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'mehmet.batal@hotmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 5, null)/*
insert into gebruiker values ('Test', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Boom', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Trein', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Viking fiets', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Groen', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('JO', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Hoofd', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Kop', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Poep', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)
insert into gebruiker values ('Peop', 'Danny', 'Hageman', 'Onbekend', null, 'Unknown', 's-Heerenberg', 'Nederland', '11/09/2000', 
								'dannyhageman1109@gmail.com', '$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK', 1, 'f', 2, null)*/

insert into verkoper values('Beheerder', null, null, 'controle-optie', null)

/*
insert into voorwerp values('Kaaskast', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen.', 20, 'iDeal', null, 'plaatsnaam1', 'land1',
							1, GETDATE(), CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME(0),GETDATE()), 'niet', 20)
insert into voorwerp values('Bezem', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen, en het werk aan te vangen, dat gij, lieve lezer, zoâven in de hand hebt genomen, en dat ge lezen moet als ge makelaar in koffie zijt, of als ge wat anders zijt. Niet alleen dat ik nooit nooit nooit nooit nooit nooit nooit nooit nooit nooit nooit nooit nooit nooit nooitnooit', 250, 'Creditcard', null, 'plaatsnaam2', 'land2',
							3, GETDATE()+1, CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME(0),GETDATE()), 'niet', 260)
insert into voorwerp values('Schoen', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen, en het werk aan te vangen, dat gij, lieve lezer, zoâven in de hand hebt genomen, en dat ge lezen moet als ge makelaar in koffie zijt, of als ge wat anders zijt. Niet alleen dat ik nooit ', 500, 'Paypal', null, 'plaatsnaam3', 'land3',
							3, GETDATE()+2, CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME(0),GETDATE()), 'niet', 500)
insert into voorwerp values('Laptop', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen, en het werk aan te vangen, dat gij, lieve lezer, zoâven in de hand hebt genomen, en dat ge lezen moet als ge makelaar in koffie zijt, of als ge wat anders zijt. Niet alleen dat ik nooit ', 200, 'Creditcard', null, 'plaatsnaam4', 'land4',
							5, GETDATE()-4, CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME(0),GETDATE()), 'wel', 300)
insert into voorwerp values('Sokken', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen, en het werk aan te vangen, dat gij, lieve lezer, zoâven in de hand hebt genomen, en dat ge lezen moet als ge makelaar in koffie zijt, of als ge wat anders zijt. Niet alleen dat ik nooit ', 1, 'Creditcard', null, 'plaatsnaam5', 'land5',
							5, GETDATE()-5, CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME(0),GETDATE()), 'wel', 5)
insert into voorwerp values('Kaashond', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen, en het werk aan te vangen, dat gij, lieve lezer, zoâven in de hand hebt genomen, en dat ge lezen moet als ge makelaar in koffie zijt, of als ge wat anders zijt. Niet alleen dat ik nooit ', 1, 'Creditcard', null, 'plaatsnaam6', 'land6',
							7, GETDATE(), CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME(0),GETDATE()), 'niet', 60)
insert into voorwerp values('Banaan', 'Ik ben makelaar in koffi, en woon op de Lauriergracht No 37. Het is mijn gewoonte niet, romans te schrijven, of zulke dingen, en het heeft dan ook lang geduurd, voor ik er toe overging een paar riem papier extra te bestellen, en het werk aan te vangen, dat gij, lieve lezer, zoâven in de hand hebt genomen, en dat ge lezen moet als ge makelaar in koffie zijt, of als ge wat anders zijt. Niet alleen dat ik nooit ', 1, 'PayPal', null, 'plaatsnaam7', 'land7',
							10, GETDATE()+5, CONVERT(TIME(0),GETDATE()), null, null, 'Beheerder', null, CONVERT(TIME,dateadd(hour, -1, GETDATE()))
							, 'niet', 60)
							
insert into bestand values('images/Salade.jpg', 1)
insert into bestand values('images/Fiets.jpg', 1)
insert into bestand values('images/Eend.jpg', 1)
insert into bestand values('images/profielfotoPlaceholder.png', 1)
insert into bestand values('images/kaaskast.jpg', 1)
insert into bestand values('images/bezem.jpg', 2)
insert into bestand values('images/schoen.jpg', 3)
insert into bestand values('images/laptop.jpg', 4)
insert into bestand values('images/sokken.jpg', 5)
insert into bestand values('images/kaashond.jpg', 6)
insert into bestand values('images/banaan.jpg', 7)
*/

/*
insert into rubriek values (0,'Hoofdrubriek', null)
insert into rubriek values (1,'Muziekinstrumenten', 0)
insert into rubriek values (2,'Gitaren', 1)
insert into rubriek values (3,'Trompetten', 1)
insert into rubriek values (4,'Trombones', 1)
insert into rubriek values (5,'Pianos', 1)
insert into rubriek values (6,'Elektrische Gitaren', 2)
insert into rubriek values (7,'Acoustische Gitaren', 2)

insert into rubriek values (8,'Computers', 0)
insert into rubriek values (9,'Laptops', 8)
insert into rubriek values (10,'Beeldschermen', 8)
insert into rubriek values (11,'Toetsenborden', 8)
insert into rubriek values (12,'Muizen', 8)
insert into rubriek values (13,'Opladers', 9)
insert into rubriek values (14,'Trackpads', 9)

insert into rubriek values (15,'Snaren', 6)

insert into [voorwerp in rubriek] values (1, 14)
insert into [voorwerp in rubriek] values (2, 5)

insert into [voorwerp in rubriek] values (4, 13)
insert into [voorwerp in rubriek] values (5, 13)

insert into [voorwerp in rubriek] values (7, 7)
insert into [voorwerp in rubriek] values (3, 15)
insert into [voorwerp in rubriek] values (6, 12)
*/
/*
voorwerp dat sluit na 20 seconden
insert into voorwerp values('Test', 'f', 1, 'PayPal', null, 'plaatsnaam7', 'land7', 0, GETDATE(), CONVERT(TIME(0),GETDATE()), null, null, 
							'Beheerder', null, CONVERT(TIME,dateadd(second, 20, GETDATE())), 'niet', 60)
*/

go

create view aantalBiedingenPerPersoon AS
select  count(voorwerpnummer) as aantal, gebruiker
from bod
group by voorwerpnummer, gebruiker


GO

CREATE TRIGGER trgMaxAfbeeldingen ON bestand
FOR INSERT, UPDATE
AS
BEGIN
	BEGIN TRANSACTION
	IF EXISTS
		(
		SELECT *
		FROM bestand
		GROUP BY voorwerp
		HAVING COUNT(*) > 4 
		)
		BEGIN
			PRINT('Er mogen niet meer dan 4 bestanden per artikel worden vastgelegd')
			ROLLBACK
		END
	ELSE
		COMMIT
END


GO

/*
CREATE FUNCTION fnRubriekIsOpLaagsteNiveau
(
  @rubriekNummer int
) RETURNS BIT
AS
BEGIN
 IF EXISTS
 (
   SELECT * FROM rubriek
   WHERE rubriek = @rubriekNummer
 ) RETURN 0

 RETURN 1
END


GO

ALTER TABLE [voorwerp in rubriek]
ADD CONSTRAINT CHK_LaagsteNiveau CHECK ( dbo.fnRubriekIsOpLaagsteNiveau([rubriek op laagste niveau]) = 1  )

GO
*/

CREATE FUNCTION fnWieIsVerkoper
(
  @voorwerpNummer INT
) RETURNS VARCHAR(20)
AS
BEGIN
 RETURN 
  ( SELECT verkoper FROM voorwerp WHERE voorwerpNummer = @voorwerpNummer )
END

GO

ALTER TABLE bod
ADD CONSTRAINT ck_NietBiedenEigenProduct CHECK (dbo.fnWieIsVerkoper(voorwerpNummer) <> gebruiker  )


GO


CREATE FUNCTION fnVeilingGesloten
(
  @voorwerpNummer INT
) RETURNS BIT
AS
BEGIN
  RETURN 
  ( 
  SELECT veilingGesloten
  FROM voorwerp
  WHERE voorwerpNummer = @voorwerpNummer
  )

END


GO


ALTER TABLE bod
ADD CONSTRAINT CHK_VeilingOpen CHECK (dbo.fnVeilingGesloten(voorwerpNummer) = 0 )

GO

CREATE FUNCTION fnHoogsteBieder
(
  @voorwerpNummer INT
) RETURNS VARCHAR(20)
AS
BEGIN
 RETURN
   (SELECT TOP 1 B.gebruiker 
    FROM voorwerp V
    INNER JOIN bod B ON V.voorwerpNummer = B.voorwerpNummer
    WHERE V.voorwerpNummer = @voorwerpNummer AND veilingGesloten = 1
    ORDER BY bodBedrag DESC
   )
END

GO

ALTER TABLE voorwerp
ADD HoogsteBieder AS dbo.fnHoogsteBieder(voorwerpNummer) --Appendix E, blz 13  AF4
/*
GO


CREATE FUNCTION fnHoogsteBod
(
  @voorwerpNummer INT
) RETURNS VARCHAR(20)
AS
BEGIN
 RETURN
   (SELECT TOP 1 bodBedrag
    FROM voorwerp V
    INNER JOIN bod B ON V.voorwerpNummer = B.voorwerpNummer
    WHERE V.voorwerpNummer = @voorwerpNummer AND veilingGesloten = 1
    ORDER BY bodBedrag DESC
   )
END

GO

ALTER TABLE voorwerp
ADD verkoopprijs AS dbo.fnHoogsteBod(voorwerpnummer)
*/
GO

CREATE FUNCTION fnIsVerkoper
	(
	  @gebruikersNaam varchar(20)
	) RETURNS BIT
	AS
	BEGIN
	 IF EXISTS
			(
			  SELECT * 
			  FROM verkoper 
			  WHERE gebruiker = @gebruikersNaam
			) 
	 RETURN 1 
	RETURN 0 
END

GO

ALTER TABLE gebruiker
ADD isVerkoper AS dbo.fnIsVerkoper(gebruikersNaam)

GO


use master
