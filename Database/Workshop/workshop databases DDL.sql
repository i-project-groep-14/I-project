USE master
GO

DROP DATABASE IF EXISTS workshop
GO

CREATE DATABASE workshop
GO

use workshop
GO

CREATE TABLE bod
(
voorwerpNummer	INTEGER			NOT NULL,
bodBedrag		NUMERIC(8,2)	NOT NULL,
gebruikersNaam	VARCHAR(20)		NOT NULL,
bodMoment		DATETIME		NOT NULL DEFAULT GETDATE(), 
CONSTRAINT PK_bod PRIMARY KEY (voorwerpNummer, bodBedrag)
)

GO

CREATE TABLE gebruiker
(
gebruikersNaam	VARCHAR (20)	NOT NULL, 
postCode		VARCHAR (9)		NOT NULL,  -- Lastig met internationale postcodes, wereldwijd maxlengte is 9.. zie http://www.barnesandnoble.com/help/cds2.asp?PID=8134
land			VARCHAR (56)	NOT NULL DEFAULT 'Nederland',  --LEN('The United Kingdom of Great Britain and Northern Ireland')
geboorteDatum	DATE			NOT NULL, 
mailBox			VARCHAR (30)	NOT NULL, 
CONSTRAINT PK_gebruiker PRIMARY KEY (gebruikersNaam),
CONSTRAINT CHK_email CHECK (mailbox LIKE '%@%.%'),		--Basale check op email; bevat @ en daarna een .
CONSTRAINT CHK_postcode CHECK (postcode LIKE '%[0-9]%') --Moet tenminste een cijfer bevatten; kan mooier:
--CONSTRAINT CHK_Postcode CHECK (  (land = 'Nederland' AND postcode like '[0-9][0-9][0-9][0-9][A-Z][A-Z]') OR (postcode like '%[0-9]%') )
)

GO

CREATE TABLE voorwerp
(
voorwerpNummer			INT IDENTITY(1,1)								NOT NULL, --Identity: appendix C blz 8: EenmaalAndermaal genereert zelf een uniek voorwerpnummer
titel					VARCHAR (50)								NOT NULL, 
beschrijving			VARCHAR(MAX)								NOT NULL, 
startPrijs				NUMERIC(8,2)								NOT NULL, 
betalingsWijze			VARCHAR(10)									NOT NULL, 
land					VARCHAR(56)									NOT NULL DEFAULT 'Nederland', 
loopTijd				TINYINT										NOT NULL DEFAULT 7, --Appendix C, blz 8   7 dagen is de default. 
loopTijdBeginMoment		DATETIME									NOT NULL DEFAULT GETDATE(),  --Samenvoegen dag+tijdstip tot moment om gebruik te kunnen maken van datetime functies
verkoper				VARCHAR(20)									NOT NULL,
eindeLoopTijd			AS											DATEADD(DAY,looptijd, looptijdBeginMoment),											--AF1 en AF2, Appendix E blz 13
veilingGesloten			AS											CASE WHEN GETDATE() > DATEADD(DAY,looptijd, looptijdBeginMoment) THEN 1 ELSE 0 END,	--AF3 
CONSTRAINT PK_voorwerp	PRIMARY KEY (voorwerpNummer),
CONSTRAINT CHK_titel	CHECK ( LEN( RTRIM(LTRIM(titel)) ) > 3 ),    --Tenminste 3 karakers lang, voorloopspaties niet meegeteld
CONSTRAINT CHK_looptijd CHECK ( looptijd IN (1,3,5,7,10) ),			--Appendix C, blz 8   1, 3, 5, 7 of 10 dagen (7 dagen is de default). 
CONSTRAINT CHK_betalingswijze CHECK ( betalingsWijze IN ('Contant','Bank/Giro','Anders' ) ), --Appendix C, blz 8  uit Contant, Bank/Giro of Anders
CONSTRAINT CHK_startprijs CHECK ( startPrijs >= 1 )					--startprijs moet positief getal zijn boven de 1 euro.. zie appendix B, blz 3 verhogingstabel
)

GO

ALTER TABLE bod
ADD CONSTRAINT FK_bod_voorwerp FOREIGN KEY (voorwerpNummer)
REFERENCES voorwerp (voorwerpNummer)

ALTER TABLE bod
ADD CONSTRAINT FK_bod_gebruiker FOREIGN KEY (gebruikersNaam)
REFERENCES gebruiker (gebruikersNaam)

GO

/* Niet bieden op een eigen voorwerp */

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
ADD CONSTRAINT CHK_NietBiedenEigenProdukt CHECK (dbo.fnWieIsVerkoper(voorwerpNummer) <> gebruikersNaam  ) --Appendix E, B6

GO

/* Niet bieden op een gesloten veiling */

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

/* Hoogste bieder toevoegen als kolom aan voorwerp */

CREATE FUNCTION fnHoogsteBieder
(
  @voorwerpNummer INT
) RETURNS VARCHAR(20)
AS
BEGIN
 RETURN
   (SELECT TOP 1 B.gebruikersNaam 
    FROM voorwerp V
    INNER JOIN bod B ON V.voorwerpNummer = B.voorwerpNummer
    WHERE V.voorwerpNummer = @voorwerpNummer AND veilingGesloten = 1
    ORDER BY bodBedrag DESC
   )
END

GO

ALTER TABLE voorwerp
ADD HoogsteBieder AS dbo.fnHoogsteBieder(voorwerpNummer) --Appendix E, blz 13  AF4

GO

/* Hoogste bod toevoegen als kolom aan voorwerp */

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

   --OF
   /*
   (SELECT MAX(bodBedrag)
    FROM voorwerp
    INNER JOIN bod ON voorwerp.voorwerpNummer = bod.voorwerpNummer
    WHERE voorwerpNummer = @voorwerpNummer AND veilingGesloten = 1
   )
   */
END

GO

ALTER TABLE voorwerp
ADD verkoopPrijs AS dbo.fnHoogsteBod(voorwerpNummer) --Appendix E, blz 13  AF5


GO

/* Tabel verkoper maken */

CREATE TABLE verkoper
(
gebruikersNaam				VARCHAR (20)	NOT NULL, 
constraint PK_verkoper		PRIMARY KEY (gebruikersNaam),
)

GO

ALTER TABLE verkoper
ADD CONSTRAINT FK_verkoper_gebruiker FOREIGN KEY (gebruikersNaam)
REFERENCES gebruiker (gebruikersNaam)

GO

ALTER TABLE voorwerp
ADD CONSTRAINT FK_voorwerp_verkoper  FOREIGN KEY (verkoper)
REFERENCES verkoper (gebruikersNaam)

GO

/* isVerkoper toevoegen als kolom aan tabel gebruiker */

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
			  WHERE gebruikersNaam = @gebruikersNaam
			) 
	 RETURN 1 
	RETURN 0 
END

GO

ALTER TABLE gebruiker
ADD isVerkoper AS dbo.fnIsVerkoper(gebruikersNaam) --opnemen als berekend veld in gebruiker

GO

/* Tabel maken die plaatjes aan voorwerpen koppelt */

CREATE TABLE bestand
(
fileNaam		VARCHAR(255)	NOT NULL, 
voorwerpNummer	INTEGER			NOT NULL,
CONSTRAINT PK_bestand PRIMARY KEY (fileNaam),
CONSTRAINT CHK_fileFormaat CHECK ( (fileNaam LIKE '%.jpg') OR (fileNaam LIKE '%.jpeg') OR (fileNaam LIKE '%.gif') OR (fileNaam LIKE '%.png') OR (fileNaam LIKE '%.bmp') ) --App C blz 8: afbeeldingen uploaden in een standaardformaat (jpeg of zo). 
)

GO

ALTER TABLE bestand
ADD CONSTRAINT FK_bestand_voorwerp FOREIGN KEY (voorwerpNummer)
REFERENCES voorwerp (voorwerpNummer)

GO

/*B4: Per voorwerp kunnen maximaal 4 afbeeldingen worden opgeslagen */

CREATE TRIGGER trgMaxAfbeeldingen ON bestand
FOR INSERT, UPDATE
AS
BEGIN
	BEGIN TRANSACTION
	IF EXISTS
		(
		SELECT *
		FROM bestand
		GROUP BY voorwerpNummer
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

CREATE TABLE rubriek
(
	rubriekNummer	INT IDENTITY (0,1)	NOT NULL,
	rubriekNaam		VARCHAR (50)		NOT NULL,
	parentRubriek	INTEGER				NULL,
	volgNummer		INTEGER				NOT NULL,
	constraint PK_rubriek PRIMARY KEY (rubriekNummer)
)

GO

ALTER TABLE rubriek
ADD CONSTRAINT FK_rubriek_rubriek FOREIGN KEY (parentRubriek)
REFERENCES rubriek (rubriekNummer)

GO

CREATE TABLE voorwerpInRubriek
(
voorwerpNummer		INTEGER		NOT NULL, 
rubriekNummer  		INTEGER		NOT NULL,
CONSTRAINT PK_voorwerpInRubriek PRIMARY KEY (voorwerpNummer, rubriekNummer)
)

GO

/* Alleen voorwerp toevoegen in rubriek op laagste niveau */

CREATE FUNCTION fnRubriekIsOpLaagsteNiveau
(
  @rubriekNummer int
) RETURNS BIT
AS
BEGIN
 IF EXISTS
 (
   SELECT * FROM rubriek
   WHERE parentRubriek = @rubriekNummer
 ) RETURN 0

 RETURN 1
END

GO

ALTER TABLE voorwerpInRubriek
ADD CONSTRAINT CHK_LaagsteNiveau CHECK ( dbo.fnRubriekIsOpLaagsteNiveau(rubriekNummer) = 1  )

GO



