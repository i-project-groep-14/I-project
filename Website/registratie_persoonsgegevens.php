<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <link href="" rel="stylesheet">
    <title>EenmaalAndermaal registreren</title>
</head>
    <header>
            <h1>EenmaalAndermaal</h1>    
    </header>
    <body>
        <h2>Registreren</h2>
        <p>
            Dit is de tweede stap van het registreren. Vul a.u.b uw persoonlijkegegevens hieronder in. 
        </p>
        <form action="" >
            Gebruikersnaam:
            <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam">
            <br>
            Voornaam:
            <input type="text" placeholder="Voornaam" name="voornaam" >
            Achternaam:
            <input type="text" placeholder="Achternaam" naam="achternaam" >
            <br>
            Adres:
            <input type="text" placeholder="Adres" name="adres"><br>
            Toevoeging Adres (Optioneel): <br>
            <input type="text" placeholder="Tweede adres" name="oAdres">
            <label>Meer informatie?</label>
            <input type="checkbox"><p>Dit is een extra adres regel voor mensen die buiten Nederland wonen.</p>
            <br>
            Postcode:
            <input type="text" placeholder="Postcode" name="postcode">
            Plaatsnaam:
            <input type="text" placeholder="Plaats" name="plaats">        
            <br>
            Landsnaam:
            <input type="text" placeholder="Land" name="land">
            <br>
            Telefoonnr:
            <input type="tel" placeholder="Telefoonnr" >
            Telefoonnr 2 (Optioneel):
            <input type="tel" placeholder="Telefoonnr"><br>
            Geboortedatum:
            <input type="date" name="geboortedatum">
            <br>
            Wachtwoord:
            <input type="text" placeholder="Wachtwoord" name="wachtwoord">
            <br>
            Bevestig Wachtwoord:
            <input type="text" placeholder="Bevestig wachtwoord" name="bWachtwoord">
            <br>
            Wordt dit een verkopersaccount?
            <br>
            <label for="wel">Wel</label>
            <input type="radio" name="eenVerkoper" id="wel"> 
            <label for="niet">Niet</label>
            <input type="radio" name="eenVerkoper" id="niet"> 
            <br>
            Dit kan na een normaal account, nog altijd een verkopersaccount worden. 
            <br>
            <input type="submit" name="verzenden_pers" value="Verzenden">
        
        </form>
    </body>

</html>

