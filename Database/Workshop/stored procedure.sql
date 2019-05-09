DROP PROCEDURE IF EXISTS spVoegSubrubriekToe

GO

CREATE PROCEDURE spVoegSubrubriekToe
	@parentRubriek INT, 
	@subRubriekNaam VARCHAR(50) 
	AS
	BEGIN
	DECLARE @volgNummer INT 

	--Controleren of @ParentRubriek wel bestaat
	IF NOT EXISTS(SELECT * FROM rubriek WHERE rubriekNummer = @parentRubriek)
	BEGIN
		PRINT ('De parentrubriek bestaat niet')
		RETURN
	END
	   
	SELECT @volgNummer = MAX(volgNummer) FROM rubriek WHERE parentRubriek = @parentRubriek
  
	-- Bestaan er al subrubrieken in de parentrubriek?
	-- Zo ja: Volgnummer bepalen en subsubriek gewoon toevoegen aan Rubrieken; 
	-- Volgnr = hoogste volgnr + 1 

	IF @volgNummer IS NOT NULL
	BEGIN 
		INSERT INTO rubriek (rubriekNaam, parentRubriek, volgNummer) VALUES (@subRubriekNaam, @parentRubriek, @volgNummer + 1)
	END

	-- Zo nee: Kijken of er voorwerpen in de parentrubriek zitten
	ELSE
	
		-- Als er geen voorwerpen in de parentrubriek zitten
		-- dan subrubriek toevoegen met volgnummer = 1
		IF NOT EXISTS (SELECT * FROM voorwerpInRubriek WHERE rubriekNummer = @parentRubriek) 
		BEGIN
			INSERT INTO rubriek (rubriekNaam, parentRubriek, volgNummer) VALUES (@subRubriekNaam, @parentRubriek, 1)
		END
		-- Als er wel voorwerpen in de parentrubriek zitten
		-- dan subrubriek "Overig" aanmaken met volgnummer = 1 en voorwerpen daarin zetten
		-- daarna subrubriek met volgnummer = 2 aanmaken
		ELSE
		BEGIN
			DECLARE @rubriekNummerOverig INT
			SELECT @rubriekNummerOverig = MAX(rubriekNummer) FROM rubriek
			SET @rubriekNummerOverig = @rubriekNummerOverig + 1
			SET IDENTITY_INSERT rubriek ON
			INSERT rubriek(rubriekNummer, rubriekNaam, parentRubriek, volgNummer) VALUES (@rubriekNummerOverig, 'Overig', @parentRubriek, 1)
			UPDATE voorwerpInRubriek
				SET rubriekNummer = @rubriekNummerOverig
				WHERE rubriekNummer = @parentRubriek
			SET IDENTITY_INSERT rubriek OFF
			INSERT INTO rubriek (rubriekNaam, parentRubriek, volgNummer) VALUES (@subrubriekNaam, @parentRubriek, 2) 
		END
	END
	
GO

SELECT * FROM rubriek
SELECT * FROM voorwerpInRubriek

GO

EXECUTE spVoegSubrubriekToe 1, "Apple Macbook Air"

GO

SELECT * FROM rubriek
SELECT * FROM voorwerpInRubriek

GO
	
