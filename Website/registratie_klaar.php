<?php 
     require_once 'aanroepingen/connectie.php';
     include_once 'aanroepingen/header.php';
?>

<?php
  include_once 'aanroepingen/registratie_progressbar.php';
?>

<h2 class="HomepaginaKopjes">Registratie</h2>
<div class="body-tekst">
  <p>
    Welkom,
    dit is de laatse stap van het registreren. Hier kunt u de ingevulde gegevens zien. Check a.u.b. 
    of deze gegevens correct zijn ingevoerd. Anders verander uw gegevens voordat u dit afrond. 
  </p>

  <div class="scroll-box">
  <div class="">
    <form>
       Gebruikersnaam:<?php if(empty($_SESSION['gebruikersnaam'])){echo"Geen gegevens";}else{echo $_SESSION['gebruikersnaam'];}?><br> 
       Voornaam:<br>
       Achternaam:<br>
       Adres:<br>
       Land:<br>
       Telefoonnummer:<br>
       Geboortedatum:<br>
       Wachtwoord:<br>
      <input class="button" type="submit" value="Verzenden" name="update_persoonsgegevens">
    </form>
</div>


  </div>

  <p>
    Post:
    Voor het activeren van het verkopersaccount krijgt per post een activatie code toegestuurd. 
    Daarmee kunt u binnen 7 dagen uw verkopersaccount activeren. 
    Klik hier om deze code in te voeren.
<!--Nog een link naar pagina verwijzen die het verkopersaccount verifieert. Deze link staat ook op het profiel.-->
  </p>
  
</div>
    
<?php 
    include_once 'aanroepingen/footer.html';
 ?>