<?php 
    global $config;

    if(isset($_POST['register'])){
        $accountnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];
        $wachtwoord_confirm = $_POST['wachtwoord_confirm'];
        $naam = $_POST['naam'];
        $telefoon = $_POST['telefoon'];
        $email = $_POST['email'];
    
        if($wachtwoord == $wachtwoord_confirm) {
            $sql = "INSERT INTO bezoekers VALUES
                    (:email, :accountnaam, :wachtwoord, :naam, :telefoon)";
            $query = $dbh->prepare($sql);
            $query -> execute(array(
                ':email' => $email,
                ':accountnaam' => $accountnaam,
                ':wachtwoord' => password_hash($wachtwoord, PASSWORD_DEFAULT),
                ':naam' => $naam,
                ':telefoon' => $telefoon
                )
            );
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

            header ('Location: index.php');
        } else {
            $_POST['melding'] = "Gegevens kloppen niet";
        }
    }

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
    
        $sql = "SELECT wachtwoord FROM bezoekers 
                WHERE email_adres like :email";
        $query = $dbh->prepare($sql);
        $query -> execute(array(
            ':email' => $email
        ));

        $row = $query -> fetch();
        if(password_verify($wachtwoord, $row['wachtwoord'])){
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

            header ('Location: index.php');
        } else {
            $_POST['melding'] = "Wachtwoord of email onjuist";
        }
    }

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
    