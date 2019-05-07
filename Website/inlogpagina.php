<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.html';
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<form>
        <div class="inlogpaginaContainer">
        <input type="text" placeholder="Voer Gebruikersnaam in" name="email" required>
        <input type="password" placeholder="Voer Wachtwoord in" name="psw" required>
         <hr>
        <button type="submit" class="inlogbutton">Log in</button>
 </form>
 <input type="button" class="inlogbutton" onclick="window.location.href = 'index.php';" value="Wachtwoord vergeten?"/>
 <p>Als je nog geen account voor EenmaalAndermaal hebt maak dan <a href="index.php">hier</a> een account</p>
 </div>




































































<?php
  include_once 'aanroepingen/footer.html';
?>