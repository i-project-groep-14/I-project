<?php 
     require_once 'aanroepingen/connectie.php';
     include_once 'aanroepingen/header.php';
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<?php
  include_once 'aanroepingen/registratie_progressbar.php';
  $gegevens_lijst = array("gebruikersnaam","voornaam","achternaam","adres","Oadres","postcode","plaats","land","telnr1","telnr2","geboortedatum","Wachtwoord","eenVerkoper" );

  function gegevens_ophalen($gegevens){
     $len = count( $gegevens ); 

    for($i = 0; $i < $len; $i++){
      
      if(empty($_SESSION[$gegevens[$i]])){
      echo" Geen gegevens beschikbaar" ."<br>";
      }else{
      echo $_SESSION[$gegevens[$i]];
      }
    }
  }

  function gegeven($gegevens,$nummer){
    if(empty($_SESSION[$gegevens[$nummer]])){
        echo" Geen gegevens beschikbaar" ."";
    }else{
        echo $_SESSION[$gegevens[$nummer]];
    }
  }
 
?>

<h2 class="HomepaginaKopjes center">Registratie</h2>
<div class="center">
  <p>
    Welkom,
    dit is de laatse stap van het registreren. Hier kunt u de ingevulde gegevens zien. Check a.u.b. 
    of deze gegevens correct zijn ingevoerd. Anders verander uw gegevens voordat u dit afrond. 
  </p>

  <div class="scroll-box">
    <form>     
       Gebruikersnaam:<?php gegeven($gegevens_lijst,0)?><br> 
       Voornaam:<?php gegeven($gegevens_lijst,1)?><br> 
       Achternaam:<?php gegeven($gegevens_lijst,2)?><br>
       Adres:<?php gegeven($gegevens_lijst,3)?><br>
       Land:<?php gegeven($gegevens_lijst,6)?><br>
       Telefoonnummer:<?php gegeven($gegevens_lijst,8)?><br>
       Geboortedatum:<?php gegeven($gegevens_lijst,9)?><br>
       Wachtwoord:<?php gegeven($gegevens_lijst,11)?><br>
       Verkoper: <?php gegeven($gegevens_lijst,12)?><br>
       <!--Dit wordt nog verandert naar een form waarin je de gegevens kan updaten-->
      <input class="button" type="submit" value="Verzenden" name="update_persoonsgegevens">
    </form>
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