<?php 
    global $config;

    if ($config['pagina'] != 'registratie_email') {
        include_once 'aanroepingen/functies.php';
    }

    if(!isset($_SESSION)) {
        session_start();
    }

    if(isset($_SESSION['login']) || isset($_SESSION['nieuwWachtwoord'])) {
        $sql = "SELECT rol, gebruikersnaam, voornaam, plaatsnaam, land FROM gebruiker 
                WHERE gebruikersnaam like :gebruikersnaam";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':gebruikersnaam' => $_SESSION['gebruikersnaam']
        ));

        $row = $query -> fetch();
        $_SESSION['gebruikersnaam'] = strip_tags($row['gebruikersnaam']);
        $_SESSION['voornaam'] = strip_tags($row['voornaam']);
        if ($row['rol'] == 5) {
            $_SESSION['beheerder'] = true;
        }

        $_SESSION['rol'] = strip_tags($row['rol']);
        $_SESSION['plaatsnaam'] = strip_tags($row['plaatsnaam']);
        $_SESSION['land'] = strip_tags($row['land']);

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
                    <div class="DesktopLogo">
                    <a href="Index.php"><img src="Images/Logo.png" class="Logo" alt="EenmaalAndermaal"></a>
                    </div>
                    <div class="MobielLogo">
                    <a href="Index.php"><img src="Images/LogoMobiel.png" class="Logo" alt="EenmaalAndermaal"></a>
                    </div>
                </div>
                <div class="top-bar-middle">
                    <?php if ($config['pagina'] !='rubriekenpagina') { include_once "Zoekfunctie.php"; } ?>
                </div>
                <div class="top-bar-rechts">
                    <?php
                        if(isset($_SESSION['login']) || isset($_SESSION['nieuwWachtwoord'])) {                        
                            echo "
                            <button class='button loginbutton uitlogknop' type='submit' data-toggle='example-dropdown-bottom-right'>Account</button>
                                
                            <div class='dropdown-pane' data-position='bottom' data-alignment='right'  id='example-dropdown-bottom-right' data-dropdown data-auto-focus='true'>
                              <!-- Onderdelen van de dropdown komen hier te staan -->
                                <!--<img src='images/profielfotoplaceholder.png' width='150px'>-->
                                <p>Naam: ".$_SESSION['voornaam']."</p>
                                <p>Aantal actieve veilingen: ".$_SESSION['aantaleigenveilingen']."</p>";
                                if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 5) {
                                    echo "<a href='voorwerpplaatsenpagina.php' class='button loginbutton uitlogknop'>Voorwerp Plaatsen</a>";
                                    }
                                if(isset($_SESSION['beheerder'])) {
                                    echo "<a href='beheerderspagina.php' class='button loginbutton uitlogknop'>Beheerderspagina</a>";
                                }
                                if($_SESSION['rol'] == 3 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 5) {
                                    echo "<a href='Profielpagina.php' class='button loginbutton uitlogknop'>Profielpagina</a>";
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
            <?php
                include_once 'aanroepingen/RubNavMobiel.php';
                include_once 'aanroepingen/RubNav.php';
            ?>
        </div>