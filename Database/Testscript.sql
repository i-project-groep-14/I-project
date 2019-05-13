use EenmaalAndermaal

delete from gebruiker

/* Datum van vandaag */
insert into gebruiker values(
	'gebruikersnaam', 'voornaam', 'achternaam', 'adresregel1', 'adresregel2', 'potcode', 'plaatsnaam', 'land', getDate(), 'mailadres', 
	'wachtwoord1', 1, 'antwoordtekst', 2, 'profielfoto'
)

/* Datum van morgen */
insert into gebruiker values(
	'gebruikersnaam2', 'voornaam', 'achternaam', 'adresregel1', 'adresregel2', 'potcode', 'plaatsnaam', 'land', getDate()+1, 'mailadres', 
	'wachtwoord1', 1, 'antwoordtekst', 2, 'profielfoto'
)

/* Wachtwoord kleiner dan 7 karakters */
insert into gebruiker values(
	'gebruikersnaam3', 'voornaam', 'achternaam', 'adresregel1', 'adresregel2', 'potcode', 'plaatsnaam', 'land', getDate(), 'mailadres', 
	'f', 1, 'antwoordtekst', 2, 'profielfoto'
)

/* Wachtwoord minimaal 1 cijfer */
insert into gebruiker values(
	'gebruikersnaam4', 'voornaam', 'achternaam', 'adresregel1', 'adresregel2', 'potcode', 'plaatsnaam', 'land', getDate(), 'mailadres', 
	'wachtwoord', 1, 'antwoordtekst', 2, 'profielfoto'
)

/* Wachtwoord minimaal 1 letter */
insert into gebruiker values(
	'gebruikersnaam4', 'voornaam', 'achternaam', 'adresregel1', 'adresregel2', 'potcode', 'plaatsnaam', 'land', getDate(), 'mailadres', 
	'1234567', 1, 'antwoordtekst', 2, 'profielfoto'
)


use master