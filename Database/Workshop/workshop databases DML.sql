USE workshop

GO

DELETE FROM voorwerpInRubriek
DELETE FROM bestand
DELETE FROM voorwerp
DELETE FROM verkoper
DELETE FROM gebruiker
DELETE FROM rubriek

GO

/* Hoofdrubriek Laptops, daaronder subrubrieken Apple - Dell */
SET IDENTITY_INSERT rubriek ON
INSERT INTO rubriek (rubriekNummer, rubriekNaam, parentRubriek, volgNummer) VALUES (0, 'Laptops', NULL, 1) -- Volgnr 1
INSERT INTO rubriek (rubriekNummer, rubriekNaam, parentRubriek, volgNummer) VALUES (1, 'Apple', 0, 1) , (2, 'Dell', 0, 2)
SET IDENTITY_INSERT rubriek OFF

SELECT * FROM rubriek -- Rubrieken 1 = Laptops, 2 = Apple, 3 = Dell 

INSERT gebruiker (gebruikersNaam, postCode, land, geboorteDatum, mailBox)
VALUES ('hrlr', '6826 CC', 'Nederland', '1960-06-02', 'rein.harle@han.nl')

SELECT * FROM gebruiker --IsVerkoper = 0

INSERT verkoper (gebruikersNaam) VALUES ('hrlr')
SELECT * FROM gebruiker --IsVerkoper=1

SET IDENTITY_INSERT voorwerp ON
INSERT voorwerp (voorwerpNummer, titel, beschrijving, startPrijs, betalingsWijze, land, loopTijd, looptijdBeginMoment, verkoper)
VALUES (1, 'Apple Macbook Pro 17"', 'Nette Apple Macbook Pro, versie 2012 met 256 GB SSD', 850.50, 'Contant', 'Nederland', 5,  GETDATE(),'hrlr')
SET IDENTITY_INSERT voorwerp OFF

SELECT * FROM voorwerp -- Apple Macbook Pro 19" met voorwerpnummer = 1

GO

INSERT INTO bestand (fileNaam, voorwerpNummer) VALUES ('plaatje 1.jpg', 1)
GO

INSERT INTO bestand (fileNaam, voorwerpNummer) VALUES ('plaatje 2.jpg', 1)
GO

INSERT INTO bestand (fileNaam, voorwerpNummer) VALUES ('plaatje 3.jpg', 1)
GO

INSERT INTO bestand (fileNaam, voorwerpNummer) VALUES ('plaatje 4.jpg', 1)
GO

INSERT INTO bestand (fileNaam, voorwerpNummer) VALUES ('plaatje 5.jpg', 1)
GO

SELECT * FROM bestand -- Plaatjes 1 t/m 4

GO

BEGIN TRY
	INSERT voorwerpInRubriek (voorwerpNummer, rubriekNummer) VALUES (1, 0) --Error: rubriek 0 (Laptops) is niet op het laagste niveau
	PRINT 'Insert (voorwerpInRubriek) gelukt'
END TRY
BEGIN CATCH
	PRINT 'Insert (voorwerpInRubriek) mislukt'
END CATCH

BEGIN TRY
	INSERT voorwerpInRubriek (voorwerpNummer, rubriekNummer) VALUES (1, 1) --Ok: rubriek 1 (Apple) is op het laagste niveau
	PRINT 'Insert (voorwerpInRubriek) gelukt'
END TRY
BEGIN CATCH
	PRINT 'Insert (voorwerpInRubriek) mislukt'
END CATCH

SELECT * from voorwerpInRubriek

GO