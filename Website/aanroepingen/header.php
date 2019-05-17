<?php 
    global $config;

    if(!isset($_SESSION)) {
        session_start();
    }

    if(isset($_SESSION['register']) && isset($_SESSION['veiligheidsvraag']) && $_SESSION['veiligheidsvraag'] != "0" && strlen($_SESSION['veiligheidsvraag_antwoord']) <= 50) {
        unset($_SESSION['register']);
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
        $rol = $_SESSION['eenVerkoper'];

        $vraag = $_SESSION['veiligheidsvraag'];
        $antwoord = $_SESSION['veiligheidsvraag_antwoord'];

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
        $_SESSION['login'] = true;
        $_SESSION['gebruikersnaam'] = $gebruikersnaam;
        $_SESSION['voornaam'] = $voornaam;
    }

    if(isset($_SESSION['login'])) {
        $sql = "SELECT rol, gebruikersnaam, voornaam FROM gebruiker 
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruikersnaam' => $_SESSION['gebruikersnaam']
        ));

        $row = $query -> fetch();

        $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
        $_SESSION['voornaam'] = $row['voornaam'];
        if ($row['rol'] == 5) {
            $_SESSION['beheerder'] = true;
        }

        $sql = "SELECT count(*) as 'aantalveilingen' FROM voorwerp 
                WHERE verkoper like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruikersnaam' => $_SESSION['gebruikersnaam']
        ));

        $row = $query -> fetch();
        $_SESSION['aantaleigenveilingen'] = $row['aantalveilingen'];
    }
?>

<!DOCTYPE html>
<html lang='nl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <meta name='description' content='EenmaalAndermaal - Groep14'>
    <link rel='icon' href='images/LogoIcoon.png' type='image/x-icon'/>
    <title>EenmaalAndermaal</title>
    
    <link rel='stylesheet' href='css/foundation.min.css'>
    <link rel='stylesheet' href='css/foundation.css'>
    <link rel='stylesheet' href='css/foundation-icons.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <script src="js/jquery.min.js"></script>
    <script src="js/foundation.min.js"></script>
</head>
<body>
    <div class="holy-grail-grid">
        <div class="holy-grail-header">
            <div class="top-bar" id="realEstateMenu">
                <div class="Top-bar-links">
                    <a href="Index.php"><img src="Images/Logo.png" class="Logo" alt="EenmaalAndermaal"></a>
                </div>
                <div class="top-bar-middle">
                    <?php if ($config['pagina'] !='rubriekenpagina') { include_once "Zoekfunctie.php"; } ?>
                </div>
                <div class="top-bar-rechts">
                    <?php
                        if(isset($_SESSION['login'])) {
                            echo "<p class='gebruiker'>Welkom ".strip_tags($_SESSION['gebruikersnaam']."!</p>");
                        
                            echo "
                            </li> <button class='button loginbutton uitlogknop' type='submit' data-toggle='example-dropdown-bottom-right'>Account</button>

                            <div class='dropdown-pane' data-position='bottom' data-alignment='right'  id='example-dropdown-bottom-right' data-dropdown data-auto-focus='true'>
                              <!-- Onderdelen van de dropdown komen hier te staan -->
                                <img src='images/profielfotoplaceholder.png' width='150px'>
                              
                                <p>Naam: ".$_SESSION['voornaam']."</p>
                                <p>Aantal actieve veilingen:".$_SESSION['aantaleigenveilingen']."</p>";
                                if(isset($_SESSION['beheerder'])) {
                                    echo "<a href='beheerderspagina.php' class='button'>Beheerderspagina</a>";
                                }
                                echo "
                              <form action='index.php' method='post'>
                                <input type='submit' value='Uitloggen' name='loguit' class='button loginbutton uitlogknop'>
                              </form>
                            </div>" ;
                        
                            if(isset($_POST['loguit'])) {
                                if(isset($_SESSION)) {
                                    session_destroy();
                                    header ('Location: '.$config['pagina'].'.php');
                                    // om een of andere reden gaat hij altijd naar index
                                }
                            }
                        } else {
                            echo "<a class='button loginbutton' href='inlogpagina.php'>Login</a>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="holy-grail-left">
            <?php include_once 'aanroepingen/RubNav.php';
            include_once 'aanroepingen/RubNavMobiel.php'?>
        </div>