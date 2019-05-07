<?php
  include_once 'aanroepingen/header.php';
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<br>

<h1 class="InlogpaginaKopje"> Inloggen </h1>
<form class="inlogpaginaContainer">
        <div>
        <input type="text" placeholder="Voer Gebruikersnaam in" name="email" required>
        <input type="password" placeholder="Voer Wachtwoord in" name="psw" required>
        <hr>
        <button type="submit" class="button inlogbutton">Log in</button>
        <input type="button" class="button inlogbutton" onclick="window.location.href = 'wachtwoordvergeten.php';" value="Wachtwoord vergeten?"/>
        <p>Als je nog geen account voor EenmaalAndermaal hebt maak dan <a href="registratie_email.php">hier</a> een account.</p>
        </div>
 </form>
 
 <?php
  include_once 'aanroepingen/footer.html';
?>