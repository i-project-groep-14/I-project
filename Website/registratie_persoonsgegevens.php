<?php
  $config = ['pagina' => 'registratie_persoonsgegevens'];

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

      if (strlen($_POST['gebruikersnaam']) > 50) {
        echo "Het aantal karakters is te groot. Het maximale toegestane aantal karakters is 50.";
      } else {
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
          if(isset($_POST['eenVerkoper'])) {
            $_SESSION['eenVerkoper'] = $_POST['eenVerkoper'];
          } else {
            $_SESSION['eenVerkoper'] = 2;
          }

          header('Location: registratie_vraag.php');
        } else {
          echo "De wachtwoorden komen niet met elkaar overeen.";
        }
      }
    } else {
      echo "Gebruikersnaam is al in gebruik.";
    }
  }
?>

<aside  class="NavRubriekAside">
  <?php include_once 'aanroepingen/RubNav.php'; ?>
</aside>


<?php
  include_once 'aanroepingen/registratie_progressbar.php';
?>

        <h2 class="HomepaginaKopjes">Registreren</h2>
        <div class="body-tekst">
          <p>Dit is de tweede stap van het registreren. Vul a.u.b uw persoonlijkegegevens hieronder in.</p>
          <form action="" method="post" class="form-body-center" > 

              <div class="grid-container">  
                <div class="grid-x grid-padding-x">          
                  <div class="medium-12 cell">
                      <label>Gebruikersnaam:</label>
                      <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam" required>
                    </div>
                    <div class="medium-6 cell">
                      <label>Voornaam:</label>
                      <input  type="text" placeholder="Voornaam" name="voornaam" required>
                    </div>
                    <div class="medium-6 cell">
                      <label>Achternaam:</label>
                      <input type="text" placeholder="Achternaam" name="achternaam" required>
                    </div>
                    <div class="medium-6 cell">
                      <label>Adres:</label>
                      <input type="text" placeholder="Adres" name="adres" required>
                    </div>
                    <div class="medium-6 cell">
                      <label>Toevoeging Adres (Optioneel): 
                      <div class="tooltip">Meer info?
                        <span class="tooltiptext">Dit is een extra adres regel voor mensen die buiten Nederland wonen.</span>
                      </div></label>
                      <input type="text" placeholder="Tweede adres" name="oAdres">
                    </div>
                    <div class="medium-4 cell">
                      <label>Postcode:</label>
                      <input type="text" placeholder="Postcode" name="postcode" required>
                    </div>
                    <div class="medium-4 cell">
                      <label>Plaatsnaam:</label>
                      <input type="text" placeholder="Plaats" name="plaats" required>
                    </div>
                    <div class="medium-4 cell">
                      <label>Landsnaam:</label>
                      <input type="text" placeholder="Land" name="land" required>
                    </div>
                    <div class="medium-6 cell">
                      <label>Telefoonnr:</label>
                      <input type="tel" placeholder="Telefoonnr" name="telnr1" required>
                    </div>
                    <div class="medium-6 cell">
                      <label>Telefoonnr 2 (Optioneel):</label>
                      <input type="tel" placeholder="Telefoonnr" name="telnr2">
                    </div>
                    <div class="medium-12 cell">
                      <label>Geboortedatum:</label>
                      <input type="date" name="geboortedatum" required>
                    </div>
                    <div class="medium-12 cell">
                      <label>Wachtwoord:</label>
                      <input type="password" placeholder="Wachtwoord" name="wachtwoord" required>                    
                    </div>
                    <div class="medium-12 cell">
                      <label>Bevestig Wachtwoord:</label>
                      <input type="password" placeholder="Bevestig wachtwoord" name="bWachtwoord" required>
                    </div>
                    <fieldset class="fieldset medium-12 cell">
                      <legend>Wilt u spullen verkopen?</legend>
                      <input type="radio" name="eenVerkoper" value="3" id="wel">
                      <label class="side-label" for="wel">Wel</label> 
                      <input type="radio" name="eenVerkoper" value="2" id="niet">
                      <label for="niet">Niet</label>
                        
                    <div class="wel-verkopergegevens">
                      <label for="verkoopgegevens-rekeningnr">Rekeningnummer:</label>
                      <input type="text" name="verkoopgegevens-rekeningnr" placeholder="Rekeningnummer">

                      <label for="verkoopgegevens-bank">Bank:</label>
                      <input type="text" name="verkoopgegevens-bank" placeholder="Bank">
                      <p>
                        Om uw verkopersaccount te activeren heeft u een code nodig. Deze code kan opgestuurd worden
                        via post of er wordt naar uw creditcard gegevens gevraagd. Maak een keuze hieronder.
                      </p>
                      <input type="radio" name="controle" id="controle-creditcard">
                      <label for="controle-creditcard" class="label-next side-label">Creditcard:</label>
                      
                      <input type="radio" name="controle" id="controle-post">
                      <label for="controle-post">Post:</label>
                      <div class="controle-creditcard-gegevens">
                        <label for="creditcard-gegevens">Creditcardnummer</label>
                        <input type="text" name="creditcardnummer" id="creditcard-gegevens" placeholder="Creditcardnummer">
                      </div>
                      </div>

                      </fieldset>
                  </div>
              </div>
              <p>Mocht u nu nog geen verkoper zijn, kunt u dit altijd later aanpassen.<p>         
              <input class="button" type="submit" name="verzenden_pers" value="Verzenden">        
            </form>
      </div>

<?php
  include_once 'aanroepingen/footer.html';
?>

