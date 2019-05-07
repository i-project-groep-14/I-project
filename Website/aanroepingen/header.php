<?php 
    // global $config;

    if(isset($_POST['register'])){
        $email = $_POST['email'];

        $gebruikersnaam = $_POST['gebruikersnaam'];
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $adres = $_POST['adres'];
        $oAdres = $_POST['oAdres'];
        $postcode = $_POST['postcode'];
        $plaats = $_POST['plaats'];
        $land = $_POST['land'];
        $telefoonnr1 = $_POST['telnr1'];
        if(isset($_POST['telnr2'])) {
            $telefoonnr2 = $_POST['telnr2'];
        }
        $geboortedatum = $_POST['geboortedatum'];
        $wachtwoord = $_POST['wachtwoord'];
        $wachtwoord_confirm = $_POST['bWachtwoord'];
        $verkoper = $_POST['eenVerkoper'];

        $vraag = $_POST['veiligheidsvraag'];
        $antwoord = $_POST['veiligheidsvraag_antwoord'];

        if($wachtwoord == $wachtwoord_confirm) {
            $sql = "INSERT INTO gebruiker VALUES
                    (:gebruikersnaam, :voornaam, :achternaam, :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedatum, :mailadres, :wachtwoord, :vraag, :antwoordtekst, :rol)";
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
                ':rol' => 2
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


            session_start();
            session_destroy();
            session_start();




            $sql = "SELECT email_adres, gebruikersnaam FROM bezoekers
                    WHERE email_adres like :email";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':email' => $email
            ));

            $row = $query -> fetch();
            $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
            $_SESSION['email'] = $email;

            echo "test";



            // header ('Location: index.php');
        } else {
            $_POST['melding'] = "De wachtwoorden komen niet met elkaar overeen.";
        }
    }

    // if(isset($_POST['login'])){
    //     $email = $_POST['email'];
    //     $wachtwoord = $_POST['wachtwoord'];
    
    //     $sql = "SELECT wachtwoord FROM bezoekers 
    //             WHERE email_adres like :email";
    //     $query = $dbh->prepare($sql);
    //     $query -> execute(array(
    //         ':email' => $email
    //     ));

    //     $row = $query -> fetch();
    //     if(password_verify($wachtwoord, $row['wachtwoord'])){
    //         session_start();
    //         session_destroy();
    //         session_start();

    //         $sql = "SELECT email_adres, gebruikersnaam FROM bezoekers 
    //                 WHERE email_adres like :email";
    //         $query = $dbh->prepare($sql);
    //         $query -> execute(array(
    //             ':email' => $email
    //         ));
            
    //         $row = $query -> fetch();
    //         $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
    //         $_SESSION['email'] = $email;

    //         header ('Location: index.php');
    //     } else {
    //         $_POST['melding'] = "Wachtwoord of email onjuist";
    //     }
    // }

    if(!isset($_SESSION)) {
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
                      
                        <Select>
                                <option value="1000">Alle afstanden...</option>
                                <option value="10">10km</option>
                                <option value="20">20km</option>
                                <option value="30">30km</option>
                                <option value="40">40km</option>
                            </Select>
                       
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

    
  

