<?php
  require_once 'aanroepingen/connectie.php';
  include_once 'aanroepingen/header.php';

  if(isset($_POST['verzenden_pers'])){
    $sql = "SELECT gebruikersnaam FROM gebruiker 
            WHERE gebruikersnaam like :gebruikersnaam";
    $query = $dbh->prepare($sql);
    $query -> execute(array(
      ':gebruikersnaam' => $_POST['gebruikersnaam']
    ));

    $row = $query -> fetch();
    if($_POST['gebruikersnaam'] != $row['gebruikersnaam']) {
      if($_POST['wachtwoord'] == $_POST['bWachtwoord']) {
        $_SESSION['gebruikersnaam'] = $_POST['gebruikersnaam'];
        $_SESSION['voornaam'] = $_POST['voornaam'];
        $_SESSION['achternaam'] = $_POST['achternaam'];
        $_SESSION['adres'] = $_POST['adres'];
        if(isset($_POST['oAdres'])) {
          $_SESSION['oAdres'] = $_POST['oAdres'];
        }
        $_SESSION['postcode'] = $_POST['postcode'];
        $_SESSION['plaats'] = $_POST['plaats'];
        $_SESSION['land'] = $_POST['land'];
        $_SESSION['telnr1'] = $_POST['telnr1'];
        if(isset($_POST['telnr2'])) {
          $_SESSION['telnr2'] = $_POST['telnr2'];
        }
        $_SESSION['geboortedatum'] = $_POST['geboortedatum'];
        $_SESSION['wachtwoord'] = $_POST['wachtwoord'];
        // $_SESSION['bWachtwoord'] = $_POST['bWachtwoord'];
        if(isset($_POST['eenVerkoper'])) {
          $_SESSION['eenVerkoper'] = $_POST['eenVerkoper'];
        } else {
          $_SESSION['eenVerkoper'] = 2;
        }

        header('Location: registratie_vraag.php');
      } else {
        echo "De wachtwoorden komen niet met elkaar overeen.";
      }
    } else {
      echo "Gebruikersnaam is al in gebruik.";
    }
  }
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>

<!--foundation-->
<ol class="progress-indicator">
  <li class="is-complete" data-step="">
  <span>Verifiëren e-mail</span>
  </li>
  <li class="is-current" data-step="">
  <span>Gegevens invullen</span>
  </li>
  <li class="" data-step="">
  <span>Veiligheid</span>
  </li>
  <li class="" data-step="">
      <span>Klaar</span>
</li>
</ol>
<!--end-->

        <h2 class="HomepaginaKopjes">Registreren</h2>
        <div class="body-tekst">
        <p>
            Dit is de tweede stap van het registreren. Vul a.u.b al uw gevraagde gegevens hieronder in. 
        </p>
          <form action="registratie_persoonsgegevens.php" method="post" >
            Gebruikersnaam:
            <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam">
            Voornaam & Achternaam:<br>
            <input  type="text" placeholder="Voornaam" name="voornaam" class="small-input">
            <input type="text" placeholder="Achternaam" naam="achternaam" class="small-input" >
            Adres & Toevoeging Adres (Optioneel): 
            <div class="tooltip">Meer informatie?
              <span class="tooltiptext">Een toevoeging bij het adres is een extra adres regel voor mensen die buiten Nederland wonen.</span>
            </div><br>
            <input type="text" placeholder="Adres" name="adres" class="small-input" > 
            <input type="text" placeholder="Toevoeging adres" name="oAdres" class="small-input" >
            Postcode & Plaatsnaam:<br>
            <input type="text" placeholder="Postcode" name="postcode" class="small-input">
            <input type="text" placeholder="Plaats" name="plaats" class="small-input" id="plaatsnaam">        
            Landsnaam:
            <input type="text" placeholder="Land" name="land">
            Telefoonnr & Telefoonnr 2 (Optioneel): <br>
            <input type="tel" placeholder="Telefoonnr" name="telnr1" class="small-input">
            <input type="tel" placeholder="Telefoonnr" name="telnr2" class="small-input">
            Geboortedatum:
            <input type="date" name="geboortedatum">
            Wachtwoord:
            <input type="text" placeholder="Wachtwoord" name="wachtwoord">
            Bevestig Wachtwoord:
            <input type="text" placeholder="Bevestig wachtwoord" name="bWachtwoord">
            Wordt dit een verkopersaccount?<br>
            <label class="label-next side-label" for="wel">Wel</label>
            <input type="radio" name="eenVerkoper" id="wel"> 
            <label for="niet">Niet</label>
            <input type="radio" name="eenVerkoper" id="niet"> <br>
            <div class="wel-verkopergegevens">
              <label for="verkoopgegevens-rekeningnr">Rekeningnummer:</label>
              <input type="text" name="verkoopgegevens-rekeningnr" placeholder="Rekeningnummer">
              <label for="verkoopgegevens-bank">Bank:</label>
              <input type="text" name="verkoopgegevens-bank" placeholder="Bank">
              <label for="controle-creditcard" class="label-next side-label">Creditcard:</label>
              <input type="radio" name="controle" id="controle-creditcard">
              <label for="controle-post">Post:</label>
              <input type="radio" name="controle" id="controle-post">
              <div class="controle-creditcard-gegevens">
                <label for="creditcard-gegevens">Creditcardnummer</label>
                <input type="text" name="creditcardnummer" id="creditcard-gegevens" placeholder="Creditcardnummer">
              </div>
            </div> 
            Dit kan na een normaal account, nog altijd een verkopersaccount worden.<br><br>
            <input class="button" type="submit" name="verzenden_pers" value="Verzenden">
        
          </form>
        </div>

<?php
  include_once 'aanroepingen/footer.html';
?>

