<?php 
    // global $config;

    if(!isset($_SESSION)) {
        session_start();
    }

    if(isset($_POST['register']) && isset($_POST['veiligheidsvraag']) && $_POST['veiligheidsvraag'] != "0") {
        $email = $_SESSION['email'];

        $gebruikersnaam = $_SESSION['gebruikersnaam'];
        $voornaam = $_SESSION['voornaam'];
        $achternaam = $_SESSION['achternaam'];
        $adres = $_SESSION['adres'];
        if(isset($_SESSION['oAdres'])) {
            $oAdres = $_SESSION['oAdres'];
        }
        $postcode = $_SESSION['postcode'];
        $plaats = $_SESSION['plaats'];
        $land = $_SESSION['land'];
        $telefoonnr1 = $_SESSION['telnr1'];
        if(isset($_SESSION['telnr2'])) {
            $telefoonnr2 = $_SESSION['telnr2'];
        }
        $geboortedatum = $_SESSION['geboortedatum'];
        $wachtwoord = $_SESSION['wachtwoord'];
        // $wachtwoord_confirm = $_SESSION['bWachtwoord'];
        $rol = $_SESSION['eenVerkoper'];

        $vraag = $_POST['veiligheidsvraag'];
        $antwoord = $_POST['veiligheidsvraag_antwoord'];

        $sql = "INSERT INTO gebruiker VALUES
                (:gebruikersnaam, :voornaam, :achternaam, :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedatum, :mailadres, :wachtwoord, :vraag, :antwoordtekst, :rol, :profielfoto)";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruikersnaam' => $gebruikersnaam,
            ':voornaam' => $voornaam,
            ':achternaam' => $achternaam,
            ':adresregel1' => $adres,
            ':adresregel2' => $oAdres,
            ':postcode' => $postcode,
            ':plaatsnaam' => $plaats,
            ':land' => $land,
            ':geboortedatum' => $geboortedatum,
            ':mailadres' => $email,
            ':wachtwoord' => password_hash($wachtwoord, PASSWORD_DEFAULT),
            ':vraag' => $vraag,
            ':antwoordtekst' => $antwoord,
            ':rol' => $rol,
            ':profielfoto' => NULL
            )
        );

        $sql = "INSERT INTO gebruikerstelefoon VALUES (:gebruiker, :telefoon)";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruiker' => $gebruikersnaam,
            ':telefoon' => $telefoonnr1
            )
        );

        if(isset($telefoonnr2)) {
            $sql = "INSERT INTO gebruikerstelefoon VALUES (:gebruiker, :telefoon)";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':gebruiker' => $gebruikersnaam,
                ':telefoon' => $telefoonnr2
                )
            );
        }
        
        session_destroy();
        session_start();
    }
?>

<!DOCTYPE html>
<html lang='nl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <meta name='description' content='EenmaalAndermaal - Groep14'>
    <link rel='icon' href='images/Logo.png' type='image/x-icon'/>
    <title>EenmaalAndermaal</title>
    <link rel='stylesheet' href='css/foundation.css'>
    <link rel='stylesheet' href='css/foundation-icons.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <script src="js/jquery.min.js"></script>
    <script src="js/foundation.min.js"></script>
</head>
<body>
    
    
    <div class="top-bar" id="realEstateMenu">
    
        <div class="top-bar-left">
                
            <ul class="menu" data-responsive-menu="accordion">
                
                <a href="Index.php"><img src="Images/LogoMetNaam.png" class="Logo" alt="Flowers in Chania"></a>
                <h1 class="menu-text">EenmaalAndermaal</h1>
                
                
                <div class="input-group input-group-rounded">
                        
                        <input   type="text" placeholder="Postcode">
                      
                        <select>
                                <option value="1000">Alle afstanden...</option>
                                <option value="10">10km</option>
                                <option value="20">20km</option>
                                <option value="30">30km</option>
                                <option value="40">40km</option>
                            </select>
                       
                    <input  type="search" placeholder="Zoek product...">
                    
                    <div class="input-group-button">
                    <input type="submit" class="button" id="search"  value="Search"><br>         
                    </div> 
                </div> 
                
            </ul>
            
            
        </div>       
        
        <br>
        <div class="top-bar-right">
            <ul class="menu">
                <li><a class="button loginbutton" onclick="window.location.href = 'inlogpagina.php';" id="loginbutton">Login</a></li>
            </ul>
        
        </div>
        
        
    </div>

    
  

