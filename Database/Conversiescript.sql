use EenmaalAndermaal

INSERT INTO EenmaalAndermaal.dbo.gebruiker
	SELECT DISTINCT left(Username, 20) AS gebruikersnaam,
	cast('Onbekend' AS char) AS voornaam,
	cast('Onbekend' AS char) AS achternaam,
	cast('Onbekend' AS char) AS adresregel1,
	NULL AS adresregel2,
	left(Postalcode,7) AS postcode,
	cast('Onbekend' AS char) AS plaatsnaam,
	left(Location,20) AS land,
	cast('01/01/1970' AS date) AS geboortedatum,
	cast('Onbekend' AS char) AS mailadres,
	left('$2y$10$N3OV4ufDLSmmUo7plcUezePdhPwXDQZHn9tnLLkOkalNkNNjXIGFK',255) AS wachtwoord,
	cast('1' AS int) AS vraag,
	cast('f'AS char) AS antwoordtekst,
	cast('2'AS int) AS rol,
	NULL AS profielfoto
FROM nepebay.dbo.Users

INSERT INTO EenmaalAndermaal.dbo.rubriek
	SELECT distinct cast(ID AS int)+1 AS rubrieknummer,
	left(name,50) AS rubrieknaam,
	cast(Parent AS int)+1 AS rubriek
FROM nepebay.dbo.Categorieen

INSERT INTO EenmaalAndermaal.dbo.verkoper
	SELECT distinct LEFT(verkoper,20) as gebruiker,
	null as bank,
	null as bankrekening,
	LEFT('Post',20) as controleoptie,
	null as creditcard
FROM nepebay.dbo.items

update EenmaalAndermaal.dbo.gebruiker
set rol = 3
from EenmaalAndermaal.dbo.gebruiker
where gebruikersnaam in (select gebruiker from verkoper)

set identity_insert dbo.voorwerp on
INSERT INTO EenmaalAndermaal.dbo.voorwerp (voorwerpnummer, titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, plaatsnaam, land, looptijd, looptijdbeginDag, looptijdbeginTijdstip, verzendkosten, verzendinstructies, verkoper, koper, looptijdeindeTijdstip, veilingGesloten, verkoopprijs)
	SELECT distinct CAST(ID as bigint) as voorwerpnummer,
	left(titel,30) as titel,
	LEFT(beschrijving,500) as beschrijving,
	cast(Prijs as float) as startprijs,
	left('PayPal',20) as betalingswijze,
	null as betalingsinstructie,
	left(locatie,20) as plaatsnaam,
	LEFT(land,20) as land,
	CAST('7' as int) as looptijd,
	cast(GETDATE() as date) as looptijdbeginDag,
	cast(CONVERT(TIME(0),GETDATE()) as time) as looptijdbeginTijdstip,
	null as verzendkosten,
	null as verzendinstructies,
	LEFT(verkoper,20) as verkoper,
	null as koper,
	cast(CONVERT(TIME(0),GETDATE()+7) as time) as looptijdeindeTijdstip,
	LEFT('niet', 4) as veilingGesloten,
	null as verkoopprijs
FROM nepebay.dbo.items
/*
INSERT INTO EenmaalAndermaal.dbo.bestand
	SELECT distinct left(IllustratieFile,200) as filenaam,
	cast(ItemID as bigint) as voorwerp
FROM nepebay.dbo.Illustraties
group by IllustratieFile, ItemID
having (COUNT(*) < 4)

INSERT INTO EenmaalAndermaal.dbo.[voorwerp in rubriek]
	SELECT CAST(ID as bigint) as voorwerp,
	CAST(Categorie as int) as [rubriek op laagste niveau]
FROM nepebay.dbo.Items
*/



use master